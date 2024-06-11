<?php

class Logins extends Model{
    protected $table = 'tbl_login';
    protected $allowed_columns = ['login_username', 'login_password', 'user_id'];

    public function __construct(){
        parent::__construct();
    }

    public function changePasswordValidate($data){

       

        if(empty($data['current_password'])){
            $this->errors['errors']['current_password'] = 'Current Password is required';
        }

        if(empty($data['new_password'])){
            $this->errors['errors']['new_password'] = 'New Password is required';
        }

        if(empty($data['confirm_password'])){
            $this->errors['errors']['confirm_password'] = 'Confirm Password is required';
        }

        if($data['new_password'] != $data['confirm_password']){
            $this->errors['errors']['confirm_password'] = 'Password and Confirm Password is not match';
        }

        if(strlen($data['new_password']) < 8){
            $this->errors['errors']['new_password'] = 'Password must be at least 8 characters';
        }

        if (count($this->errors) > 0) {
            return false;
        }

        if(!count($this->errors) > 0){
         
            $query = "select * from tbl_login where user_id = :user_id and login_password = :login_password";
            $result = $this->query($query, array(
                'user_id' => $_SESSION['USER']->user_id,
                'login_password' => md5($data['current_password'])
            ));
            
            // return $result;
            if($result == false || $result[0]->login_password != md5($data['current_password'])){
                $this->errors['errors']['current_password'] = 'Current Password is incorrect';
            }      
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;

    }
    
}
