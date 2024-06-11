<?php

/**
 * profile controller
 */

class StaffGeneral extends Controller
{
    function index($id = '')
    {



        $this->view('staff_general.dashboard');
    }

    /*function manageSchedule($id = '')

    {
        $train = new Trains();
        $data = array();

        $data['trains'] = $train->findAllTrains();

        echo "<pre>";
        print_r($data);
        echo "</pre>"; 

        // $this->view('manage.schedule', $data);
    }

   /* function updateSchedule($id = '')
    {

        $this->view('update.schedule');
    }
*/
   /* function waitList()
    {   
        
        $waitinglist = new WaitingLists();
        $data = array();
        $data['waitinglist'] = $waitinglist->getWaitingList();

        $this->view('view.waitinglist', $data);
    }
    /*function manageSchedule2($id = '')
    {

        $this->view('manage.schedule2');
    }
*/
    function getTrainList($id = '')
    {
        $train = new Trains();
        $data = array();
        

        $data['trains'] = $train->findAllTrains();


        $this->view('view.trainlist.staffgeneral', $data);
    }



    function updateTrain($id = '')
    {
        $train = new Trains();
        $data = array();
        $data['errors'] = array();

        $data['train'] = $train->whereOne('train_id', $id);

        $station = new Stations();
        $data['stations'] = $station->getStations();

        $route = new Routes();
        $data['routes'] = $route->findAll();

        $compartment = new Compartments();

        $data['compartments'] = $compartment->where('compartment_train_id', $data['train']->train_id);

        $compartment_type = new CompartmentTypes();
        $data['compartment_types'] = $compartment_type->findAll();

        $train_stop_stations = new TrainStopStations();
        $data['train_stop_stations'] = $train_stop_stations->getTrainStopStations($data['train']->train_id);
       
        $route = new Routes();
        $data['route_stations'] = $route->getRouteStations($data['train']->train_route);
        

        // get the route_station_order of the train's start station
        $start_station = $data['train_stop_stations'][0]->station_id;
        $end_station = $data['train_stop_stations'][count($data['train_stop_stations']) - 1]->station_id;
        $data['route_stations'] = $route->getRouteStationsWithStartAndEndStaions($data['train']->train_route, $start_station, $end_station);


        $train_type = new TrainTypes();
        $data['train_type'] = $train_type->findAll();


        if (isset($_POST['update'])) {  
            try {

                if ( $train->validateUpdatetrain($_POST)) {

                    
                    if($train->updateTrain($id, $_POST)){
                        $this->redirect('StaffGeneral/getTrainList?update=1');
                    }else{
                        $_SESSION['errors'] = "Failed to update train";
                        $data['errors'] = $train->errors;
                        $this->view('update.train.staffgeneral', $data);
                    }
                    
                }
                else{
                    $data['errors'] = $train->errors;
                    $this->view('update.train.staffgeneral', $data);
                }

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            $this->view('update.train.staffgeneral', $data);
        }
    }

    function deleteTrain($id = '')
    {
        $train = new Trains();
        $data = array();

        // if(isset($_POST['delete'])){
        try {
            $result = $train->delete($id, "train_id");
            $this->redirect('StaffGeneral/getTrainList?delete=1');
        } catch (Exception $e) {
            die($e->getMessage());
        }
        // }
    }

}