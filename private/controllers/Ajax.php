<?php
class Ajax extends Controller
{

    public function getSession($name)
    {
        if (isset($_SESSION[$name])) {
            echo json_encode($_SESSION[$name]);
        } else {
            echo json_encode(false);
        }
    }

    public function getReservationData($id, $type = '')
    {
        $reservation = new Reservations();
        echo json_encode($reservation->getReservationDataTicket($id, $type));
    }

    public function cancelReservation($id)
    {
        // notify the waiting list
        $waitingList = new WaitingLists();
        $waiting_passenger_list = $waitingList->notifyWaitingList($id);



        if ($waiting_passenger_list != false) {
            foreach ($waiting_passenger_list as $waiting_passenger) {
                //         // send email to the waiting list

                
                $user = new Users();
                try {
                    $user_data = $user->whereOne('user_id', $waiting_passenger->waiting_list_passenger_id);
                    if (empty($user_data->user_email) || $user_data->user_email == null) {
                        continue;
                    }

                    $email = $user_data->user_email;
                    $subject = "Train Reservation Notification";
                    $message = "<h3>Some seats are available on the train.</h3>
                                <h4>$waiting_passenger->train_name</h4>
                                <div>
                                    <p style='font-size: 14px; font-weight: 500'>From: $waiting_passenger->start_station_name</p>
                                    <p style='font-size: 14px; font-weight: 500'>To: $waiting_passenger->end_station_name</p>
                                    <p style='font-size: 14px; font-weight: 500'>Departure Time: $waiting_passenger->estimated_start_time</p>
                                    <p style='font-size: 14px; font-weight: 500'>Arrival Time: $waiting_passenger->estimated_end_time</p>
                                </div>
                                Please login to your account to make a reservation.";

                    $message = Auth::getEmailBody($user_data->user_first_name, $message);
                } catch (Exception $e) {
                    die($e->getMessage());
                }

                $this->sendMail($email, $user_data->user_first_name, $subject, $message);
            }
        }
        // echo json_encode($waiting_passenger_list);
        // echo json_encode($waiting_passenger_list);

        $reservation = new Reservations();
        $result = $reservation->callProcedure('cancel_reservation', array($id));
        if($result == false){
            echo json_encode([]);
            return;
        }
        echo json_encode(false);
    }

    public function getStation()
    {
        $station = new stations();
        echo json_encode($station->findAll());
    }

    public function getAllReservations()
    {
        $reservation = new Reservations();
        echo json_encode($reservation->findAll());
    }

    public function getUsers()
    {
        $user = new Users();
        $result = $user->findAll();

        echo json_encode($result); // Wrap the output array inside a "data" key
    }

    public function getTrainList()
    {
        $train = new Trains();
        $trains = $train->findAllTrains();

        // Organize data by train ID
        $organizedData = [];
        foreach ($trains as $train) {
            $trainId = $train->train_id;
            if (!isset($organizedData[$trainId])) {
                $organizedData[$trainId] = [
                    'train' => $train,
                    'compartment_class_types' => []
                ];
            }
            $organizedData[$trainId]['compartment_class_types'][] = $train->compartment_class_type;
        }

        echo json_encode(array_values($organizedData));
    }




    public function getTrains()
    {
        $train = new Trains();
        $data = array();
        $data = $train->findAllTrains();

        echo json_encode($data);
    }

    public function getWaitingList()
    {
        $waitinglist = new WaitingLists();
        $data = $waitinglist->getWaitingList();

        echo json_encode($data);
    }
    public function updateLocation()
    {
        $train = new Trains();
        $data = array();
        $data['train'] = $train->whereOne('train_id', $_POST['train_id']);
        $train_stop_station = new TrainStopStations();
        $data['train_stop_stations'] = $train_stop_station->getTrainStopStationNames($_POST['train_id']);
        echo json_encode($data);
    }

    //need a function that get the reservation details from thr reservation table sorted by date and return the total count of the reserveration on that date and total amount
    public function getReservationReport()
    {
        $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : null;
        $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : null;
        $reservationType = isset($_POST['reservationType']) ? $_POST['reservationType'] : 'all'; // Added reservationType

        $reservation = new Reservations();
        $data = array();
        $data['reservations'] = $reservation->getReservationDetails($startDate, $endDate, $reservationType); // Updated function call
        echo json_encode($data);
    }

    public function getTrainLocation()
    {
        $data = array();
        $train_location = new TrainLocation();
        $train = new Trains();
        $train_data = $train->whereOne('train_no', $_POST['train_id']);

        if ($train_data == false) {
            echo json_encode(['train' => false]);
            return;
        }


        $data['train'] = $train_location->getTrainLocation($train_data->train_id);
        echo json_encode($data);
    }

    public function getErrors()
    {
        if (isset($_SESSION['error'])) {
            echo json_encode($_SESSION['error']);
            unset($_SESSION['error']);
        } else {
            echo json_encode(false);
        }
    }

    // public function validateUpdateTrain(){
    //     $train = new Trains();

    //     if($train->validateUpdateTrain($_POST)){
    //         echo json_encode(true);
    //     }
    //     else{
    //         echo json_encode($train->errors);
    //     }
    // }
    public function getRefund()
    {
        if (isset($_POST['ticket_id'])) {
            $ticket_id =  $_POST['ticket_id'];
            $reservation = new Reservations();
            $data = $reservation->whereOne('reservation_ticket_id', $ticket_id);

            $refund =  $reservation->getRefund($ticket_id, $data->reservation_amount);
            echo json_encode($refund);
        }
    }


    public function countReservationFromAndTo()
    {
        $reservation = new Reservations();
        $data = $reservation->countReservationFromAndTo($_POST['start'], $_POST['end']);
        echo json_encode($data);
    }

    public function reservationCountByReservationType()
    {
        $reservation = new Reservations();
        $data = $reservation->reservationCountByReservationType($_POST['start'], $_POST['end']);
        echo json_encode($data);
    }
}
