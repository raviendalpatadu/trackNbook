<?php

class Users extends Model
{

    protected $table = 'tbl_user';
    protected $alloewdCollumns = array('user_title', 'user_first_name', 'user_last_name', 'user_phone_number', 'user_type', 'user_gender', 'user_email', 'user_nic', 'user_is_email_verified');

    public function __construct()
    {
        parent::__construct();
    }


    public function login()
    {
        $errors = array();

        //check if username is exists
        $query = "select * from tbl_login where login_username = :username";
        $data = $this->query($query, array(
            'username' => $_POST['username']
        ));

        if ($data > 0) {
            //check if username and password is correct
            $query = "SELECT u.user_id, u.user_title, u.user_first_name , u.user_last_name, u.user_phone_number,u.user_type, u.user_gender, u.user_email, u.user_nic, tbl_image.image_path 
                    FROM tbl_user as u 
                    JOIN tbl_login ON u.user_id = tbl_login.user_id 
                    LEFT JOIN tbl_image ON u.user_id = tbl_image.user_id
                    WHERE login_username = :username and login_password = :password and u.user_is_email_verified = :user_is_email_verified";
            $data_pass = $this->query($query, array(
                'username' => $_POST['username'],
                'password' => md5($_POST['password']),
                'user_is_email_verified' => 1
            ));



            if ($data_pass > 0) {
                return $data_pass;
            } elseif (!$data_pass) {
                $errors['error']['invalid_password'] = 'Invalid Password';
            }
        } elseif (!$data) {
            $errors['error']['invalid_uname'] = 'Invalid Username';
        }
        return $errors;
    }

    public function staffLogin()
    {
        $errors = array();

        //check if username is exists
        $query = "select * from tbl_login where login_username = :username";
        $data = $this->query($query, array(
            'username' => $_POST['username']
        ));

        if ($data > 0) {
            //check if username and password is correct
            $query = "SELECT u.user_id, u.user_title, u.user_first_name , u.user_last_name, u.user_phone_number,u.user_type, u.user_gender, u.user_email, u.user_nic, tbl_image.image_path,
            CASE u.user_type
                WHEN 'ticket_checker' THEN tbl_ticket_checker.pin_changed
                WHEN 'train_driver' THEN tbl_train_driver.pin_changed
                WHEN 'station_master' THEN tbl_station_master.station_master_station
                WHEN 'staff_ticketing' THEN tbl_staff_ticketing.staff_ticketing_station
                    END AS user_data
                FROM tbl_user as u 
                JOIN tbl_login ON u.user_id = tbl_login.user_id 
                LEFT JOIN tbl_image ON u.user_id = tbl_image.user_id
                LEFT JOIN tbl_ticket_checker ON u.user_id = tbl_ticket_checker.ticket_checker_id
                LEFT JOIN tbl_train_driver ON u.user_id = tbl_train_driver.train_driver_id
                LEFT JOIN tbl_station_master ON u.user_id = tbl_station_master.station_master_id
                LEFT JOIN tbl_staff_ticketing ON u.user_id = tbl_staff_ticketing.staff_ticketing_id
                WHERE login_username = :username and login_password = :password";
            $data_pass = $this->query($query, array(
                'username' => $_POST['username'],
                'password' => md5($_POST['password'])
            ));



            if ($data_pass > 0) {
                // check if user type is passenger
                if ($data_pass[0]->user_type == 'passenger') {
                    $errors['error']['invalid_uname'] = 'Invalid Username';
                    return $errors;
                } 

                return $data_pass;
            } elseif (!$data_pass) {
                $errors['error']['invalid_password'] = 'Invalid Password';
            }
        } elseif (!$data) {
            $errors['error']['invalid_uname'] = 'Invalid Username';
        }
        return $errors;
    }

    public function gUserType($userid)
    {
        $query = "select * from tbl_user where user_id = :userid";
        $data = $this->query($query, array(
            'userid' => $userid
        ));

        if ($data > 0) {
            return $data[0]->user_type;
        } elseif (!$data) {
            $errors['error'] = 'invalid userid';
            return $errors;
        }
    }

    public function getUserImage($userid)
    {
        $query = "select * from tbl_image where user_id = :userid";
        $data = $this->query($query, array(
            'userid' => $userid
        ));

        if ($data > 0) {
            return $data[0]->image_path;
        } elseif (!$data) {
            $errors['error'] = 'invalid userid or no user found';
            return $errors;
        }
    }

    public function addUserValidateAdmin()
    {
        

        //check if username is exists in post
        if (empty($_POST['login_username'])) {
            $this->errors['errors']['login_username'] = 'Username is required';
        }

        //check username allready exists
        $query = "select * from tbl_login where login_username = :username";
        $data = $this->query($query, array(
            'username' => $_POST['login_username']
        ));
        if ($data > 0) {
            $this->errors['errors']['login_username'] = 'Username allready exists';
        }

        //check if password is exists in post
        if (empty($_POST['login_password'])) {
            $this->errors['errors']['login_password'] = 'Password is required';
        }

        //check if confirm password is exists 
        if (empty($_POST['login_confirm_password'])) {
            $this->errors['errors']['login_confirm_password'] = 'Confirm Password is required';
        }

        //check if password and confirm password is match
        if ($_POST['login_password'] != $_POST['login_confirm_password']) {
            $this->errors['errors']['login_confirm_password'] = 'Password and Confirm Password is not match';
        }


        //check if first name is exists in post
        if (empty($_POST['user_first_name'])) {
            $this->errors['errors']['user_first_name'] = 'First Name is required';
        }

        //check if last name is exists in post
        if (empty($_POST['user_last_name'])) {
            $this->errors['errors']['user_last_name'] = 'Last Name is required';
        }

        //check if phone number is exists in post
        if (empty($_POST['user_phone_number'])) {
            $this->errors['errors']['user_phone_number'] = 'Phone Number is required';
        }
        //check phone number is 10 digits
        // if (!preg_match("/^[0-9]{10}$/", $_POST['user_phone_number'])) {
        //     $this->errors['errors']['user_phone_number'] = 'Please enter a valid Phone Number';
        // }

        //check nic is exists in post
        if (empty($_POST['user_nic'])) {
            $this->errors['errors']['user_nic'] = 'NIC is required';
        }

        //check if email is exists in post
        if (empty($_POST['user_email'])) {
            $this->errors['errors']['user_email'] = 'Email is required';
        }

        //check if email is valid
        if (!filter_var($_POST['user_email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['errors']['user_email'] = 'Invalid Email';
        }

        // check gender is exists in post it is a radio box
        if (empty($_POST['user_gender'])) {
            $this->errors['errors']['user_gender'] = 'Gender is required';
        }

        if (empty($_POST['user_type'])) {
            $this->errors['errors']['user_type'] = 'User type is required';
        }

        if (isset($_POST['user_type']) && $_POST['user_type'] == 'station_master') {
            if (empty($_POST['station_master_station'])) {
                $this->errors['errors']['station_master_station'] = 'Station is required';
            }
        }

        if (isset( $_POST['user_type']) && $_POST['user_type'] == 'staff_ticketing') {
            if (empty($_POST['staff_ticketing_station'])) {
                $this->errors['errors']['staff_ticketing_station'] = 'Station is required';
            }
        }

        if(empty($this->errors['errors']))
        {
            return true;
        }

        return false;
    }

    //update user
    public function updateUser($id, $data)
    {
        $errors = array();

        //check if title exists in post
        if (empty($data['user_title'])) {
            $errors['errors']['user_title'] = 'Title is required';
        }

        //check if first name is exists in post
        if (empty($data['user_first_name'])) {
            $errors['errors']['user_first_name'] = 'First Name is required';
        }

        //check if last name is exists in post
        if (empty($data['user_last_name'])) {
            $errors['errors']['user_last_name'] = 'Last Name is required';
        }

        //check if phone number is exists in post
        if (empty($data['user_phone_number'])) {
            $errors['errors']['user_phone_number'] = 'Phone Number is required';
        }

        // 10 number validation
        if (strlen($data['user_phone_number']) != 10) {
            $errors['errors']['user_phone_number'] = 'Phone Number is invalid';
        }

        //check nic is exists in post
        if (empty($data['user_nic'])) {
            $errors['errors']['user_nic'] = 'NIC is required';
        } else {
            // 10 number validation o rGroup13 - SRS-TrackNBookm in it
            if (strlen($data['user_nic']) != 12) {
                if (strlen($data['user_nic']) == 10) {
                    $last_char = strtolower(substr($data['user_nic'], -1));
                    if ($last_char != 'v') {
                        $errors['errors']['user_nic'] = 'NIC is invalid last char is not V or v';
                    }
                } else {
                    $errors['errors']['user_nic'] = 'NIC is invalid';
                }
            }
        }



        //check if email is exists in post
        if (empty($data['user_email'])) {
            $errors['errors']['user_email'] = 'Email is required';
        }

        //check if email is valid
        if (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['errors']['user_email'] = 'Invalid Email';
        }

        // check gender
        if (empty($data['user_gender'])) {
            $errors['errors']['user_gender'] = 'Gender Required';
        }

        // check user type
        if (empty($data['user_type'])) {
            $errors['errors']['user_type'] = 'User Type Required';
        }


        if (!array_key_exists('errors', $errors)) {
            try {
                $con = $this->connect();

                $sql = "UPDATE tbl_user SET user_title = :user_title, user_first_name = :user_first_name, user_last_name = :user_last_name, user_phone_number = :user_phone_number, user_type = :user_type, user_gender = :user_gender, user_email = :user_email, user_nic = :user_nic WHERE user_id = :user_id;";
                $stmt = $con->prepare($sql);
                $result = $stmt->execute(array(
                    'user_title' => $data['user_title'],
                    'user_first_name' => $data['user_first_name'],
                    'user_last_name' => $data['user_last_name'],
                    'user_phone_number' => $data['user_phone_number'],
                    'user_type' => $data['user_type'],
                    'user_gender' => $data['user_gender'],
                    'user_email' => $data['user_email'],
                    'user_nic' => $data['user_nic'],
                    'user_id' => $data['user_id']
                ));

                if ($result == true) {
                    return $result;
                }
            } catch (PDOException $e) {
                return $e->getMessage();
            }
        }
        return $errors;
    }

    public function updateUserProfileValidate($id, $data)
    {
        $errors = array();

        //check if title exists in post
        if (empty($data['user_title'])) {
            $errors['errors']['user_title'] = 'Title is required';
        }

        //check if first name is exists in post
        if (empty($data['user_first_name'])) {
            $errors['errors']['user_first_name'] = 'First Name is required';
        }

        //check if last name is exists in post
        if (empty($data['user_last_name'])) {
            $errors['errors']['user_last_name'] = 'Last Name is required';
        }

        //check if phone number is exists in post
        if (empty($data['user_phone_number'])) {
            $errors['errors']['user_phone_number'] = 'Phone Number is required';
        }

        // 10 number validation
        if (strlen($data['user_phone_number']) != 10) {
            $errors['errors']['user_phone_number'] = 'Phone Number is invalid';
        }

        //check nic is exists in post
        if (empty($data['user_nic'])) {
            $errors['errors']['user_nic'] = 'NIC is required';
        } else {
            // 10 number validation o rGroup13 - SRS-TrackNBookm in it
            if (strlen($data['user_nic']) != 12) {
                if (strlen($data['user_nic']) == 10) {
                    $last_char = strtolower(substr($data['user_nic'], -1));
                    if ($last_char != 'v') {
                        $errors['errors']['user_nic'] = 'NIC is invalid last char is not V or v';
                    }
                } else {
                    $errors['errors']['user_nic'] = 'NIC is invalid';
                }
            }
        }



        //check if email is exists in post
        if (empty($data['user_email'])) {
            $errors['errors']['user_email'] = 'Email is required';
        }

        //check if email is valid
        if (!filter_var($data['user_email'], FILTER_VALIDATE_EMAIL)) {
            $errors['errors']['user_email'] = 'Invalid Email';
        }


        return $errors;
    }

    public function getUsers($column, $value)
    {

        try {
            $result = $this->where($column, $value);
            //sort an array in assending order
            if ($result > 0) {
                return $result;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
