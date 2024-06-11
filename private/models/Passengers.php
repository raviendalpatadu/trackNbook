<?php
class Passengers extends Model
{
    protected $table = 'tbl_passengers';
    protected $allowedColumns = array('passenger_id', 'passenger_email', 'passenger_nic');


    public function __construct()
    {
        parent::__construct();
    }

    public function getPassengers()
    {
        $result = $this->findAll();
        return $result;
    }

    public function addPassengerValidation()
    {
        $errors = array();


        //check if username is exists in post
        if (empty($_POST['login_username'])) {
            $errors['errors']['login_username'] = 'Username is required';
        }

        //check username allready exists
        $query = "select * from tbl_login where login_username = :username";
        $data = $this->query($query, array(
            'username' => $_POST['login_username']
        ));
        if ($data > 0) {
            $errors['errors']['login_username'] = 'Username allready exists';
        }

        //check if password is exists in post
        if (empty($_POST['login_password'])) {
            $errors['errors']['login_password'] = 'Password is required';
        }

        //check if confirm password is exists 
        if (empty($_POST['login_confirm_password'])) {
            $errors['errors']['login_confirm_password'] = 'Confirm Password is required';
        }

        //check if password and confirm password is match
        if ($_POST['login_password'] != $_POST['login_confirm_password']) {
            $errors['errors']['login_confirm_password'] = 'Password and Confirm Password is not match';
        }


        //check if first name is exists in post
        if (empty($_POST['user_first_name'])) {
            $errors['errors']['user_first_name'] = 'First Name is required';
        }

        //check if last name is exists in post
        if (empty($_POST['user_last_name'])) {
            $errors['errors']['user_last_name'] = 'Last Name is required';
        }

        //check if phone number is exists in post
        if (empty($_POST['user_phone_number'])) {
            $errors['errors']['user_phone_number'] = 'Phone Number is required';
        }

        // 10 number validation


        //check nic is exists in post
        if (empty($_POST['user_nic'])) {
            $errors['errors']['user_nic'] = 'NIC is required';
        }

        // 10 number validation o rGroup13 - SRS-TrackNBookm in it
        // 10 number validation
        if (strlen($_POST['user_phone_number']) != 10) {
            $errors['errors']['user_phone_number'] = 'Phone Number is invalid';
        }

        //check nic is exists in post
        if (empty($_POST['user_nic'])) {
            $errors['errors']['user_nic'] = 'NIC is required';
        } else {
            // 10 number validation o rGroup13 - SRS-TrackNBookm in it
            if (strlen($_POST['user_nic']) != 12) {
                if (strlen($_POST['user_nic']) == 10) {
                    $last_char = strtolower(substr($_POST['user_nic'], -1));
                    if ($last_char != 'v') {
                        $errors['errors']['user_nic'] = 'NIC is invalid last char is not V or v';
                    }
                } else {
                    $errors['errors']['user_nic'] = 'NIC is invalid';
                }
            }
        }

        //check if email is exists in post
        if (empty($_POST['user_email'])) {
            $errors['errors']['user_email'] = 'Email is required';
        }

        //check if email is valid
        if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['errors']['user_email'] = 'Invalid Email';
        }

        // check gender is exists in post it is a radio box
        if (empty($_POST['user_gender'])) {
            $errors['errors']['user_gender'] = 'Gender is required';
        }

        // is image uploaded
        if (isset($_POST['user_image']) && empty($_FILES['user_image']['name'])) {
            $allowed_types = array('image/jpeg', 'image/jpg', 'image/png');

            if (!in_array($_FILES['user_image']['type'], $allowed_types)) {
                $errors['errors']['user_image'] = 'Image is invalid';
            }

            // if ($_FILES['user_image']['size'] > 2097152) {
            //     $errors['errors']['user_image'] = 'Image is too large';
            // }

            if ($_FILES['user_image']['error'] > 0) {
                $errors['errors']['user_image'] = 'Image is invalid';
            }
        }

        // auto pgender validatiaon
        return $errors;
    }

    public function getPassengerDataOfNextStation($train_id, $station_id){
        $query = "WITH current_st AS ( 
            SELECT tss.*
            FROM tbl_train_stop_station tss 
            WHERE tss.train_id = :train_id AND tss.station_id = :station_id
            ),
            next_st AS (
            SELECT ts.*
            FROM tbl_train_stop_station ts , current_st cs
            WHERE ts.train_id = :train_id AND ts.stop_no BETWEEN cs.stop_no+1 AND cs.stop_no + 2
            )
            
            SELECT r.* 
            FROM tbl_reservation r , next_st ns
            WHERE r.reservation_start_station = ns.station_id AND r.reservation_date = :date
            AND r.reservation_status = 'Reserved'";

        $result =  $this->query($query, [
            'train_id' => $train_id,
            'station_id' => $station_id,
            'date' => date('Y-m-d')
        ]);

        if($result != null){
            return $result;
        } else {
            return [];
        }
    }
}
