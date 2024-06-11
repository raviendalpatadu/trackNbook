<?php

/**
 * profile controller
 */

class StationMaster extends Controller


   {
    public function station_master($station_id = '') {
        if (!Auth::is_logged_in() || !Auth::isUserType('station_master')) {
            $this->redirect('login');
        }

        $trainModel = new Trains();
        $trains = $trainModel->getAllTrainsWithEstimatedArrival($station_id);

        $this->view('dashboard.stationmaster', ['trains' => $trains]);
    }
    function trackTicket($id = '')
    {
        $reservation = new Reservations();
        $train = new Trains();
        $fare = new Fares();
        $compartment = new Compartments();

        $data = array();

        if (isset($_POST['reservation_ticket_id']) && !empty($_POST['reservation_ticket_id'])) {
            $data['reservations'] = $reservation->getReservationDataTicket($_POST['reservation_ticket_id']);

            if (!empty($data['reservations'])) { // Check if $data['reservations'] is not empty
                $train_type = $train->whereOne('train_id', $data['reservations'][0]->reservation_train_id);
                $data['train'] = $train->getTrain($data['reservations'][0]->reservation_train_id);
                $compartment_type = $compartment->whereOne('compartment_id', $data['reservations'][0]->reservation_compartment_id);
                $data['compartment'] = $compartment_type->compartment_class_type;

                $station = new Stations();
                $start_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_start_station);
                $end_station = $station->whereOne('station_name', $data['reservations'][0]->reservation_end_station);
                $data['fares'] = $fare->getFareData($train_type->train_type, $compartment_type->compartment_class_type, $start_station->station_id, $end_station->station_id);

                // $data['refund'] = $reservation->getRefund($_POST['reservation_ticket_id'], $data['fares'][0]->fare_price);
            }
        }
        $this->view('tickettracking.stationmaster', $data);
    }


    function updateArrival($id = '')
    {
        /** */
        $train = new Trains();
        $data = array();
        $data['train'] = $train->whereOne('train_id', $id);

        if (isset($_POST['update'])) {
            try {
                $result = $train->updateStatus($id, $_POST);
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }

        $this->view('update.train.arrival');
    }

    function checkArrival($id = '')
{
    $train = new Trains();
    $data = array();

    $data['trains'] = $train->getAllTrainsByStation($_SESSION['USER']->user_data);

    if (isset($_POST['check'])) {

        $train_id =  $_POST['train_id'];
        $location_data = array(
            'train_id' => $train_id,
            'train_location' => Auth::getuser_data(),
            'date' => date('Y-m-d')
        );

        $trainlocation = new TrainLocation();
        if ($trainlocation->validate($location_data) === true) {
            // update the location
            $trainlocation->callProcedure('update_train_location', $location_data);

            // get passenger data in the next station
            $passenger = new Passengers();
            $passenger_data = $passenger->getPassengerDataOfNextStation($train_id, Auth::getuser_data());
            
            //get train data
            $train_data = $train->whereOne('train_id', $train_id);

            // send a mail to the passengers
            $this->notifyPassengers($train_data, $passenger_data, Auth::getuser_data());
            $this->redirect('stationmaster/checkArrival?success=1'); // Success case
        } else {
            $data = array_merge($data, $trainlocation->errors);
            $this->redirect('stationmaster/checkArrival?success=0'); // Failure case
        }
    }

    $this->view('check.train.arrival', $data);
}

function delayRequest(){
    // $train = new Trains();
    $data = array();
    $station = new Stations();
        $delay_data = array(
            'station_id' => Auth::getuser_data()
        );

        $traindelay = new TrainDelay();

        // if ($traindelay->validate($delay_data) === true) {
            // update the location
            $data['delays'] = $traindelay->getAllDelaysByStation($delay_data['station_id']);
            $data['station_name'] = $station->getStation($delay_data['station_id']);

            // get passenger data in the next station
            // $passenger = new Passengers();
            // $passenger_data = $passenger->getPassengerDataOfNextStation($train_id, Auth::getuser_data());

            // // send a mail to the passengers
            // $this->notifyPassengers($train_data, $passenger_data, Auth::getuser_data());
            // $this->redirect('stationmaster/delayRequest?success=1'); // Success case
        // } else {
        //     $data['errors'] = array_merge($data, $traindelay->errors);
        //     $this->redirect('stationmaster/delayRequest?success=0'); // Failure case
        // }
    $this->view('delay.train.request', $data);
}

    function waitList()
    {

        $waitinglist = new WaitingLists();
        $data = array();
        $data['waitinglist'] = $waitinglist->getWaitingList();

        $this->view('view.waitinglist', $data);
    }

    function manageSchedule($id = '')
    {
        $train = new Trains();
        $data = array();

        $date  = date('Y-m-d');

        $data['trains'] = $train->getTrainScheduleForStationMaster($_SESSION['USER']->user_data, $date);

        $this->view('manage.schedule', $data);
    }
    private function notifyPassengers($train, $passenger_data, $station_id)
    {
        // send a mail to the passengers
        if ($passenger_data) {
            $station = new Stations();
            $station_data = $station->whereOne('station_id', $station_id);

            foreach ($passenger_data as $passenger) {
                $to = $passenger->reservation_passenger_email;
                $subject = 'Train Location Update';

                // add the train data and the station data to make the message
                $message = "The {$train->train_name} train has arrived at the station " . $station_data->station_name . " at " . date('Y-m-d H:i:s') . ".
                 <br>The train is now at the station " . $station_data->station_name . " and will be leaving soon.
                 Thank you for choosing our service.";

                $body = Auth::getEmailBody($passenger->reservation_passenger_first_name, $message);

                $this->sendMail($to, $passenger->reservation_passenger_first_name, $subject, $body);
            }
            return true;
        }
        return false;
    }

    function getInquiry(){
        $inquiry = new Inquiries();
        $data = array();
        $data['inquiries'] = $inquiry->getInquiry();

        
         $this->view('inquiry.stationmaster', $data);
        // echo json_encode($data);
    }

    function inquirySummary($id = '')
    {
        $Inquiry = new Inquiries();
        $warrant_resevation = new WarrantsReservations();

        $data = array();
        $data['inquiry'] = $Inquiry->getInquirySummary($id);

        $this->view('inquiry.summary.stationmaster', $data);
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

        $this->redirect('stationmaster/getInquiry');
    }

    function informPassengerDelay()
    {
       
        
        $data = array();
        $station_master = new StationMasters();

        $delay_id = $_POST['delay_id'];
        
        $train_name = $_POST['train_name'];
        $train_no = $_POST['train_no'];
        $train_type = $_POST['train_type'];
        $date_time = $_POST['date_time'];
        $delay_reason = $_POST['delay_reason'];

        $train = new Trains();
        $train_data = $train->whereOne('train_no', $_POST['train_no']);

        // send data is used to set the parameters required fpr informTrainDelay()
        $sendData = [
            'train_id' => $train_data->train_id,
            'station_id' => $_SESSION['USER']->user_data
        ];

        $data['passenger_details'] = $station_master->infromTrainDelay($sendData);

        // update is informed passengers
        $train_delay = new TrainDelay();
        $train_delay->update($delay_id, ['delay_is_informed_passenger' => 1], 'delay_id');

        foreach($data['passenger_details'] as $passenger){
            if($passenger->reservation_passenger_email == null){
                continue;
            }

            $to = $passenger->reservation_passenger_email;
            $subject = 'Train Delay Information';
            $message = "The train {$train_name} with train number {$train_no} and type {$train_type} has been delayed. The new arrival time is {$date_time}. The reason for the delay is {$delay_reason}.";
            $body = Auth::getEmailBody($passenger->reservation_passenger_first_name, $message);

            $this->sendMail($to, $passenger->reservation_passenger_first_name, $subject, $body);
            
        }  
        echo json_encode(true);
    }
}
