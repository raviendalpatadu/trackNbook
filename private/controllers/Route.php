<?php

class Route extends Controller
{
    public function getRouteStations($route_id)
    {
        $route = new Routes();

        $route_stations = $route->getRouteStations($route_id);

        echo json_encode($route_stations);
    }
    public function getRouteStationsWithStartAndEndStaions()
    {
        $route = new Routes();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $route_stations = $route->getRouteStationsWithStartAndEndStaions($_POST['route_id'], $_POST['start_station_id'], $_POST['end_station_id']);

            echo json_encode($route_stations);
        }
    }

    public function addRoute()
    {
        $data = array();
        $station = new Stations();
        $data['stations'] = $station->findAll();
    
        if (isset($_POST['submit'])) {
            $route = new Routes();
            $routeStations = new RoutesStations();
    
            if ($route->validate($_POST) && $routeStations->validate($_POST)) {
                $routeid = $route->insert(['route_name' => $_POST['route_name']]);
                
                foreach ($_POST['station'] as $key => $value) {
                    $routeStations->insert(['route_no' => $routeid, 'station_id' => $value, 'route_station_order' => $key + 1]);
                }
                
                
                if ($routeid) {
                    $data['success'] = true;
                } else {
                    $data['errors']['database'] = 'Failed to add route';
                }
            }

            $this->redirect('route/addRoute?success=1');
    
        }
        $this->view("add.route.admin", $data);
    }    

        // public function addRoute()
        // {
        //     $data = array();
        //     $station = new Stations();
        //     $data['stations'] = $station->findAll();
        //     $errors = array();

        //     if (isset($_POST['submit'])) {
        //         // Validate route_name
        //         if (empty($_POST['route_name'])) {
        //             $errors['route_name'] = 'Route name is required';
        //         }

        //         // Check if stations are selected
        //         if (!isset($_POST['station']) || !is_array($_POST['station'])) {
        //             $errors['stations'] = 'At least one station must be selected';
        //         }

        //         if (count($errors) === 0) {
        //             $route = new Routes();
        //             $routeid = $route->insert(['route_name' => $_POST['route_name']]);

        //             if (!$routeid) {
        //                 $errors['database'] = 'Failed to add route';
        //             }

        //             foreach ($_POST['station'] as $key => $value) {
        //                 $result = $station->insert(['route_id' => $routeid, 'station_id' => $value, 'station_order' => $key]);
        //                 if (!$result) {
        //                     $errors['station' . $key] = 'Failed to add station';
        //                 }
        //             }

        //             if (count($errors) === 0) {
        //                 // Successfully added route and stations
        //                 // Redirect or set a success message
        //             }
        //         }

        //         $data['errors'] = $errors;
        //     }

        //     $this->view("add.route.admin", $data);
        // }


    }
