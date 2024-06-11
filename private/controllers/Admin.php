<?php

/**
 * home controller
 */


class Admin extends Controller
{
    function index($id = '')
    {

        $this->view('home');
    }

    function usersList()
    {

        $user = new Users();
        $data = array();

        $data['users'] = $user->findAll();

        $this->view('display.users.admin', $data);
    }



    function updateUser($id = '')
    {
        $user = new Users();
        $data = array();

        $data['user'] = $user->whereOne('user_id', $id);

        if (isset($_POST['update'])) {
            try {
                $result = $user->updateUser($id, $_POST);

                if ($result != 1 && array_key_exists('errors', $result)) {
                    $data['errors'] = $result['errors'];
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }


        $this->view('update.user.admin', $data);
    }

    function deleteUser($id = '')
    {
        $user = new Users();
        $data = array();

        // if(isset($_POST['delete'])){
        try {
            $result = $user->delete($id, "user_id");
            $this->redirect('admin/usersList');

            // if($result !=1 && array_key_exists('errors', $result)){
            //     $data['errors'] = $result['errors'];
            //     echo "<pre>";
            //     echo "</pre>";
            // }

        } catch (Exception $e) {
            die($e->getMessage());
        }
        // }
    }

    function search($id = '')
    {
        $this->view('view.user.admin');
    }

    function trainList()
    {
        $train = new Trains();
        $data = array();

        $data['trains'] = $train->findAllTrains();
        $this->view('admin.trainList', $data);
    }

    function trainRequest()
    {
        $this->view('admin.trainRequest');
    }
    function inquiry()
    {
        $this->view('admin.inquiry');

    }

    function analysis(){
        $this->view('admin.analysis');
    }

    // function reportRequest(){
    //     $mpdf = new \Mpdf\Mpdf();
    //     $data = file_get_contents(ROOT.'admin/getreport');
    //     $mpdf->WriteHTML($data);
    //     $mpdf->Output();;
    // }

    function getreport(){
        $this->view('admin.analysis');
    }

    // function addRoute(){
        
    // }

    

    function disableTrain()
    {

        $data = array();

        $train_disable = new TrainDisablePeriods();
        $data['trains'] = $train_disable->getAllDisableTrains();

        $this->view('admin.trainDisable', $data);
    }


    // function addRoute()
    // {
    // }

    function addDisableTrain()
    {
        $train = new Trains();
        $data = array();

        $data['trains'] = $train->findAllTrains();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";
            $train_disable = new TrainDisablePeriods();
            if ($train_disable->validate($_POST)) {
                // add disable period
                $disable_period = new DisablePeriods();
                $disable_period_id = $disable_period->insert($_POST);

                // add train disable period
                $disable_period_train_id = $train_disable->insert([
                    'disable_period_train_id' => $_POST['train_id'],
                    'disable_period_id' => $disable_period_id
                ]);

                // cancel all reservations with in the disable period
                $reservations = $train_disable->getDisablePeriodReservations([
                    'train_id' => $_POST['train_id'],
                    'disable_period_start_date' => $_POST['disable_period_start_date'],
                    'disable_period_end_date' => $_POST['disable_period_end_date']
                ]);

                // echo "<pre>";
                // print_r($reservations);
                // echo "</pre>";

                foreach ($reservations as $reservation) {
                    $reservationData = [
                        $reservation->reservation_ticket_id,
                        'Train Disabled'
                    ];
                    $disable_period->callProcedure('cancel_reservation_train_disable', $reservationData);

                    // send email to user
                    $user = new Users();
                    $user_data = $user->whereOne('user_id', $reservation->reservation_passenger_id);

                    // get train data
                    $train_data = $train->whereOne('train_id', $reservation->reservation_train_id);

                    $to = $user_data->user_email;
                    $recipient = $user_data->user_first_name . ' ' . $user_data->user_last_name;
                    $subject = 'Train Disabled';
                    $message = "The train " . $train_data->train_name . " you have reserved on " . $reservation->reservation_date . " has been disabled. <br>
                    You will be able to get your full refund within 7 working days. <br>
                    We apologize for any inconvenience caused.";

                    $body = Auth::getEmailBody($recipient, $message);
                    if ($this->sendMail($to, $recipient, $subject, $body)) {
                        $this->redirect('admin/disableTrain?success=1');
                    }
                }
                // // redirect to disable train page if no reservations
                $this->redirect('admin/disableTrain?success=1');
            } else {
                $data['errors'] = $train_disable->errors;
            }
        }
        $this->view('add.disable.train.admin', $data);
    }

    function updateDisablePeriod($id)
    {

        $data = array();
        $train_disable = new TrainDisablePeriods();
        $data['train_disable'] = $train_disable->whereOne('disable_period_id', $id);

        $disable_period = new DisablePeriods();
        $data['disable_period'] = $disable_period->whereOne('disable_period_id', $id);

        $train = new Trains();
        $data['trains'] = $train->findAllTrains();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $train_disable = new TrainDisablePeriods();

            if ($train_disable->validate($_POST)) {

                $train_disable->update($_POST['train_disable_period_id'], [
                    'disable_period_train_id' => $_POST['train_id']
                
                ], 'train_disable_period_id'); 
                
                $disable_period = new DisablePeriods();
                $disable_period->update($_POST['disable_period_id'], $_POST, 'disable_period_id');

                $this->redirect('admin/disableTrain?update=1');
            } else {
                $data['errors'] = $train_disable->errors;
            }
        }

        $this->view('update.disable.train.admin', $data);
    }

    function deleteDisablePeriod($id)
    {

        $data = array();
    

        $disable_period = new DisablePeriods();
        try{

            $disable_period->delete($id, 'disable_period_id');
        }catch(Exception $e){
            die($e->getMessage());
        }
        
        $this->redirect('admin/disableTrain?delete=1');


        

        
    }
}
