<?php

class Passenger extends Controller
{
    function index($id = '')
    {

        $this->view('passenger.register');
    }

    function details($id = '')
    {
        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $data = array();
        $passenger = new Passengers();


        if (isset($_POST['user_nic']) && !empty($_POST['user_nic'])) {
            $passenger = new Passengers();
            $data = $passenger->validatePassenger($_POST);

            if (empty($data['errors'])) {

                $_SESSION['reservation']['passenger_data'] = $_POST;

                $this->redirect('passenger/billing');
            }
        }

        $this->view('passenger.details', $data);
    }

    function billing($id = '')
    {
        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $data = array();

        $fare =  new Fares();

        $price_for_one = $fare->getFareData($_SESSION['reservation']['train_type'], $_SESSION['reservation']['class_type'], $_SESSION['reservation']['from_station']->station_id, $_SESSION['reservation']['to_station']->station_id); //get from db must be changed
        $price_for_one = $price_for_one[0]->fare_price;
        if (isset($_SESSION['reservation']['passenger_data']) && !empty($_SESSION['reservation']['passenger_data'])) {
            $station = new Stations();
            $data['start_station'] = $station->getOneStation('station_id', $_SESSION['reservation']['from_station']->station_id);
            $data['end_station'] = $station->getOneStation('station_id', $_SESSION['reservation']['to_station']->station_id);

            $train = new Trains();
            $data['train'] = $train->whereOne('train_id', $_SESSION['reservation']['train_id']);

            $train_type = new TrainTypes();
            $data['train_type'] = $train_type->whereOne('train_type_id', $_SESSION['reservation']['train_type']);

            $compartment = new Compartments();
            $data['class'] = $compartment->whereOne('compartment_id', $_SESSION['reservation']['class_id']);


            $compartment_type = new CompartmentTypes();
            $data['class_type'] = $compartment_type->whereOne('compartment_class_type_id', $_SESSION['reservation']['class_id']);

            $data['no_of_passengers'] = $_SESSION['reservation']['no_of_passengers'];
            $data['price_for_one'] = $price_for_one;
            $data['price'] = $price_for_one * $_SESSION['reservation']['no_of_passengers'];
            $data['date'] = $_SESSION['reservation']['from_date'];


            $this->view('passenger.billing.summary', $data);
        } else {
            unset($_SESSION['reservation']);
            $this->view('home');
        }
        // $data = $passenger->getPassengers();
    }


    function payment($id = '')
    {
        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $data = Auth::payment($_POST['payment_data']);
        echo json_encode($data);
        
    }

    function addReservation()
    {

        $reaservation = new Reservations();
        try {
            $data = $reaservation->addReservation($_SESSION['reservation']);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        if ($data) {
            $this->redirect('passenger/summary', $data);
        } else {
            $this->redirect('passenger/billing');
        }
    }

    //add passenger
    function register($id = '')
    {
        $data = array();
        $passenger = new Passengers();

        if (isset($_POST['user_title'])) {
            $data = $passenger->addPassenger();

            if (!array_key_exists('errors', $data)) {
                // print_r($data);
                $this->redirect('login');
            } else {
                $errors['user_first_name'] = (array_key_exists('user_first_name', $data['errors'])) ? $data['errors']['user_first_name'] : '';
                $errors['user_last_name'] = (array_key_exists('user_last_name', $data['errors'])) ? $data['errors']['user_last_name'] : '';
                $errors['user_phone_number'] = (array_key_exists('user_phone_number', $data['errors'])) ? $data['errors']['user_phone_number'] : '';
                $errors['login_username'] = (array_key_exists('login_username', $data['errors'])) ? $data['errors']['login_username'] : '';
                $errors['login_password'] = (array_key_exists('login_password', $data['errors'])) ? $data['errors']['login_password'] : '';
            }
        }


        $this->view('passenger.register', $data);
    }

    function summary($id = '')
    {
        $data = array();

        // $data = $reservation->getOneReservation($_SESSION['reservation']);

        // summary not comming and selected reservation not comming in seats available layout

        $train_id = Auth::getTrain_id();
        $train = new Trains();
        $dataTrain = $train->whereOne('train_id', $train_id);

        $_SESSION['reservation']['train'] = $dataTrain; 

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";


        $this->view('passenger.summary', $data);
        // if (isset($_SESSION['reservation'])) {
        // } else {
        //     $this->redirect('home');
        // }
    }

    // reservations
    function reservation($id = '')
    {
        $data = array();
        // $reservation = new Reservations();
        // $data = $reservation->getReservationPassenger("reservation_passenger_id", $id);
        $this->view('passenger.reservations', $data);
    }

    // view reservation
    function viewReservation($id = '')
    {
        $data = array();
        $reservation = new Reservations();
        // $data = $reservation->getReservationPassenger("reservation_passenger_id", $id);
        $this->view('passenger.viewReservation', $data);
    }

    // recancel reservation


    // show reservation

}
