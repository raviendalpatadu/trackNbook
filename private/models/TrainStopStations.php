<?php

class TrainStopStations extends Model
{
    protected $table = 'tbl_train_stop_station';
    protected $allowedColumns = ['train_id', 'station_id', 'train_stop_time', 'stop_no'];
   

    public function __construct()
    {
        parent::__construct();
    }

    public function getTrainStopStations($train_id)
    {
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id ORDER BY stop_no";
        return $this->query($query, ['train_id' => $train_id]);
    }

    public function getTrainStopStationNames($train_id)
    {
        $query = "SELECT * FROM $this->table tss
        JOIN tbl_station s ON s.station_id = tss.station_id
         WHERE tss.train_id = :train_id
         Group BY tss.station_id;";

        return $this->query($query, ['train_id' => $train_id]);
    }

    public function updateStopStation($station_id)
    {
        $query = "UPDATE tbl_train_location tl
        JOIN $this->table tss ON tl.train_location = tss.station_id
        SET tl.station_id = :station_id
        WHERE tss.train_id = :train_id";
        return $this->query($query, ['station_id' => $station_id]);
    }

    public function getTrainStopStation($train_id, $station_id)
    {
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id AND station_id = :station_id";
        $res = $this->query($query, ['train_id' => $train_id, 'station_id' => $station_id]);
        if (is_array($res) && count($res) > 0) {
            return true;
        }
        return false;
    }

    public function getTrainStopStationData($train_id, $station_id)
    {
        $query = "SELECT * FROM $this->table WHERE train_id = :train_id AND station_id = :station_id";
        $res = $this->query($query, ['train_id' => $train_id, 'station_id' => $station_id]);
        if (is_array($res) && count($res) > 0) {
            return $res;
        }
        return [];
    }
}