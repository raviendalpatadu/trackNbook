<?php

/**
 * home controller
 */

class User extends Controller
{
    function index($id = '')
    {

        $this->view('home');
    }

    // function add($id = '')
    // {
    //     $this->view('add.user.admin');
    // }

    // function details($id = '')
    // {
    //     $passenger = new Passengers();
    //     $data = array();
    //     $data = $passenger->getPassengers();
    //     $this->view('passenger.details', $data);
    // }

    function register($id = '')
    {
        $data = array();
        $user = new Users();

        $station = new Stations();
        $data['stations'] = $station->getStations();

        if (isset($_POST['user_title'])) {
            // $data = ;

            if ($user->addUserValidateAdmin()) {

                try {
                    $user = new Users();
                    $user_id =  $user->insert(array(
                        'user_title' => $_POST['user_title'],
                        'user_first_name' => $_POST['user_first_name'],
                        'user_last_name' => $_POST['user_last_name'],
                        'user_phone_number' => $_POST['user_phone_number'],
                        'user_type' => $_POST["user_type"],
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

                    // add to relavanet user table based on user type
                    // station_master
                    if($_POST["user_type"] == 'station_master'){
                        $station_master = new StationMasters();
                        $station_master->insert(array(
                            'station_master_id' => $user_id,
                            'station_master_station' => $_POST['station_master_station']
                        ));
                    }
                    // train_driver
                    else if($_POST["user_type"] == 'train_driver'){
                        $pin_code = '0000';
                        $hash_pin_code = md5($pin_code);

                        $train_driver = new TrainDrivers();
                        $train_driver->insert(array(
                            'train_driver_id' => $user_id,
                            'train_driver_pin_code' => $hash_pin_code
                        ));
                    }
                    
                    // staff_ticketing
                    else if($_POST["user_type"] == 'staff_ticketing'){
                        $staff_ticketing = new StaffTicketings();
                        $staff_ticketing->insert(array(
                            'staff_ticketing_id' => $user_id,
                            'staff_ticketing_station' => $_POST['staff_ticketing_station']
                        ));
                    }

                    // ticket_checker
                    else if($_POST["user_type"] == 'ticket_checker'){
                        $pin_code = '0000';
                        $hash_pin_code = md5($pin_code);

                        $ticket_checker = new TicketCheckers();
                        $ticket_checker->insert(array(
                            'ticket_checker_id' => $user_id,
                            'ticket_checker_pin_code' => $hash_pin_code
                        ));
                    }


                    // check if files are set in $_FIlES
                    
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

                    $this->view('includes/loader');

                    $to = $_POST['user_email'];
                    $recipient = $_POST['user_first_name'] . " " . $_POST['user_last_name'];
                    $subject = "Account Created";
                    $message = "Your account has been created. Please login to the system using the following credentials.
                                 <h3>Username: " . $_POST['login_username']. "<h3>
                                 <h3>Password: " . $_POST['login_password']. "<h3>
                                <br>
                                Make sure to verify the email before login.
                                <br>";

                    $body = Auth::getEmailBody($recipient, $message);

                    $this->sendMail($to,$recipient, $subject, $body);

                     // send email to verify email
                     $to_email = $_POST['user_email'];
                     $subject = "Email Verification";
                     $recipient = $_POST['user_first_name'];
                     $message ="Please verify your email address by clicking the link below.<br> <a href='" . ROOT . "/user/verifyEmail/" . $user_id . "'>Verify Email</a>";
                     $message = Auth::getEmailBody($_POST['user_first_name'], $message);
 
                     $this->sendMail($to_email, $recipient, $subject, $message);


                } catch (PDOException $e) {
                    die($e->getMessage());
                }

                $this->redirect('user/register?success=1');
            } else {
                $data['errors'] = $user->errors;
            }
        }


        $this->view('add.user.admin', $data);
    }

    function search($id = '')
    {
        $this->view('search.test.user.admin');
    }

    public function getUserImage($folder, $file)
    {
        $this->getPrivateImage($folder, $file);
    }

    public function verifyEmail($user_id)
    {
        $data = array();
        $user = new Users();
        $user->update($user_id, array('user_is_email_verified' => 1), 'user_id');

        $this->redirect('login');
        
    }
}
