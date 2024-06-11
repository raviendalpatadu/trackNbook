<?php

/**
 * profile controller
 */

class TrainDriver extends Controller
{
    function index($id = '', $driver_id = '')
    {
        if (!Auth::is_logged_in() || !Auth::isUserType('train_driver')) {
            $this->redirect('login');
        }

        // if (!Auth::isPinChanged(Auth::getuser_data(), 'train_driver')) {
        //     // get user id
        //     $user_id = Auth::getUser_id();
        //     $this->redirect('login/changepin/' . $user_id);
        // }

        $train = new Trains();
        $data = array();

        if ($id != '' && $driver_id != '') {
            $train = new Trains();
            $train_data = $train->whereOne('train_no', $id);
            

            $data = array(
                'train_id' => $train_data->train_id,
                'driver_id' => Auth::getUser_id()
            );

            $_SESSION['train_driver'] = $data;
        }


        $this->view('dashboard.traindriver');
    }
    function trainDelay($id = '')
    {
        if (!Auth::is_logged_in() || !Auth::isUserType('train_driver')) {
            $this->redirect('login');
        }

        if (!Auth::isPinChanged(Auth::getuser_data(), 'train_driver')) {
            // get user id
            $user_id = Auth::getUser_id();
            $this->redirect('login/changepin/' . $user_id);
        }

        $train = new Trains();
        $data = array();
        $train_id = $_SESSION['train_driver']['train_id'];

        $data['train'] = $train->findTrain($train_id)[0];

        $train_stop_station = new TrainStopStations();
        $data['train_stop_stations'] = $train_stop_station->getTrainStopStationNames($train_id);

        $trainlocation = new TrainLocation();
        $data['location'] = $trainlocation->selectTrainLocation($train_id, date('Y-m-d'));

        $station = new Stations();


        if (isset($data['location']) && empty($data['location'])) {
            $data['location'] = new stdClass();
            $data['location']->station_name = 'No Station';
        } else {
            $data['location'] = $station->whereOne('station_id', $data['location']->train_location);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $train_delay = new TrainDelay();
            $delay_data = array(
                'delay_train' => $train_id,
                'delay_station' => $data['location']->station_id,
                'delay_date' => date('Y-m-d'),
                'delay_reason' => $_POST['reason']
            );

            $validateData = [
                'trainId' => $train_id,
                'station_id' => $data['location']->station_id
            ]; 

            if ($train_delay->validate($validateData) === true) {
                $train_delay->insert($delay_data);
                $this->redirect('traindriver/traindelay?success=1');
            } else {
                $data = array_merge($data, $train_delay->errors);
            }
        }

        
         $this->view('update.train.delay', $data);
    }


    function addLocation()
    {
        if (!Auth::is_logged_in() || !Auth::isUserType('train_driver')) {
            $this->redirect('login');
        }

        if (!Auth::isPinChanged(Auth::getuser_data(), 'train_driver')) {
            // get user id
            $user_id = Auth::getUser_id();
            $this->redirect('login/changepin/' . $user_id);
        }

        // if session is set redirect to train driver page
        if (!isset($_SESSION['train_driver'])) {
            $this->redirect('traindriver/idoption');
        }
        $train = new Trains();
        $data = array();
        $train_id = $_SESSION['train_driver']['train_id'];


        $data['train'] = $train->findTrain($train_id)[0];


        $train_stop_station = new TrainStopStations();
        $data['train_stop_stations'] = $train_stop_station->getTrainStopStationNames($train_id);


        $trainlocation = new TrainLocation();
        $data['location'] = $trainlocation->selectTrainLocation($train_id, date('Y-m-d'));

        
        $station = new Stations();
        
   
        
        if (isset($data['location']) && empty($data['location'])) {
            $data['location'] = new stdClass();
            $data['location']->station_name = 'No Station';
        } else {
            $data['location'] = $station->whereOne('station_id', $data['location']->train_location);
        }
        


        if (isset($_POST['submit'])) {

            $location_data = array(
                'train_id' => $train_id,
                'train_location' => $_POST['station_id'],
                'date' => date('Y-m-d')
            );

            if ($trainlocation->validate($location_data) === true) {
                // update the location
                $trainlocation->callProcedure('update_train_location', $location_data);

                // get passenger data in the next station
                $passenger = new Passengers();
                $passenger_data = $passenger->getPassengerDataOfNextStation($train_id, $_POST['station_id']);

                // send a mail to the passengers
                $this->notifyPassengers($data['train'], $passenger_data, $_POST['station_id']);
                $this->redirect('traindriver/addlocation?success=1');
            } else {
                $data = array_merge($data, $trainlocation->errors);
            }
        }


        $this->view('add.location', $data);
    }

    function qr()
    {
        $this->view('QRSearch.traindriver');
    }

    // welcom sceen for the train driver where need to scan the qr code
    function idoption($id = '')
    {
        if (!Auth::is_logged_in() || !Auth::isUserType('train_driver')) {
            $this->redirect('login');
        }

        if (!Auth::isPinChanged(Auth::getuser_data(), 'train_driver')) {
            // get user id
            $user_id = Auth::getUser_id();
            $this->redirect('login/changepin/' . $user_id);
        }

        // if session is set redirect to train driver page
        if (isset($_SESSION['train_driver'])) {
            $data = $_SESSION['train_driver'];
            if ($data['driver_id'] != Auth::getUser_id() && $data['train_id'] != $id) {
                $this->redirect('traindriver/index/' . $data['train_id'] . '/' . Auth::getUser_id());
            }
        }


        $this->view('option.traindriver');
    }

    private function notifyPassengers($train, $passenger_data, $station_id)
    {
        // send a mail to the passengers
        if ($passenger_data) {
            $station = new Stations();
            $station_data = $station->whereOne('station_id', $station_id);

            foreach ($passenger_data as $passenger) {
                if ($passenger->reservation_passenger_email == '' || $passenger->reservation_passenger_email == null || empty($passenger->reservation_passenger_email)) {
                    continue;
                }

                $to = $passenger->reservation_passenger_email;               
                
                $subject = 'Train Location Update';

                // add the train data and the station data to make the message
                $message = "The {$train->train_name} train has arrived at the station " . $station_data->station_name . " at " . date('Y-m-d H:i:s') . ".
                 <br>The train is now at the station " . $station_data->station_name . " and will be leaving soon.
                 Thank you for choosing our service.";

                $body = Auth::getEmailBody($passenger->reservation_passenger_first_name, $message);

                if($this->sendMail($to, $passenger->reservation_passenger_first_name, $subject, $body)){
                    return true;
                } else{
                    echo "fail to send mail";
                }


            }
        }
        return false;
    }
}
