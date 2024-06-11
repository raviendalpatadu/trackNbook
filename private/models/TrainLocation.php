<?php

class TrainLocation extends Model
{
    protected $table = 'tbl_train_location';
    protected $allowedColumns = ['train_id', 'date', 'train_location', 'train_location_updated_time'];


    public function validate($data)
    {
        // if the station is a previous station
        if (isset($data['train_id']) && isset($data['train_location'])) {
            if ($this->isPreviousStation($data['train_id'], $data['train_location'])) {
                $this->errors['errors']['station_id'] = 'You entered a previous station';
            }
        }

        if (!isset($data['train_id']) || empty($data['train_id'])) {
            $this->errors['errors']['station_id'] = 'Train ID is required';
        }

        //    if train is already at the table and the date is the same, then the train is already at the station
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id AND date = :date";
        $train_location = $this->query($query, ['train_id' => $data['train_id'], 'date' => $data['date']]);


        if (is_array($train_location) && count($train_location) == 0) {

            $this->errors['errors']['station_id'] = 'Train is no in the table';
        }



        if (is_array($this->errors) && count($this->errors) > 0) {
            return false;
        }

        return true;
    }


    public function isPreviousStation($train_id, $station_id)
    {
        // get the last station of the train

        $query = "SELECT *
        FROM tbl_train_location tl
        JOIN tbl_train_stop_station tss ON tl.train_id = tss.train_id AND tl.train_location = tss.station_id
        WHERE tl.train_id = :train_id AND tl.date = :date;";

        $previous_station_stop_no = $this->query($query, ['train_id' => $train_id, 'date' => date('Y-m-d')]);

        // get the current station stop number
        if (is_array($previous_station_stop_no) && count($previous_station_stop_no) > 0) {
            $train_stop_station = new TrainStopStations();
            $current_station_data = $train_stop_station->getTrainStopStationData($train_id, $station_id);


            if ($previous_station_stop_no[0]->stop_no < $current_station_data[0]->stop_no) {
                return false;
            }
            return true;
        }
        return false;
    }

    public function isTrainExists($train_id, $date)
    {
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id AND date = :date";
        $train_location = $this->query($query, ['train_id' => $train_id, 'date' => $date]);

        if (is_array($train_location) && count($train_location) > 0) {
            return true;
        }
        return false;
    }

    public function updateLocation($data)
    {
        // check is the train is already in the table
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id AND date = :date";
        $train_location = $this->query($query, ['train_id' => $data['train_id'], 'date' => $data['date']]);

        if (is_array($train_location) && count($train_location) > 0) {
            // update the location
            $update_query = "UPDATE $this->table SET train_location = :train_location, train_location_updated_time = :train_location_updated_time WHERE train_id = :train_id AND date = :date";
            return $this->query($update_query, $data);
        }
        return false;
    }


    public function getTrainLocation($train_id)
    {
        $query = "SELECT tl.*,
        t.*,
        start_station.station_name AS start_station,
        end_station.station_name AS end_station,
        current_station.station_name AS current_station
     -- get the mext station
        ,(
            SELECT station_name
            FROM tbl_station
            WHERE station_id = (
            -- consider get the stop no. from the train_stop_station table
                SELECT station_id
                    FROM tbl_train_stop_station tss
                    WHERE tss.train_id = tl.train_id
                    AND tss.stop_no = (
                        SELECT MIN(tss.stop_no)
                        FROM tbl_train_stop_station tss
                        WHERE tss.train_id = tl.train_id
                        AND tss.stop_no > (
                            SELECT tss.stop_no
                            FROM tbl_train_stop_station tss
                            WHERE tss.train_id = tl.train_id
                            AND tss.station_id = tl.train_location
                        )
                    )
            )
        ) AS next_station
                
                FROM tbl_train_location tl
                    JOIN tbl_train t ON t.train_id = tl.train_id
                    JOIN tbl_train_type tt ON tt.train_type_id = t.train_type
                    JOIN tbl_station start_station ON start_station.station_id = t.train_start_station
                    JOIN tbl_station end_station ON end_station.station_id = t.train_end_station
                    JOIN tbl_station current_station ON current_station.station_id = tl.train_location
                WHERE tl.train_id = :train_id
                    AND date = :date
                GROUP BY t.train_id,
                    tl.date
                
                ";
        return $this->query($query, [
            'train_id' => $train_id,
            'date' => date('Y-m-d')
        ]);
    }

    public function selectTrainLocation($train_id, $date)
    {
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id AND date = :date";
        $result = $this->query($query, ['train_id' => $train_id, 'date' => $date]);

        if(is_array($result) && count($result) > 0){
            return $result[0];
        }
        return [];
    }
}
