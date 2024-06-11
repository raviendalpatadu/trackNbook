<?php

/**
 * profile controller
 */

class Payment extends Controller
{
    function index($id = '')
    {
        $data = Auth::payment($_POST['payment_data']);
        echo json_encode($data);
    }
    

}