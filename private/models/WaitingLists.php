<?php

class WaitingLists extends Model
{
    protected $table = 'tbl_waiting_list';
    protected $allowedColumns = array('waiting_list_passenger_id', 'waiting_list_train_id', 'waiting_list_compartment_id', 'waiting_list_reservation_start_station', 'waiting_list_reservation_end_station', 'waiting_list_reservation_date', 'waiting_list_status');

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($values)
    {
        if (empty($values['waiting_list_passenger_id'])) {
            $this->errors['waiting_list_passenger_id'] = "Passenger id is required.";
        }

        if (empty($values['waiting_list_train_id'])) {
            $this->errors['waiting_list_train_id'] = "Train id is required.";
        }

        if (empty($values['waiting_list_compartment_id'])) {
            $this->errors['waiting_list_compartment_id'] = "Compartment id is required.";
        }

        if (empty($values['waiting_list_reservation_start_station'])) {
            $this->errors['waiting_list_reservation_start_station'] = "Start station is required.";
        }

        if (empty($values['waiting_list_reservation_end_station'])) {
            $this->errors['waiting_list_reservation_end_station'] = "End station is required.";
        }

        if (empty($values['waiting_list_reservation_date'])) {
            $this->errors['waiting_list_reservation_date'] = "Date is required.";
        }


        if (count($this->errors) == 0) {
            return true;
        }
        return false;
    }


    public function getWaitingListPassenger($id)
    {
        $query = "WITH SortedRows AS (
            SELECT
                *,
                ROW_NUMBER() OVER (PARTITION BY waiting_list_train_id, waiting_list_compartment_id, waiting_list_reservation_date ORDER BY waiting_list_time_created) AS priority_number
            FROM
                tbl_waiting_list
        )
        SELECT
            s.*,
            start_st.station_name AS start_station_name,
            end_st.station_name AS end_station_name,
            t.train_name,
            t.train_type,
            ct.compartment_class_type,
            ts_start.train_stop_time AS estimated_start_time,
            ts_end.train_stop_time AS estimated_end_time
            
        FROM
           SortedRows s
           JOIN tbl_station start_st ON s.waiting_list_reservation_start_station = start_st.station_id
           JOIN tbl_station end_st ON s.waiting_list_reservation_end_station = end_st.station_id
           JOIN tbl_train t ON s.waiting_list_train_id = t.train_id
           JOIN tbl_compartment c ON s.waiting_list_compartment_id = c.compartment_id
           JOIN tbl_compartment_class_type ct ON c.compartment_class_type = ct.compartment_class_type_id
           JOIN tbl_train_stop_station ts_start ON ts_start.train_id = s.waiting_list_train_id and ts_start.station_id = s.waiting_list_reservation_start_station
           JOIN tbl_train_stop_station ts_end ON ts_end.train_id = s.waiting_list_train_id and ts_end.station_id = s.waiting_list_reservation_end_station
        WHERE
          waiting_list_passenger_id = :passenger_id
        ORDER BY
            waiting_list_train_id, waiting_list_compartment_id, waiting_list_reservation_date, waiting_list_time_created;";
        $result = $this->query($query, array(':passenger_id' => $id));
        
        if(is_array($result) && count($result) > 0){
            return $result;
        }
        return [];
    }

    public function notifyWaitingList($id)
    {
        // if a passenger cancels send mails to the top 10 in the waiting list
        $passenger_count = '10';

        try {
            $query = "WITH getData AS(
                SELECT 
                    *
                FROM 
                    tbl_reservation 
                WHERE
                    reservation_ticket_id = :reservation_ticket_id
                LIMIT 1
            ),
            SortedRows AS (
                SELECT
                    w.*,
                    ROW_NUMBER() OVER (PARTITION BY w.waiting_list_train_id, w.waiting_list_compartment_id, w.waiting_list_reservation_date ORDER BY w.waiting_list_time_created) AS priority_number
                FROM
                    tbl_waiting_list w
                JOIN
                    getData g ON w.waiting_list_train_id = g.reservation_train_id 
                              AND w.waiting_list_compartment_id = g.reservation_compartment_id 
                              AND w.waiting_list_reservation_date = g.reservation_date
            )
            SELECT
                s.waiting_list_passenger_id,
                s.priority_number,
                s.waiting_list_reservation_date,
                t.train_id,
                t.train_name,
                start_st.station_name AS start_station_name,
                end_st.station_name AS end_station_name,
                ts_start.train_stop_time AS estimated_start_time,
                ts_end.train_stop_time AS estimated_end_time
                
            FROM
                SortedRows s
            
            JOIN tbl_train t ON t.train_id = s.waiting_list_train_id
            JOIN tbl_station start_st ON s.waiting_list_reservation_start_station = start_st.station_id
            JOIN tbl_station end_st ON s.waiting_list_reservation_end_station = end_st.station_id
            JOIN tbl_train_stop_station ts_start ON ts_start.train_id = s.waiting_list_train_id and ts_start.station_id = s.waiting_list_reservation_start_station
            JOIN tbl_train_stop_station ts_end ON ts_end.train_id = s.waiting_list_train_id and ts_end.station_id = s.waiting_list_reservation_end_station
                
                
            ORDER BY
                s.waiting_list_train_id, s.waiting_list_compartment_id, s.waiting_list_reservation_date, s.waiting_list_time_created";
            // --LIMIT :passenger_count";

            $result = $this->query(
                $query,
                array(
                    ':reservation_ticket_id' => $id
                )
            );
        } catch (PDOException $e) {
            return $e;
        }

        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return [];
    }

    public function inWaitingList($waiting_list)
    {

        $query = "SELECT *
        FROM
            tbl_waiting_list
        WHERE
            waiting_list_train_id = :waiting_list_train_id
            AND waiting_list_compartment_id = :waiting_list_compartment_id
            AND waiting_list_reservation_date = :waiting_list_reservation_date
            AND waiting_list_passenger_id = :waiting_list_passenger_id";

        $data = $this->query($query, $waiting_list);

        if ($data) {
            return true;
        }
        return false;
    }

    public function removeFromWaitingList($waiting_list)
    {
        try {
            $query = "SELECT *
        FROM
            tbl_waiting_list
        WHERE
            waiting_list_train_id = :waiting_list_train_id
            AND waiting_list_compartment_id = :waiting_list_compartment_id
            AND waiting_list_reservation_date = :waiting_list_reservation_date
            AND waiting_list_passenger_id = :waiting_list_passenger_id";

            $data = $this->query($query, $waiting_list);

            if ($data) {
                $query = "DELETE FROM tbl_waiting_list
            WHERE 
                waiting_list_train_id = :waiting_list_train_id
                AND waiting_list_compartment_id = :waiting_list_compartment_id
                AND waiting_list_reservation_date = :waiting_list_reservation_date
                AND waiting_list_passenger_id = :waiting_list_passenger_id";

                $this->query($query, $waiting_list);
                return true;
            }
        } catch (PDOException $e) {
            return $e;
        }
        return false;
    }

    //need all waiting list passengers with the train name and start and end station names
    public function getWaitingList()
    {
        try {
            $query = "SELECT 
                    s.waiting_list_id,
                    s.waiting_list_passenger_id,
                    s.waiting_list_reservation_start_station,
                    s.waiting_list_reservation_end_station,
                    s.waiting_list_reservation_date,
                    start_st.station_name AS start_station_name,
                    end_st.station_name AS end_station_name,
                    t.train_name,
                    u.user_nic,
                    ROW_NUMBER() OVER (PARTITION BY s.waiting_list_train_id, s.waiting_list_compartment_id, s.waiting_list_reservation_date ORDER BY s.waiting_list_time_created) AS priority_number
                  FROM
                    $this->table s
                    JOIN tbl_user u ON s.waiting_list_passenger_id = u.user_id
                    JOIN tbl_station start_st ON s.waiting_list_reservation_start_station = start_st.station_id
                    JOIN tbl_station end_st ON s.waiting_list_reservation_end_station = end_st.station_id
                    JOIN tbl_train t ON s.waiting_list_train_id = t.train_id";
    
            $result = $this->query($query);
    
            return $result ?: []; // Return empty array if $result is false
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Error fetching waiting list: " . $e->getMessage());
            return []; // Return empty array on error
        }
    }
    

}
