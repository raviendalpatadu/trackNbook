<?php

/**
 * home controller
 */


class Train extends Controller
{
    function index($id = '')
    {
        $this->view('trains');
    }

    function trainsAvailableValidate()
    {
        if (!isset(Auth::reservation()['from_date']) || !isset(Auth::reservation()['from_station']) || !isset(Auth::reservation()['to_station']) || !isset(Auth::reservation()['no_of_passengers'])) {
            $this->redirect('/home');
        }

        $train = new Trains();
        if ($train->trainsAvailableValidate($_POST)) :
            echo json_encode(true);
        else :
            echo json_encode($train->errors);
        endif;
    }

    function available($id = '')
    {
        if (!isset(Auth::reservation()['from_date']) || !isset(Auth::reservation()['from_station']) || !isset(Auth::reservation()['to_station']) || !isset(Auth::reservation()['no_of_passengers'])) {
            $this->redirect('/home');
        }

        $station = new Stations();
        $data = array();

        $train = new Trains();


        if (($id == 'modifysearch' || $id == 'seatsearch') && $_SERVER['REQUEST_METHOD'] == 'POST') {
            $data['from_date'] = $_POST['from_date'];
            $data['from_station'] = $station->getOneStation('station_id', $_POST['from_station']);
            $data['to_station'] = $station->getOneStation('station_id', $_POST['to_station']);
            $data['no_of_passengers'] = $_POST['no_of_passengers'];
            $data['return'] = (isset($_POST['return'])) ? $_POST['return'] : 0;


            if (isset($_POST['to_date'])) {
                $data['to_date'] = $_POST['to_date'];
            }

            $_SESSION['reservation'] = $data;

            if ($id == 'seatsearch') {
                $_SESSION['reservation']['from_compartment_and_train'] = mb_split('-', $_POST['from_compartment_and_train']);
                if (isset($_POST['to_compartment_and_train'])) {
                    $_SESSION['reservation']['to_compartment_and_train'] = mb_split('-', $_POST['to_compartment_and_train']);
                }

                $this->redirect('train/seatsAvailable/' . $_SESSION['reservation']['from_compartment_and_train'][0] . '/' . $_SESSION['reservation']['from_compartment_and_train'][1]);
            }
        }

        $data = $_SESSION['reservation'];


        $data['stations'] = $station->findAll();

        if (isset($data['to_date']) && $data['to_date'] != '') {
            $inverse_search['from_station'] = $data['to_station'];
            $inverse_search['to_station'] = $data['from_station'];
            $inverse_search['from_date'] = $data['to_date'];
            $inverse_search['no_of_passengers'] = $data['no_of_passengers'];
            $data['trains_available']['to_trains'] = $train->search($inverse_search);
        }


        $data['trains_available']['from_trains'] = $train->search($_SESSION['reservation']);


        $this->view('trains.available', $data);
    }

    function availableNew($id = '')
    {
        $station = new Stations();
        $data = array();

        $data['stations'] = $station->findAll();

        $this->view('trains.available.new', $data);
    }

    function seatsAvailable()
    {
        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $data = array();
        $seatData = array();

        $seatData['from']['reservation_train_id'] = Auth::reservation()['from_compartment_and_train'][1];
        $seatData['from']['reservation_compartment_id'] = Auth::reservation()['from_compartment_and_train'][0];
        $seatData['from']['reservation_date'] = Auth::reservation()['from_date'];
        $seatData['from']['reservation_start_station'] = Auth::reservation()['from_station']->station_id;
        $seatData['from']['reservation_end_station'] = Auth::reservation()['to_station']->station_id;

        $train = new Trains();
        $data['from_train'] = $train->whereOne('train_id', Auth::reservation()['from_compartment_and_train'][1]);

        $seat = new Seats();
        $data['from_reservation_seats'] = $seat->getReservedSeats($seatData['from']);

        $compartment = new Compartments();
        $data['from_compartment'] = $compartment->whereOne('compartment_id', Auth::reservation()['from_compartment_and_train'][0]);

        $compartment_types = new CompartmentTypes();
        $data['from_compartment_type'] = $compartment_types->whereOne('compartment_class_type_id', $data['from_compartment']->compartment_class_type);

        $fare =  new Fares();
        $data['from_fare'] = $fare->getFareData($data['from_train']->train_type, $data['from_compartment']->compartment_class_type, Auth::reservation()['from_station']->station_id, Auth::reservation()['to_station']->station_id)[0]; //get from db must be changed

        if (Auth::reservation()['return'] == 'on') {
            $seatData['to']['reservation_train_id'] = Auth::reservation()['to_compartment_and_train'][1];
            $seatData['to']['reservation_compartment_id'] = Auth::reservation()['to_compartment_and_train'][0];
            $seatData['to']['reservation_date'] = Auth::reservation()['to_date'];
            $seatData['to']['reservation_start_station'] = Auth::reservation()['to_station']->station_id;
            $seatData['to']['reservation_end_station'] = Auth::reservation()['from_station']->station_id;

            $data['to_train'] = $train->whereOne('train_id', Auth::reservation()['to_compartment_and_train'][1]);

            $seatnew = new Seats();
            $data['to_reservation_seats'] = $seatnew->getReservedSeats($seatData['to']);

            $data['to_compartment'] = $compartment->whereOne('compartment_id', Auth::reservation()['to_compartment_and_train'][0]);

            $data['to_compartment_type'] = $compartment_types->whereOne('compartment_class_type_id', $data['to_compartment']->compartment_class_type);

            $data['to_fare'] = $fare->getFareData($data['to_train']->train_type, $data['to_compartment']->compartment_class_type, Auth::reservation()['to_station']->station_id, Auth::reservation()['from_station']->station_id)[0]; //get from db must be changed

        }


        if (isset($_POST['submit']) || $_POST) {
            if (!Auth::is_logged_in()) {
                $_SESSION['error'] = 'Please Login to continue.';
                $this->redirect('login');
            }
    


            $reservation = new Reservations();

            $reservationData = array();
            $reservationData['from']['reservation_passenger_id'] = Auth::user_id();
            $reservationData['from']['reservation_train_id'] = Auth::reservation()['from_compartment_and_train'][1];
            $reservationData['from']['reservation_compartment_id'] = Auth::reservation()['from_compartment_and_train'][0];
            $reservationData['from']['reservation_start_station'] = Auth::reservation()['from_station']->station_id;
            $reservationData['from']['reservation_end_station'] = Auth::reservation()['to_station']->station_id;
            $reservationData['from']['reservation_date'] = Auth::reservation()['from_date'];

            date_default_timezone_set('Asia/Colombo');
            $reservationData['from']['reservation_created_time'] = date('Y-m-d h:i:s', time());

            $reservationData['from']['reservation_status'] = 'Pending';

            $data['reservation_created_time'] = $reservationData['from']['reservation_created_time'];
            $data['reservation_status'] = $reservationData['from']['reservation_status'];

            if (isset($_POST['from_selected_seats'])) {
                $reservationData['from']['reservation_seat'] = $_POST['from_selected_seats'];
            } else {
                $reservationData['from']['reservation_seat'] = array();
            }

            $reservationData['from']['no_of_passengers'] = Auth::reservation()['no_of_passengers'];

            if (!$seat->validate($reservationData['from'])) {
                $data = array_merge($data, $seat->errors);
            }

            // is return set 
            if (Auth::reservation()['return'] == 'on') {
                $reservationData['to']['reservation_passenger_id'] = Auth::user_id();
                $reservationData['to']['reservation_train_id'] = Auth::reservation()['to_compartment_and_train'][1];
                $reservationData['to']['reservation_compartment_id'] = Auth::reservation()['to_compartment_and_train'][0];
                $reservationData['to']['reservation_start_station'] = Auth::reservation()['to_station']->station_id;
                $reservationData['to']['reservation_end_station'] = Auth::reservation()['from_station']->station_id;
                $reservationData['to']['reservation_date'] = Auth::reservation()['to_date'];

                $reservationData['to']['reservation_created_time'] = date('Y-m-d h:i:s', time());
                $reservationData['to']['reservation_status'] = 'Pending';

                if (isset($_POST['to_selected_seats'])) {
                    $reservationData['to']['reservation_seat'] = $_POST['to_selected_seats'];
                } else {
                    $reservationData['to']['reservation_seat'] = array();
                }

                $reservationData['to']['no_of_passengers'] = Auth::reservation()['no_of_passengers'];

                if (!$seat->validate($reservationData['to'])) {
                    $data = array_merge($data, $seat->errors);
                }
            }

            if (!isset($data['errors'])) {

                foreach ($_POST['from_selected_seats'] as $seat) {
                    $reservationData['from']['reservation_seat'] = $seat;

                    $data['reservation_id']['from'][] = $reservation->insert($reservationData['from']);
                }

                if (Auth::reservation()['return'] == 'on') {
                    foreach ($_POST['to_selected_seats'] as $seat) {
                        $reservationData['to']['reservation_seat'] = $seat;

                        $data['reservation_id']['to'][] = $reservation->insert($reservationData['to']);
                    }
                }
                // remove array key reservation_seats from $data
                unset($data['from_reservation_seats']);

                if (Auth::reservation()['return'] == 'on') {
                    // unset($data['to_reservation_seats']);
                }

                // add post['selected_seats'] to $data
                $data['from_selected_seats'] = $_POST['from_selected_seats'];

                if (Auth::reservation()['return'] == 'on') {
                    $data['to_selected_seats'] = $_POST['to_selected_seats'];
                }

                $_SESSION['reservation'] = array_merge($_SESSION['reservation'], $data);

                $this->redirect('passenger/details');
            }
        }

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";  




        $this->view('seats.available', $data);
    }

    function track($id = '')
    {

        
        $this->view('track');
    }

    public function add()
    {
        if (!Auth::is_logged_in()) {
            $this->redirect('/login');
        }

        $data = array();

        //get route stations
        $route = new Routes();
        $data['routes'] = $route->findAll();


        $compartment_types = new CompartmentTypes();
        $data['compartment_types'] = $compartment_types->findAll();

        $train_type = new TrainTypes();
        $data['train_types'] = $train_type->findAll();

        $station = new Stations();
        $data['stations'] = $station->findAll();

        if (isset($_POST['submit'])) {

            $train = new Trains(); 

            if ($train->addTrainValidate()) {
                $train->addTrain();

                $this->redirect('train/add?success=1');
            } else {
                $data['errors'] = $train->errors;
            }
        }

        $this->view('add.trains', $data);
    }

    public function addToWaitingList()
    {
        $waitingList = new WaitingLists();

        if ($waitingList->validate($_POST)) :
            try {
                $waitingList->insert($_POST);
                echo json_encode(true);
            } catch (PDOException $e) {

                echo json_encode($e);
            }
        else :
            echo json_encode($waitingList->errors);
        endif;
    }
}
