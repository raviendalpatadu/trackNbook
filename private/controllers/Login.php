<?php

/**
 * home controller
 */

class Login extends Controller
{
    function index($id = '')
    {
        $errors = array();
        
        $user = new Users();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $data = $user->login();



            if (!array_key_exists('error', $data) && $data[0]->user_type == 'passenger') {

                Auth::authenticate($data[0]);

                $user_id = $data[0]->user_id;
                $user_type = Auth::getUser_Type($user_id);
                // redirect to dashboard passenger
                if (strtolower($user_type) == "passenger") {
                    $this->redirect('home');
                }  
            }
            else{
                if (isset($data[0]) && $data[0]->user_type == 'passenger') {
                    $errors['username'] = (array_key_exists('invalid_uname',$data['error'])) ? $data['error']['invalid_uname'] : '';
                    $errors['password'] = (array_key_exists('invalid_password',$data['error'])) ? $data['error']['invalid_password'] : '';
                }else{
                    $errors['username'] = 'invalid Username or Password';
                    $errors['password'] = 'invalid Username or Password';
                }

            }
        }


        //$errors['email'] = 'invalid Username or Password';
        //}

        $this->view(
            'login',
            array(
                'errors' => $errors,
            )
        );
    }

    function staff($id = '')
    {
        $errors = array();


        $user = new Users();
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $data = $user->staffLogin();

            if (!array_key_exists('error', $data)) {

                Auth::authenticate($data[0]);

                $user_id = $data[0]->user_id;

                $user_type = Auth::getUser_Type($user_id);
                // redirect to dashboard admin
                if (strtolower($user_type) == "admin") {
                    $this->redirect('dashboard/admin');
                }

                //rederect to dashboard staff general
                elseif (strtolower($user_type) == "staff_general") {
                    $this->redirect('dashboard/staff_general');
                }
                //rederect to dashboard staff ticketing
                elseif (strtolower($user_type) == "staff_ticketing") {
                    $this->redirect('staffticketing');
                }
                //rederect to dashboard train driver
                elseif (strtolower($user_type) == "train_driver") {
                    $this->redirect('traindriver/idoption');
                }
                //rederect to dashboard station master
                elseif (strtolower($user_type) == "station_master") {
                    $this->redirect('dashboard/station_master');
                } elseif (strtolower($user_type) == "ticket_checker") {
                    $this->redirect('ticketchecker/option');
                }

            } else {
                $errors['username'] = (array_key_exists('invalid_uname', $data['error'])) ? $data['error']['invalid_uname'] : '';
                $errors['password'] = (array_key_exists('invalid_password', $data['error'])) ? $data['error']['invalid_password'] : '';
            }
        }


        //$errors['email'] = 'invalid Username or Password';
        //}

        $this->view(
            'staff.login',
            array(
                'errors' => $errors,
            )
        );
    }

    function changePin($id){
        $user_id = $id;
        $user = new Users();
        $user_data = $user->whereOne('user_id',$user_id);

        if($user_data->user_type == 'ticket_checker'){
            $ticket_checker = new TicketCheckers();
            $ticket_checker_data = $ticket_checker->whereOne('ticket_checker_id',$user_id);
            if ($ticket_checker_data->pin_changed == 1) {
                $this->view('option.ticketchecker');
                return;
            }
            if(isset($_POST['pin_changed']) && isset($_POST['pin_changed_confirm']) && $_POST['pin_changed'] == $_POST['pin_changed_confirm']){

                $ticket_checker->update($user_id,array(
                    'ticket_checker_pin_code' => md5($_POST['pin_changed']),
                    'pin_changed' => 1
                ),'ticket_checker_id');

                $this->redirect('ticketchecker/option');
            }
        }

        if($user_data->user_type == 'train_driver'){
            $train_driver = new TrainDrivers();
            $train_driver_data = $train_driver->whereOne('train_driver_id',$user_id);
            if ($train_driver_data->pin_changed == 1) {
                $this->view('option.traindriver');
                return;
            }
            if(isset($_POST['pin_changed']) && isset($_POST['pin_changed_confirm']) && $_POST['pin_changed'] == $_POST['pin_changed_confirm']){

                $train_driver->update($user_id,array(
                    'train_driver_pin_code' => md5($_POST['pin_changed']),
                    'pin_changed' => 1
                ),'train_driver_id');
                 
                // $_SESSION['USER']->user_data set this property to 1
                $user = new Users();
                $user_data = $user->whereOne('user_id', $user_id);
                unset($_SESSION['USER']);
                $_SESSION['USER'] = $user_data;

                $this->redirect('traindriver/idoption');
            }
        }

        $this->view('includes/changepin', $user_data);
    }
}