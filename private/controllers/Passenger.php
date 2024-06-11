<?php

class Passenger extends Controller
{
    function index($id = '')
    {

        $this->view('passenger.register');
    }

    function details($id = '')
    {
        // echo "<pre>";
        // print_r($_SESSION);
        // echo "</pre>";

        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        if (!Auth::is_logged_in()) {
            $this->redirect('/home');
        }

        $data = array();

        if (isset($_POST['reservation_passenger_nic']) && !empty($_POST['reservation_passenger_nic'])) {

            $reservation = new Reservations();

            if ($reservation->validatePassenger($_POST)) {
                $_SESSION['reservation']['passenger_data'] = $_POST;


                if (!isset($_POST['warrant_booking'])) {
                    $_SESSION['reservation']['passenger_data']['warrant_booking'] = "off";
                }

                $reaservation = new Reservations();
                try {
                    $count = 0;
                    if (isset(Auth::reservation()['reservation_id']['from']) && count(Auth::reservation()['reservation_id']['from']) == Auth::reservation()['no_of_passengers']) {

                        // upload warrant img
                        $warrant_image_id = null;
                        $warrant_temp_id = null;
                        if (isset($_FILES['warrant_image']) && Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                            $image_file = $this->setPrivateImage('warrants', $_FILES['warrant_image']);

                            $warrant_image = new WarrantImages();

                            $warrant_image_id = $warrant_image->insert([
                                'warrant_image_name' => $image_file['image_name'],
                                'warrant_image_path' => $image_file['image_path'],
                                'warrant_image_type' => $image_file['image_type']
                            ]);

                            // if warrant image is null throw an execption
                            if ($warrant_image_id == null) {
                                throw new Exception("Error in warrant image upload. Please try again.");
                            }

                            // get warrant tempory warrant id
                            $warrant_temp_id = Auth::getTempReservationId();

                            // if to reservation is set
                            if (Auth::getReturn() == 'on' && isset(Auth::reservation()['reservation_id']['to'])) {
                                $warrant_temp_id_to = Auth::getTempReservationId();
                            }
                        }


                        //// loop thourugh from reservation id's
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

                            if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                                $reservationPassengerData['reservation_type'] = "Warrant";

                                // tempory warrant id
                                $reservationPassengerData['reservation_ticket_id'] = $warrant_temp_id;
                            }



                            //update passenger details to tbl_reservtion
                            $data = $reaservation->update($reservation_id, $reservationPassengerData, 'reservation_id');

                            // update warrant reservations table
                            if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                                // if warrant image is null throw an execption
                                if ($warrant_image_id == null) {
                                    throw new Exception("Error in warrant image upload. Please try again.");
                                } else {
                                    $warrant_reservation = new WarrantsReservations();
                                    $warrant_reservation->update($reservation_id, ['warrant_image_id' => $warrant_image_id, 'warrant_status' => 'Approval Pending'], 'warrant_reservation_id');

                                    $_SESSION['reservation']['reservation_status'] = "Approval Pending";
                                }
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

                                if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                                    $reservationPassengerDataTo['reservation_type'] = "Warrant";

                                    // tempory warrant id
                                    $reservationPassengerDataTo['reservation_ticket_id'] = $warrant_temp_id_to;
                                }

                                $data = $reaservation->update($reaservation_id, $reservationPassengerDataTo, 'reservation_id');

                                // update warrant reservations table
                                if (Auth::reservation()['passenger_data']['warrant_booking'] == 'on') {
                                    // if warrant image is null throw an execption
                                    if ($warrant_image_id == null) {
                                        throw new Exception("Error in warrant image upload. Please try again.");
                                    } else {
                                        $warrant_reservation = new WarrantsReservations();
                                        $warrant_reservation->update($reaservation_id, ['warrant_image_id' => $warrant_image_id, 'warrant_status' => 'Approval Pending'], 'warrant_reservation_id');

                                        $_SESSION['reservation']['reservation_status'] = "Approval Pending";
                                    }
                                }

                                $count++;
                            }
                        }

                        // if in waitnig list remove from waiting list
                        $waiting_list = new WaitingLists();
                        $waiting_list_arr['waiting_list_passenger_id'] = Auth::getUser_id();
                        $waiting_list_arr['waiting_list_train_id'] = Auth::reservation()['from_train']->train_id;
                        $waiting_list_arr['waiting_list_compartment_id'] = Auth::reservation()['from_compartment']->compartment_id;
                        $waiting_list_arr['waiting_list_reservation_date'] = Auth::reservation()['from_date'];

                        if ($waiting_list->inWaitingList($waiting_list_arr)) {
                            $waiting_list->removeFromWaitingList($waiting_list_arr);
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
                            if (empty($email)) {
                                continue;
                            }
                            $to_email = $email;
                            $subject = "Warrant Reservation Request";
                            $recipient = Auth::reservation()['passenger_data']['reservation_passenger_first_name'][$key];

                            $messege = "<p style=\"Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;font-family:arial, 'helvetica neue', helvetica, sans-serif;line-height:27px;color:#999999;font-size:18px\" class=\"p_description\"><p>We are pleased to inform you that your Warrant Reservation Request has been successfully submitted. Your booking details are now in our system.</p>
                                <p>You can expect to receive a confirmation email within 2-3 business days, containing all the necessary information regarding your reservation.</p>
                                <p>If you have any questions or need further assistance, feel free to <a href=\"mailto:" . EMAIL . "\">contact us</a>.</p>";

                            $message = Auth::getEmailBody(Auth::reservation()['passenger_data']['reservation_passenger_first_name'][$key], $messege);

                            $this->sendMail($to_email, $recipient, $subject, $message);
                        }


                        // if in waitnig list remove from waiting list
                        $waiting_list = new WaitingLists();
                        $waiting_list_arr['waiting_list_passenger_id'] = Auth::getUser_id();
                        $waiting_list_arr['waiting_list_train_id'] = Auth::reservation()['from_train']->train_id;
                        $waiting_list_arr['waiting_list_compartment_id'] = Auth::reservation()['from_compartment']->compartment_id;
                        $waiting_list_arr['waiting_list_reservation_date'] = Auth::reservation()['from_date'];

                        if ($waiting_list->inWaitingList($waiting_list_arr)) {
                            $waiting_list->removeFromWaitingList($waiting_list_arr);
                        }

                        $this->view('passenger.warrant', $data);
                    } else {
                        $this->redirect('passenger/billing');
                    }
                }
            } else {
                $data['errors'] = $reservation->__get('errors');
            }
        }


        $this->view('passenger.details', $data);
    }

    function billing($id = '')
    {
        // 
        if (!Auth::is_logged_in()) {
            $this->redirect('/home');
        }

        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $data = array();


        if (isset($_SESSION['reservation']['passenger_data']) && !empty($_SESSION['reservation']['passenger_data'])) {

            $this->view('passenger.billing.summary', $data);
        } else {
            $this->redirect('home');
        }
    }


    function payment($id = '')
    {
        if (!Auth::is_logged_in()) {
            $this->redirect('/home');
        }

        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $data = Auth::payment($_POST['payment_data']);
        echo json_encode($data);
    }

    function addReservation()
    {
        if (!Auth::is_logged_in()) {
            $this->redirect('/home');
        }

        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        $reaservation = new Reservations();
        try {
            // $data = $reaservation->addReservation($_SESSION['reservation']);
            $reservationPassengerData = array();
            $reservationPassengerData['reservation_ticket_id'] = Auth::getTicketId();


            foreach (Auth::reservation()['reservation_id']['from'] as $key => $value) {
                $reservationPassengerData['reservation_status'] = "Reserved"; // 1 for confirmed
                $reservationPassengerData['reservation_amount'] = Auth::reservation()['from_fare']->fare_price;
                $reaservation->update($value, $reservationPassengerData, 'reservation_id');
            }
            $_SESSION['reservation']['from_reservation_ticket_id'] = $reservationPassengerData['reservation_ticket_id'];

            if (Auth::getReturn() == 'on' && isset(Auth::reservation()['reservation_id']['to'])) {
                $reservationPassengerDataTo = array();
                $reservationPassengerDataTo['reservation_ticket_id'] = Auth::getTicketId();

                foreach (Auth::reservation()['reservation_id']['to'] as $key => $value) {
                    $reservationPassengerDataTo['reservation_amount'] = Auth::reservation()['to_fare']->fare_price;
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

            $this->redirect('passenger/summary');
        } catch (PDOException $e) {
            echo $e->getMessage();
            $this->redirect('passenger/billing');
        }
    }

    //add passenger
    function register($id = '')
    {
        $data = array();
        $passenger = new Passengers();

        if (isset($_POST['user_title'])) {
            $data = $passenger->addPassengerValidation();

            if (!array_key_exists('errors', $data)) {
                // print_r($data);

                try {

                    $user = new Users();
                    $user_id = $user->insert(array(
                        'user_title' => $_POST['user_title'],
                        'user_first_name' => $_POST['user_first_name'],
                        'user_last_name' => $_POST['user_last_name'],
                        'user_phone_number' => $_POST['user_phone_number'],
                        'user_type' => "passenger",
                        'user_gender' => $_POST['user_gender'],
                        'user_email' => $_POST['user_email'],
                        'user_nic' => $_POST['user_nic']
                    ));

                    $login = new Logins();
                    $login->insert(array(
                        'login_username' => $_POST['login_username'],
                        'login_password' => md5($_POST['login_password']),
                        'user_id' => $user_id
                    ));



                    $passenger = new Passengers();
                    $passenger->insert(array(
                        'passenger_id' => $user_id,
                        'passenger_email' => $_POST['user_email'],
                        'passenger_nic' => $_POST['user_nic']
                    ));

                    $image = new Images();

                    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
                        $image_file = $this->setPrivateImage('userImg', $_FILES['user_image']);

                        $image->insert(array(
                            'user_id' => $user_id,
                            'image_name' => $image_file['image_name'],
                            'image_path' => $image_file['image_path'],
                            'image_type' => $image_file['image_type']
                        ));
                    } else {
                        $image->insert(array(
                            'user_id' => $user_id,
                            'image_name' => 'default.jpg',
                            'image_path' => 'userImg/default.jpg',
                            'image_type' => 'image/jpg'
                        ));
                    }

                    // send email to verify email
                    $to_email = $_POST['user_email'];
                    $subject = "Email Verification";
                    $recipient = $_POST['user_first_name'];
                    $message = "Please verify your email address by clicking the link below.<br> <a href='" . ROOT . "/user/verifyEmail/" . $user_id . "'>Verify Email</a>";
                    $message = Auth::getEmailBody($_POST['user_first_name'], $message);

                    $this->sendMail($to_email, $recipient, $subject, $message);
                } catch (PDOException $e) {
                    die($e->getMessage());
                }

                $this->redirect('login?register=success');
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
        if (!Auth::is_logged_in()) {
            $this->redirect('/home');
        }

        if (!Auth::reservation()) {
            $this->redirect('/home');
        }

        // to show the loder
        $this->view('passenger.summary');

        // send email to each email
        foreach (Auth::reservation()['passenger_data']['reservation_passenger_email'] as $key => $email) {
            $to_email = $email;
            $subject = "Reservation Confirmation";
            $recipient = Auth::reservation()['passenger_data']['reservation_passenger_first_name'][$key];
            $message = Auth::getReservationConfirmationEmailBody(Auth::reservation()['passenger_data']['reservation_passenger_first_name'][$key]);

            $this->sendMail($to_email, $recipient, $subject, $message);
        }
    }

    // reservations
    function reservation($id = '')
    {
        $data = array();
        $reservation = new Reservations();
        $data['reservations'] = $reservation->getReservations($id);
        $data['cancelled_reservations'] = $reservation->getReservations($id, 'Cancelled');

        // waiting list
        $waiting_list = new WaitingLists();
        $data['waiting_list_reservations'] = $waiting_list->getWaitingListPassenger($id);

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
    
    // inquries
    function inquries($id = '')
    {
        $data = array();

        if(isset($_POST['submit'])) {

            $inquiry = new Inquiries();
            if($inquiry->validateInquiry($_POST)) {
                $station = new Stations();
                $station_data = $station->whereOne('station_name', $_POST['inquiry_station']);
                echo "<pre>";
                print_r($station_data);
                $inquiry_id = $inquiry->insert([
                    'inquiry_passenger_id' => Auth::getUser_id(),
                    'inquiry_ticket_id' => $_POST['inquiry_ticket_id'],
                    'inquiry_station' => $station_data->station_id,
                    'inquiry_reason' => $_POST['inquiry_reason'],
                    'inquiry_status' => 'Pending'
                ]);

                if($inquiry_id) {
                    // send email to passenger 
                    $to_email = Auth::getUser_email();
                    $subject = "Inquiry Confirmation";
                    $recipient = Auth::getUser_first_name();
                    $message = "Your inquiry has been successfully submitted. We will get back to you soon. <br> Your inquiry id is<b> {$inquiry_id} </b><br>Thank you for contacting us.";
                    $body = Auth::getEmailBody(Auth::getUser_first_name(), $message);

                    $this->sendMail($to_email, $recipient, $subject, $body);

                   $this->redirect('passenger/inquries?success=1');
                } else {
                    $data['errors'] = "Error in submitting inquiry. Please try again.";
                }
            } else {
                $data['errors'] = $inquiry->errors;
            }
        }


        $this->view('passenger.inquiry', $data);
    }

}
