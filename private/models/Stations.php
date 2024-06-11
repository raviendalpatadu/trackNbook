<?php

class Stations extends Model
{
    protected $table = 'tbl_station';
    protected $allowedColumns = array('station_name'); 

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($values){
        if (empty($values['station_name'])) {
            $this->errors['station_name'] =  "Station name is required.";
        }
        //check if the station name is already in the database
        if ($this->whereOne('station_name', $values['station_name'])) {
            $this->errors['station_name'] = "Station name already exists.";
        }

        if (count($this->errors) ==  0 ) {
            return true;
        }
        return false;

    }

    public function getStations()
    {
        try {
            $result = $this->findAll();
            //sort an array in assending order
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function getStation($stationId)
    {
        try {
            $result = $this->whereOne('station_id', $stationId);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function getOneStation($column, $value)
    {
        try {
            $result = $this->whereOne($column, $value);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    // public function addStation()
    // {
    //     try {
    //         $con = $this->connect();
    //         $con->beginTransaction();

    //         $query = "SELECT * INSERT INTO tbl_station VALUES (:station_name)";
    //         $stm = $con->prepare($query);
    //         $stm->execute(
    //             array(
    //                 'station_name' => $_POST['station_name']
    //             )
    //         );

    //         $stationId = $con->lastInsertId();

    //         $con->commit();
    //         $con = null;

    //         return $stationId;
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }
    // }

}