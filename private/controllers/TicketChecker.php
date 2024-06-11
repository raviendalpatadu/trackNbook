<?php

/**
 * TicketChecker controller
 */

class TicketChecker extends Controller
{

    function reservationList($id = '')
    {
        $resevation = new Reservations();

        $data = array();
        $seatData = array();
        $data['errors'] = array();


        $compartment = new Compartments();
        $ticketcheker = new TicketCheckers();

        // compartment is required
        // if ($_POST['compartment'] == "0" &&  isset($_POST['submit']) ){
        //     $data['compartment'] =  $ticketcheker->errors['errors']['compartment'] = 'Compartment is required';
        // }






        // $compartment_types = new CompartmentTypes();
        $data['compartment'] = $compartment->getCompartment($_SESSION['work_train']);


        $train = new Trains();
        $data['from_train'] = $train->whereOne('train_id', $_SESSION['work_train']);

        $seatData['from']['reservation_train_id'] = $_SESSION['work_train'];
        $seatData['from']['reservation_compartment_id'] = $data['compartment'][0]->compartment_id;
        $seatData['from']['reservation_date'] = date('Y-m-d');
        $seatData['from']['reservation_start_station'] = $data['from_train']->train_start_station;
        $seatData['from']['reservation_end_station'] = $data['from_train']->train_end_station;



        if (isset($_POST['submit']) && $_POST['submit'] == 'Search') {

            $seatData['from']['reservation_compartment_id'] = $_POST['compartment'];
        }



        $seat = new Seats();
        $data['from_reservation_seats'] = $seat->getReservedSeatsTicketChecker($seatData['from']);

        $compartment = new Compartments();
        $data['from_compartment'] = $compartment->whereOne('compartment_id', $seatData['from']['reservation_compartment_id']);

        $compartment_types = new CompartmentTypes();
        $data['from_compartment_type'] = $compartment_types->whereOne('compartment_class_type_id', $data['from_compartment']->compartment_class_type);

        $this->view('reservation.ticketchecker.new', $data);
    }

    function reservationTable($id = '')
    {
        $resevation = new Reservations();

        $train = new Trains();

        $data = array();

        $data['trains'] = $train->findAll();
        $data['reservations'] = $resevation->getReservation();
        if (isset($_POST['submit']) && !empty($_POST['reservation_date'])) {
            $data['reservations'] = $resevation->getReservations('reservation_date', $_POST['reservation_date']);
        }
        if (isset($_POST['submit']) && !empty($_POST['reservation_passenger_nic'])) {
            $data['reservations'] = $resevation->getReservations('reservation_passenger_nic', $_POST['reservation_passenger_nic']);
        }
        if (isset($_POST['submit']) && !empty($_POST['reservation_train_id'])) {
            $data['reservations'] = $resevation->getReservations('reservation_train_id', $_POST['reservation_train_id']);
        }
        $this->view('reservation.ticketchecker', $data);
    }


    function option($id = '')
    {
        if (!Auth::is_logged_in() || !Auth::isUserType('ticket_checker')) {
            $this->redirect('login');
        }

        if (isset($_SESSION['work_train'])) {
            $this->redirect('ticketchecker/dashboard');
        }

        $data = array();
        $data['errors'] = array();

        if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['submit'])) {

            $ticketcheker = new TicketCheckers();
            $work_train = $ticketcheker->validateTicketChecker($_POST);

            $train = new Trains();

            $train_data = $train->whereOne('train_no', $_POST['train_id']);

            if ($work_train) {
                $_SESSION['work_train'] = $train_data->train_id;
                $this->redirect('ticketchecker/dashboard');
            } else {
                $data['errors'] = $ticketcheker->errors;
            }
        }





        $this->view('option.ticketchecker', $data);
    }

    function index($id = '')
    {
        // $resevation = new Reservations();

        // $train = new Trains();

        // $data = array();

        // $data['trains'] = $train->findAll();
        // $data['reservations'] = $resevation->getReservation();
        // if (isset($_POST['submit']) && !empty($_POST['reservation_date'])) {
        //     $data['reservations'] = $resevation->getReservations('reservation_date', $_POST['reservation_date']);
        // }
        // if (isset($_POST['submit']) && !empty($_POST['reservation_passenger_nic'])) {
        //     $data['reservations'] = $resevation->getReservations('reservation_passenger_nic', $_POST['reservation_passenger_nic']);
        // }
        // if (isset($_POST['submit']) && !empty($_POST['reservation_train_id'])) {
        //     $data['reservations'] = $resevation->getReservations('reservation_train_id', $_POST['reservation_train_id']);
        // }


        $this->view('dashboard.ticketchecker');
    }

    function summary($id = '')
    {

        if (!Auth::is_logged_in() || !Auth::isUserType('ticket_checker')) {
            $this->redirect('login');
        }

        $resevation = new Reservations();
        $fare = new Fares();
        $train = new Trains();
        $compartment = new Compartments();

        $data = array();
        $data['reservations'] = $resevation->getReservationDataTicket($id);

        $train_type = $train->whereOne('train_id', $data['reservations'][0]->reservation_train_id);

        $data['train'] = $train->getTrain($data['reservations'][0]->reservation_train_id);

        $compartment_type = $compartment->whereOne('compartment_id', $data['reservations'][0]->reservation_compartment_id);

        $data['compartment'] = $compartment_type->compartment_class_type;

        $station = new Stations();
        $start_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_start_station);
        $end_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_end_station);

        $data['fares'] = $fare->getFareData($train_type->train_type, $compartment_type->compartment_class_type, $start_station->station_id, $end_station->station_id);


        $this->view('summary.ticketchecker', $data);
    }

    function QR($id = '')
    {

        $resevation = new Reservations();
        $data = array();
        $data['reservations'] = $resevation->getReservationDataTicket($id);



        $this->view('QRSearch.ticketchecker');
    }

    function checkTicket($id = '')
    {

        $reservation = new Reservations();

        $reservation->update($id, array(
            // 'reservation_ticket_id' => $reservation_ticket_id,
            'reservation_is_travelled' => '1'
        ), "reservation_ticket_id");
        $this->redirect('ticketchecker/reservationList');
    }

    function ScanDetails($id = '')
    {

        $this->view('ScanDetails.ticketchecker');
    }
}
