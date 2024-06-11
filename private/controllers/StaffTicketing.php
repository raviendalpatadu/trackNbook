<?php

/**
 * staffticketing controller
 */

class StaffTicketing extends Controller
{
    function index($id = '')

    {
        $reaservation = new Reservations();
        $inquiry = new Inquiries();
        $warrant_reservation = new WarrantsReservations();

        $data = array();
        $data['reservations'] = $reaservation->getReservation();
        $data['cancel_reservations'] = $reaservation->getCancelReservations();
        $data['inquiries'] = $inquiry->getInquiry();
        $data['warrant_reservations'] = $warrant_reservation->getjoinReservation();


        $this->view('staff_ticketing.dashboard',$data);
    }


    function reservation($id = '')
    {
        $station = new Stations();
        $data = array();
        $data['stations'] = $station->getStations();
        $data['trains_available'] = array();
        $data['trains_available']['from_trains'] = array();


        // if (isset($_SESSION['reservation'])) {
        //     if (isset(Auth::reservation()['reservation_status']) && Auth::reservation()['reservation_status'] == "Pending") {
        //         $reservation = new Reservations();
        //         try {
        //             foreach (Auth::reservation()['reservation_id']['from'] as $key => $value) {
        //                 $reservation->callProcedure('expire_reservation', array($value));
        //             }

        //             if (Auth::reservation()['return'] == 'on') {
        //                 foreach (Auth::reservation()['reservation_id']['to'] as $key => $value) {
        //                     $reservation->callProcedure('expire_reservation', array($value));
        //                 }
        //             }


        //         } catch (Exception $e) {
        //             die($e->getMessage());
        //         }
        //     }

        //     unset($_SESSION['reservation']);
        // }

        // if (isset($_SESSION['errors'])) {
        //     $data['errors'] = $_SESSION['errors'];
        //     unset($_SESSION['errors']);
        // }
        // unset($_SESSION['error']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['submit'])) {

            $home = new Homes();

            if ($home->validate($_POST) == false) {
                // concat 2 arrays
                $data = array_merge($data, $home->errors);
            } else {

                $data['from_date'] = $_POST['from_date'];
                $data['from_station'] = $station->getOneStation('station_id', $_POST['from_station']);
                $data['to_station'] = $station->getOneStation('station_id', $_POST['to_station']);
                $data['no_of_passengers'] = $_POST['no_of_passengers'];
                $data['return'] = (isset($_POST['return'])) ? $_POST['return'] : 0;

                if (isset($_POST['to_date'])) {
                    $data['to_date'] = $_POST['to_date'];
                }



                $_SESSION['reservation'] = $data;

                $train = new Trains();
                $data['trains_available']['from_trains'] = $train->search($_SESSION['reservation']);

                if (isset($data['to_date']) && $data['to_date'] != '') {
                    $inverse_search['from_station'] = $data['to_station'];
                    $inverse_search['to_station'] = $data['from_station'];
                    $inverse_search['from_date'] = $data['to_date'];
                    $inverse_search['no_of_passengers'] = $data['no_of_passengers'];
                    $data['trains_available']['to_trains'] = $train->search($inverse_search);
                }



                if (isset($_POST['from_compartment_and_train'])) {
                    $_SESSION['reservation']['from_compartment_and_train'] = mb_split('-', $_POST['from_compartment_and_train']);
                    if (isset($_POST['to_compartment_and_train'])) {
                        $_SESSION['reservation']['to_compartment_and_train'] = mb_split('-', $_POST['to_compartment_and_train']);
                    }

                    if (isset(Auth::reservation()['stations'])) {
                        unset(Auth::reservation()['stations']);
                    }

                    $this->redirect('staffticketing/seatmap/' . $_SESSION['reservation']['from_compartment_and_train'][0] . '/' . $_SESSION['reservation']['from_compartment_and_train'][1]);
                }
            }
        }

        $this->view('booking.staffticketing', $data);
    }

    function seatMap($id = '')
    {
        $data = array();
        $seatData = array();

        // from
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
        // to
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

                $this->redirect('staffticketing/passengerdetails');
            }
        }

        $this->view('seatmap.staffticketing', $data);
    }


    function passengerdetails($id = '')
    {
        $data = array();

        if (isset($_POST['reservation_passenger_nic']) && !empty($_POST['reservation_passenger_nic'])) {

            $reservation = new Reservations();

            if ($reservation->validateStaffTicketing($_POST)) {
                echo "<pre>";
                // print_r($_SESSION);
                echo "</pre>";


                $_SESSION['reservation']['passenger_data'] = $_POST;

                if (!isset($_POST['warrant_booking'])) {
                    // echo "off";
                    $_SESSION['reservation']['passenger_data']['warrant_booking'] = "off";
                }

                $reaservation = new Reservations();
                try {
                    $count = 0;
                    if (isset(Auth::reservation()['reservation_id']['from']) && count(Auth::reservation()['reservation_id']['from']) == Auth::reservation()['no_of_passengers']) {


                        // loop thourugh from reservation id's
                        foreach (Auth::reservation()['reservation_id']['from'] as $key => $reservation_id) {
                            $reservationPassengerData = array();

                            $reservationPassengerData['reservation_id'] = $reservation_id;
                            $reservationPassengerData['reservation_passenger_nic'] = $_POST['reservation_passenger_nic'][$count];
                            $reservationPassengerData['reservation_passenger_first_name'] = $_POST['reservation_passenger_first_name'][$count];
                            $reservationPassengerData['reservation_passenger_last_name'] = $_POST['reservation_passenger_last_name'][$count];
                            $reservationPassengerData['reservation_passenger_title'] = $_POST['reservation_passenger_title'][$count];
                            $reservationPassengerData['reservation_passenger_phone_number'] = $_POST['reservation_passenger_phone_number'][$count];
                            $reservationPassengerData['reservation_is_dependent'] = $_POST['reservation_is_dependent'][$count];
                            $reservationPassengerData['reservation_passenger_email'] = $_POST['reservation_passenger_email'][$count];
                            $reservationPassengerData['reservation_passenger_gender'] = $_POST['reservation_passenger_gender'][$count];
                            $reservationPassengerData['reservation_amount'] = Auth::reservation()['from_fare']->fare_price;

                            //update passenger details to tbl_reservtion
                            $data = $reaservation->update($reservation_id, $reservationPassengerData, 'reservation_id');

                            // update warrant reservations table
                            if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                                $reaservationPassengerArr = [];
                                $reaservationPassengerArr['reservation_type'] = 'Warrant';
                                $reaservation->update($reservation_id, $reaservationPassengerArr, 'reservation_id');
                                // if warrant image is null throw an execption
                                $warrant_reservation = new WarrantsReservations();
                                $warrant_reservation->update($reservation_id, ['warrant_image_id' => null, 'warrant_status' => 'Completed'], 'warrant_reservation_id');

                                $_SESSION['reservation']['reservation_status'] = "Reserved";
                            }


                            $count++;
                        }

                        // to reservation details
                        if (Auth::getReturn() == 'on' && isset(Auth::reservation()['reservation_id']['to'])) {
                            $count = 0;
                            foreach (Auth::reservation()['reservation_id']['to'] as $key => $reaservation_id) {
                                $reservationPassengerDataTo = array();
                                $reservationPassengerDataTo['reservation_id'] = $reaservation_id;
                                $reservationPassengerDataTo['reservation_passenger_nic'] = $_POST['reservation_passenger_nic'][$count];
                                $reservationPassengerDataTo['reservation_passenger_first_name'] = $_POST['reservation_passenger_first_name'][$count];
                                $reservationPassengerDataTo['reservation_passenger_last_name'] = $_POST['reservation_passenger_last_name'][$count];
                                $reservationPassengerDataTo['reservation_passenger_title'] = $_POST['reservation_passenger_title'][$count];
                                $reservationPassengerDataTo['reservation_passenger_phone_number'] = $_POST['reservation_passenger_phone_number'][$count];
                                $reservationPassengerDataTo['reservation_is_dependent'] = $_POST['reservation_is_dependent'][$count];
                                $reservationPassengerDataTo['reservation_passenger_email'] = $_POST['reservation_passenger_email'][$count];
                                $reservationPassengerDataTo['reservation_passenger_gender'] = $_POST['reservation_passenger_gender'][$count];
                                $reservationPassengerDataTo['reservation_amount'] = Auth::reservation()['to_fare']->fare_price;


                                $data = $reaservation->update($reaservation_id, $reservationPassengerDataTo, 'reservation_id');

                                if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                                    $reaservationPassengerArr = [];
                                    $reaservationPassengerArr['reservation_type'] = 'Warrant';
                                    $reaservation->update($reservation_id, $reaservationPassengerArr, 'reservation_id');

                                    // if warrant image is null throw an execption
                                    $warrant_reservation = new WarrantsReservations();
                                    $warrant_reservation->update($reservation_id, ['warrant_image_id' => null, 'warrant_status' => 'Completed'], 'warrant_reservation_id');

                                    $_SESSION['reservation']['reservation_status'] = "Reserved";
                                }

                                $count++;
                            }
                        }
                    } else {
                        $data['errors'][] = "Error in reservation id doesn't match with passenger count. Please try again.";
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }

                // if redirect according to the reservation type
                if (empty($data['errors'])) {

                    if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                        // send email to each email
                        foreach (Auth::reservation()['passenger_data']['reservation_passenger_email'] as $key => $email) {
                            // check wheather the email is not empty

                            $to_email = $email;
                            $subject = "Reservation Successfull - Warrant";
                            $recipient = Auth::reservation()['passenger_data']['reservation_passenger_first_name'][$key];


                            $message = Auth::getReservationConfirmationEmailBody(Auth::reservation()['passenger_data']['reservation_passenger_first_name'][$key]);

                            $this->sendMail($to_email, $recipient, $subject, $message);
                        }

                        $this->redirect('staffticketing/addreservation');
                    }

                    $this->redirect('staffticketing/pay');
                }
            } else {
                $data['errors'] = $reservation->__get('errors');
            }
        }

        $this->view('details.staffticketing', $data);
    }

    // function payment($id = '')
    // {
    //     $data = array();
    //     $data = $_SESSION['reservation'];
    //     $this->view('staffticketing.payment', $data);
    // }


    function addReservation()
    {
        if (!Auth::is_logged_in()) {
            $this->redirect('/staffTicketing');
        }

        if (!Auth::reservation()) {
            $this->redirect('/');
        }

        $reaservation = new Reservations();
        try {
            // $data = $reaservation->addReservation($_SESSION['reservation']);
            $reservationPassengerData = array();
            $reservationPassengerData['reservation_ticket_id'] = Auth::getTicketId();


            foreach (Auth::reservation()['reservation_id']['from'] as $key => $value) {
                $reservationPassengerData['reservation_status'] = "Reserved"; // 1 for confirmed
                $reaservation->update($value, $reservationPassengerData, 'reservation_id');
            }
            $_SESSION['reservation']['from_reservation_ticket_id'] = $reservationPassengerData['reservation_ticket_id'];

            if (Auth::getReturn() == 'on' && isset(Auth::reservation()['reservation_id']['to'])) {
                $reservationPassengerDataTo = array();
                $reservationPassengerDataTo['reservation_ticket_id'] = Auth::getTicketId();

                foreach (Auth::reservation()['reservation_id']['to'] as $key => $value) {
                    $reservationPassengerDataTo['reservation_status'] = "Reserved"; // 1 for confirmed
                    $reaservation->update($value, $reservationPassengerDataTo, 'reservation_id');
                }

                $_SESSION['reservation']['to_reservation_ticket_id'] = $reservationPassengerDataTo['reservation_ticket_id'];
            }

            // add reservation data to session['reservation']
            $_SESSION['reservation']['reservation_status'] = "Reserved";

            // if in waitnig list remove from waiting list
            $waiting_list = new WaitingLists();
            $waiting_list_arr['waiting_list_passenger_id'] = Auth::getUser_id();
            $waiting_list_arr['waiting_list_train_id'] = Auth::reservation()['from_train']->train_id;
            $waiting_list_arr['waiting_list_compartment_id'] = Auth::reservation()['from_compartment']->compartment_id;
            $waiting_list_arr['waiting_list_reservation_date'] = Auth::reservation()['from_date'];

            if ($waiting_list->inWaitingList($waiting_list_arr)) {
                $waiting_list->removeFromWaitingList($waiting_list_arr);
            }


            $this->redirect('staffticketing/reservationSummary');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    function reservationSummary()
    {
        $data = array();

        $data = $_SESSION['reservation'];
        $this->view('reservation.summary.staffticketing', $data);
    }

    function summary($id = '')
    {
        $resevation = new Reservations();
        $train = new Trains();
        $fare = new Fares();
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

        $this->view('summary.staffticketing', $data);
    }


    function pay($id = '')
    {

        $this->view('ticket.staffticketing');
    }

    // function summary($id = '')
    // {
    //     $resevation = new Reservations();
    //     $data = array();
    //     $data['reservations'] = $resevation->whereOne("reservation_id", $id);

    //     $train = new Trains();
    //     $data['train'] = $train->getTrain($data['reservations']->reservation_train_id);

    //     $this->view('summary.staffticketing', $data);
    // }





    function reservationList($id = '')
    {
        $resevation = new Reservations();


        $train = new Trains();

        $data = array();


        $data['reservations'] = $resevation->getReservation();

        if (isset($_POST['submit']) && !empty($_POST['reservation_date'])) {
            $data['reservations'] = $resevation->where('reservation_date', $_POST['reservation_date']);
        }
        if (isset($_POST['submit']) && !empty($_POST['reservation_passenger_nic'])) {
            $data['reservations'] = $resevation->where('reservation_passenger_nic', $_POST['reservation_passenger_nic']);
        }
        if (isset($_POST['submit']) && !empty($_POST['reservation_ticket_id'])) {

            $data['reservations'] = $resevation->where('reservation_ticket_id', $_POST['reservation_ticket_id']);
        }




        $this->view('reservation.staffticketing', $data);
    }

    function warrant($id = '')
    {
        $warrent_resevation = new WarrantsReservations();

        $train = new Trains();

        $data = array();

        $data['trains'] = $train->findAllTrains();
        $data['reservations'] = $warrent_resevation->getjoinReservation();


        if (isset($_POST['submit']) && !empty($_POST['reservation_date'])) {
            $data['reservations'] = $warrent_resevation->getjoinReservation('r.reservation_date', $_POST['reservation_date']);
        }
        if (isset($_POST['submit']) && !empty($_POST['reservation_passenger_nic'])) {
            $data['reservations'] = $warrent_resevation->getjoinReservation('r.reservation_passenger_nic', $_POST['reservation_passenger_nic']);
        }
        if (isset($_POST['submit']) && !empty($_POST['reservation_ticket_id'])) {
            $data['reservations'] = $warrent_resevation->getjoinReservation('r.reservation_ticket_id', $_POST['reservation_ticket_id']);
        }


        $this->view('warrants.staffticketing', $data);
    }

    function displayWarrent($warrant_id, $tikcet_id)
    {
        $warrant_resevation = new WarrantsReservations();
        $data = array();

        $data['warrant_reservations'] = $warrant_resevation->getReservations($warrant_id);


        $reservation  = new Reservations();
        $data['reservations'] = $reservation->getReservationDataTicket($tikcet_id);


        $train = new Trains();
        $data['train'] = $train->getTrain($data['reservations'][0]->reservation_train_id)[0];

        $warrant_image = new WarrantImages();
        $data['warrant_img'] = $warrant_image->whereOne('warrant_image_id', $data['warrant_reservations'][0]->warrant_image_id);

        $this->view('display.warrant.staffticketing', $data);
    }

    // call getWarrantImage function from controller reffer user controller getUserImage function

    // public function getWarrantImage($folder, $file)
    // {

    //     $warrant_resevation = new WarrantsReservations();
    //     $data = array();

    //     $this->getPrivateImage($folder, $file);
    // }



    function cancel($id = '')
    {
        $reservation = new Reservations();
        $train = new Trains();
        $fare = new Fares();
        $compartment = new Compartments();

        $data = array();


        if (isset($_POST['reservation_ticket_id']) && !empty($_POST['reservation_ticket_id'])) {

            $data['reservations'] = $reservation->getReservationDataTicket($_POST['reservation_ticket_id']);

            if (isset($data['reservations']) && !empty($data['reservations']) && $data['reservations'] != 0) {
                $train_type = $train->whereOne('train_id', $data['reservations'][0]->reservation_train_id);
                $data['train'] = $train->getTrain($data['reservations'][0]->reservation_train_id);
                $compartment_type = $compartment->whereOne('compartment_id', $data['reservations'][0]->reservation_compartment_id);
                $data['compartment'] = $compartment_type->compartment_class_type;

                $station = new Stations();
                $start_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_start_station);
                $end_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_end_station);
                $data['fares'] = $fare->getFareData($train_type->train_type, $compartment_type->compartment_class_type, $start_station->station_id, $end_station->station_id);

                $data['refund'] = $reservation->getRefund($_POST['reservation_ticket_id'],  $data['fares'][0]->fare_price);
            }
        }


        // reservation_model eken getRefundDetails function eka call karanna ona
        // $reservation->callProcedure('cancel_reservation', ['20240408115213-4158']);

        // if (isset($_POST['reservation_passenger_nic']) && !empty($_POST['reservation_passenger_nic']) && isset($_POST['reservation_id']) && !empty($_POST['reservation_id'])) {
        //     $reservation = new Reservations();

        //     $result = $reservation->cancelReservation($_POST['reservation_id'], $_POST['reservation_passenger_nic']);
        //     if ($result) {
        //         $this->redirect('staffticketing/reservationList');
        //     }
        // } else {
        //     $this->view('cancellation.staffticketing', $data);
        // }
        $this->view('cancel.staffticketing', $data);
    }


    function cancelList($id = '')

    {

        $cancel_res = new Reservations();
        $data = array();

        $data['cancel_reservations'] = $cancel_res->getCancelReservations();
        // echo "<pre>";
        // print_r($data['cancel_reservations']);
        // echo "</pre>";

        $this->view('cancellation.staffticketing', $data);
    }

    function cancelResSummary($id)
    {
        $resevation = new Reservations();
        $train = new Trains();
        $fare = new Fares();
        $compartment = new Compartments();

        $data = array();

        $data['reservations'] = $resevation->getCancelReservationSummary($id);

        $train_type = $train->whereOne('train_id', $data['reservations'][0]->reservation_train_id);

        $data['train'] = $train->getTrain($data['reservations'][0]->reservation_train_id);

        $compartment_type = $compartment->whereOne('compartment_id', $data['reservations'][0]->reservation_compartment_id);

        $data['compartment'] = $compartment_type->compartment_class_type;

        $station = new Stations();
        $start_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_start_station);
        $end_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_end_station);

        $data['fares'] = $fare->getFareData($train_type->train_type, $compartment_type->compartment_class_type, $start_station->station_id, $end_station->station_id);

        $this->view('cancel.summary.staffticketing', $data);
    }

    // function refund($id = '')
    // {


    //     $this->view('make_refund.staffticketing');
    // }

    // function refundList($id = '')
    // {

    //     $this->view('refund_list.staffticketing');
    // }

    // function refundDetails($id = '')
    // {

    //     $this->view('refund_details.staffticketing');
    // }




    function verifiedWarrent($ticket_id = '')
    {
        $warrant_resevation = new WarrantsReservations();
        $reservation = new Reservations();
        // echo $id;
        try {
            $warrant_data = $warrant_resevation->getReservationsByTicketNo($ticket_id);

            foreach ($warrant_data as $key => $warrant) {
                $warrant_resevation->update($warrant->warrant_id, array(
                    'warrant_status' => 'Verified'
                ), "warrant_id");
                // // $new_ticket_id = Auth::getTicketId();

                // $reservation = new Reservations();
                $reservation->update($warrant->reservation_id, array(
                    // 'reservation_ticket_id' => $reservation_ticket_id,
                    'reservation_status' => 'Reserved'
                ), "reservation_id");
            }



            // send mail
            foreach ($warrant_data as $warrant) {
                // incase if the email is not set
                if ($warrant->reservation_passenger_email == null || $warrant->reservation_passenger_email == '') {
                    continue;
                }

                try {
                    $name = ucfirst($warrant->reservation_passenger_first_name);
                    $subject = "Warrant Reservation has been Approved";
                    $message = "Your warrant has been Verified. In order to get the ticket please provide your warrant document to your depature station on or before the day of travel. <br><br> *Please note that if the submitted warrant document is not correct or if there is any defect it will be
                    rejected and Department of Railways shall not be responsible for any inconvenience caused by the rejection of the reservation";
                    $body = Auth::getEmailBody($name, $message);
                    $to = $warrant->reservation_passenger_email;

                    // echo $body;
                    if (!$this->sendMail($to, $name, $subject, $body)) {
                        die('failed to send mail');
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $this->redirect('staffticketing/Warrant?success=1');
    }

    function completeWarrant($ticket_id)
    {
        $warrant_resevation = new WarrantsReservations();
        $reservation = new Reservations();
        // echo $id;
        try {
            $warrant_data = $warrant_resevation->getReservationsByTicketNo($ticket_id);

            foreach ($warrant_data as $key => $warrant) {
                $warrant_resevation->update($warrant->warrant_id, array(
                    'warrant_status' => 'Completed'
                ), "warrant_id");

                $new_ticket_id = Auth::getTicketId();

                $reservation->update($warrant->reservation_id, array(
                    'reservation_ticket_id' => $new_ticket_id,
                    'reservation_status' => 'Reserved'
                ), "reservation_id");
            }

            // send mail
            foreach ($warrant_data as $warrant) {
                // incase if the email is not set
                if ($warrant->reservation_passenger_email == null || $warrant->reservation_passenger_email == '') {
                    continue;
                }

                try {
                    $name = ucfirst($warrant->reservation_passenger_first_name);
                    $subject = "Warrant Reservation has been has handed over to the station staff";
                    $message = "You have handed over the warrant document to the station. Your warrant has been completed. <br> Your ticket id is " . $new_ticket_id . "
                    <br> Thank you for using TrackNBook warrant reservation service. <br> Have a safe journey";
                    $body = Auth::getEmailBody($name, $message);
                    $to = $warrant->reservation_passenger_email;

                    // echo $body;
                    if (!$this->sendMail($to, $name, $subject, $body)) {
                        die('failed to send mail');
                    }
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $this->redirect('staffticketing/Warrant?success=1');
    }

    function pendingWarrent($id = '')
    {
        $warrant_resevation = new WarrantsReservations();
        // echo $id;
        try {
            $warrant_resevation->update($id, array(
                'warrant_status' => 'Approval Pending'
            ), "warrant_id");
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $this->redirect('staffticketing/Warrant');
    }

    function rejectWarrent($id)
    {
        // $warrant_resevation = new WarrantsReservations();
        // // echo $id;
        // try {
        //     $warrant_resevation->update($id, array(
        //         'warrant_status' => 'Rejected'
        //     ), "warrant_id");
        // } catch (PDOException $e) {
        //     die($e->getMessage());
        // }

        $reject_warrant = new WarrantsReservationsRejected();

        try {



            if (isset($_POST['warrantRejectReason']) && !empty($_POST['warrantRejectReason'])) {
                $rejectionReason = $_POST['warrantRejectReason'];

                // send mail

                $warrant_resevation = new Reservations();
                $warrant_data = $warrant_resevation->where('reservation_ticket_id', $id);

                // echo "<pre>";
                // print_r($warrant_data);
                // echo "</pre>";

                foreach ($warrant_data as $warrant) {
                    try {
                        $name = ucfirst($warrant->reservation_passenger_first_name);
                        $subject = "Warrant Reservation has been Rejected";
                        $message = "Your warrant has been rejected. <br> Reason: " . $rejectionReason;
                        $body = Auth::getEmailBody($name, $message);
                        $to = $warrant->reservation_passenger_email;

                        // echo $body;
                        if (!$this->sendMail($to, $name, $subject, $body)) {
                            die('failed to send mail');
                        }
                    } catch (Exception $e) {
                        die($e->getMessage());
                    }
                }
            }

            $reject_warrant->callProcedure('reject_warrant_reservation', array($id));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }




        $this->redirect('staffticketing/warrant?successreject=1');
    }

    function refectReason($id = '')
    {

        $this->view('refect_reason.staffticketing');
    }

    function staffTicketingInquiry($id = '')
    {
        $Inquiry = new Inquiries();
        $data = array();

        // if (isset($id) && !empty($id)) {
        $data['inquiry'] = $Inquiry->getInquiry();

        // echo "<pre>";
        // print_r($data['inquiry']);
        // echo "</pre>";


        if (isset($_POST['submit']) && !empty($_POST['reservation_ticket_id'])) {
            $data['inquiry'] = $Inquiry->getInquiry('r.reservation_ticket_id', $_POST['reservation_ticket_id']);
        }
        if (isset($_POST['submit']) && !empty($_POST['inquiry_ticket_id'])) {
            $data['inquiry'] = $Inquiry->getInquiry('i.inquiry_ticket_id', $_POST['inquiry_ticket_id']);
        }
        if (isset($_POST['submit']) && !empty($_POST['user_nic'])) {
            $data['inquiry'] = $Inquiry->getInquiry('u.user_nic', $_POST['user_nic']);
        }



        $this->view('inquiry.staffticketing', $data);
    }

    function inquirySummary($id = '')
    {
        $Inquiry = new Inquiries();
        $warrant_resevation = new WarrantsReservations();

        $data = array();
        $data['inquiry'] = $Inquiry->getInquirySummary($id);

        $this->view('inquiry.summary.staffticketing', $data);
    }

    function inquiryResponse($id)
    {

        $Inquiry = new Inquiries();

        try {
            $inquiry_data = $Inquiry->getInquirySummary($id);

            $Inquiry->update($id, array(
                'inquiry_status' => 'Responded',
            ), "inquiry_ticket_id");


            try {
                $name = ucfirst($inquiry_data[0]->user_first_name);
                $subject = "Inquiry Response";
                $message = $_POST['inquiry_response'];
                $body = Auth::getEmailBody($name, $message);
                $to = $inquiry_data[0]->user_email;

                if (!$this->sendMail($to, $name, $subject, $body)) {
                    die('failed to send mail');
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $this->redirect('staffticketing/staffTicketingInquiry');
    }

    function inquirySM($id)
    {
        $Inquiry = new Inquiries();

        try {
            $inquiry_data = $Inquiry->getInquirySummary($id);

            $Inquiry->update($id, array(
                'inquiry_to_station_master' => '1',
                'inquiry_status' => 'Forwarded'
            ), "inquiry_ticket_id");

            try {
                $name = ucfirst($inquiry_data[0]->user_first_name);
                $subject = "Inquiry Response";
                $message = "Your inquiry has been forwarded to the station master. Please wait for the response.";
                $body = Auth::getEmailBody($name, $message);
                $to = $inquiry_data[0]->user_email;

                if (!$this->sendMail($to, $name, $subject, $body)) {
                    die('failed to send mail');
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $this->redirect('staffticketing/staffTicketingInquiry');
    }



    function StaffLogin($id = '')
    {
        $errors = array();


        $user = new Users();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $data = $user->login();

            if (!array_key_exists('error', $data)) {

                Auth::authenticate($data[0]);

                $user_id = $data[0]->user_id;

                $user_type = Auth::getUser_Type($user_id);
                // redirect to dashboard admin
                if (strtolower($user_type) == "admin") {
                    $this->redirect('dashboard/admin');
                }
                // redirect to dashboard passenger
                elseif (strtolower($user_type) == "passenger") {
                    $this->redirect('home');
                }
                //rederect to dashboard staff general
                elseif (strtolower($user_type) == "staff_general") {
                    $this->redirect('dashboard/staff_general');
                }
                //rederect to dashboard staff ticketing
                elseif (strtolower($user_type) == "staff_ticketing") {
                    $this->redirect('dashboard/staff_ticketing');
                }
                //rederect to dashboard train driver
                elseif (strtolower($user_type) == "train_driver") {
                    $this->redirect('dashboard/train_driver');
                }
                //rederect to dashboard station master
                elseif (strtolower($user_type) == "station_master") {
                    $this->redirect('dashboard/station_master');
                } elseif (strtolower($user_type) == "ticket_checker") {
                    $this->redirect('dashboard/ticket_checker');
                }
            } else {
                $errors['username'] = (array_key_exists('invalid_uname', $data['error'])) ? $data['error']['invalid_uname'] : '';
                $errors['password'] = (array_key_exists('invalid_password', $data['error'])) ? $data['error']['invalid_password'] : '';
            }
        }


        //$errors['email'] = 'invalid Username or Password';
        //}

        $this->view(
            'staffticketing.Login',
            array(
                'errors' => $errors,
            )
        );
    }
}
