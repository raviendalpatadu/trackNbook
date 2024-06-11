<?php


class StationMasters extends Model
{
    protected $table = 'tbl_station_master';

    public function __construct()
    {
        parent::__construct();
    }

    // public function getStationName($station_master_id)
    // {
    //     try {

    //         $result = $this->whereOne('station_master_id', $station_master_id);
    //         if ($result) {
    //             return $result['station_name'];
    //         }
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    //     return null;
    // }



    public function getAllStationMastersByStation($stationId)
    {
        try {
            $query = "SELECT 
                    sm.station_master_id,
                    sm.station_master_station,
                    u.user_name,
                    u.user_phone_number,
                    u.user_email
                  FROM
                    $this->table sm
                    JOIN tbl_user u ON sm.station_master_id = u.user_id
                  WHERE
                    sm.station_master_station = :stationId";

        $result = $this->query($query, ['stationId' => $stationId]);

            if(is_array($result) && count($result) > 0){
                return $result;
            }
            return [];
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Error fetching station masters: " . $e->getMessage());
            return false;
        }
    }

    public function infromTrainDelay($data)
    {
        try {
            $query = "WITH current_station AS (
                SELECT *
                FROM tbl_train_stop_station
                WHERE train_id = :train_id AND station_id = :station_id
            ),
            
            next_stations AS (
                SELECT *
                FROM tbl_train_stop_station
                WHERE train_id = :train_id AND stop_no > (SELECT stop_no FROM current_station)
            )
            
            SELECT *
            FROM next_stations ns
            
            JOIN tbl_reservation r ON  ns.train_id = r.reservation_train_id AND ns.station_id = r.reservation_start_station";

        $result = $this->query($query, [
            'train_id' => $data['train_id'],
            'station_id' => $data['station_id']
        ]);

            if(is_array($result) && count($result) > 0){
                return $result;
            }
            return [];
        } catch (PDOException $e) {
            // Log the error or handle it appropriately
            error_log("Error fetching station masters: " . $e->getMessage());
            return false;
        }
    }

}



