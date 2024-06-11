<?php

/**
 * home controller
 */

class Logout extends Controller
{
    function index($id = '')
    {
         
        
        if (Auth::getUser_type() == 'train_driver') {
            unset($_SESSION['train_driver']);
        }
        if (Auth::getUser_type() == 'ticket_checker') {
            unset($_SESSION['work_train']);
        }

        Auth::logout();
        
        $this->redirect('login');
    }

    
}
