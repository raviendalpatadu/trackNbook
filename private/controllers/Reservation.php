<?php

/**
 * home controller
 */

class Reservation extends Controller
{
    function add($id = '')
    {   
        // $this->view('');
        $this->view('includes/header');
        $this->view('includes/loader');

    }

    function getReservation($id = '')
    {
        $reservation = new Reservations();
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }

   
    

}
