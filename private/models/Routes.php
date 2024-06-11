<?php

class Routes extends Model
{
    protected $table = 'tbl_route';

    public function __construct()
    {
        parent::__construct();
    }

    public function getRoute()
    {
        try {
            $result = $this->findAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function getRouteStationsWithStartAndEndStaions($route_id, $start_station, $end_station)
    {
        try {
            $query = "SELECT s.*
                        FROM tbl_station s
                        JOIN tbl_route_station r ON r.station_id = s.station_id 
                        WHERE r.route_no = :route_id
                        ORDER BY
                            CASE
                                WHEN 
                                    (SELECT route_station_order FROM tbl_route_station WHERE station_id = :start_station AND route_no = :route_id) < 
                                    (SELECT route_station_order FROM tbl_route_station WHERE station_id = :end_station AND route_no = :route_id)
                                THEN r.route_station_order
                                ELSE r.route_station_order * -1
                            END;";

        $result = $this->query($query, [
            'route_id' => $route_id,
            'start_station' => $start_station,
            'end_station' => $end_station
        ]);

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getRouteStations($route_id)
    {
        try {
            $query = "SELECT s.*, r.route_station_order
                        FROM tbl_station s
                        JOIN tbl_route_station r ON r.station_id = s.station_id 
                        WHERE r.route_no = :route_id
                        ORDER BY r.route_station_order ASC;";

        $result = $this->query($query, [
            'route_id' => $route_id
        ]);

            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    
    public function validate($values)
    {
        if (empty($values['route_name'])) {
            $this->errors['route_name'] = 'Route name is required';
        }

        if(count($this->errors) === 0){
            return true;
        }
        return false;
    }

    
    // public function addRoute(){
    //     $query = "INSERT INTO $this->table (route_name) VALUES (:route_name)";
    //     $route_id = $this->query($query, ['route_name' => $_POST['route_name']]);
        
    //     // Update tbl_route_station
    //     $stations = $_POST['stations'];
    //     foreach ($stations as $station) {
    //         $query = "INSERT INTO tbl_route_station (route_no, station_id, route_station_order) VALUES (:route_id, :station_id, :route_station_order)";
    //         $this->query($query, [
    //         'route_id' => $route_id,
    //         'station_id' => $station['station_id'],
    //         'route_station_order' => $station['route_station_order']
    //         ]);
    //     }
        
    //     return $route_id;
    // }
}
