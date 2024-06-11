<?php

/**
 * home controller
 */

class Station extends Controller
{
    function index($id = '')
    {
        $this->view('track');
    }


    function addStation($id = '')
    {
        $data = array();
        $station = new Stations();

        if (isset($_POST['submit'])) {
            // Instantiate the $station variable
            if($res = $station->validate($_POST)) {
                $data = $station->insert($_POST);
            } else{
                $data['errors'] = $station->errors;
            }
        }

        $this->view('add.station.admin', $data);
    }

}