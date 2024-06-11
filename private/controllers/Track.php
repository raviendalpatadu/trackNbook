<?php

/**
 * home controller
 */

class Track extends Controller
{
    function index($id = '')
    {   
        $this->view('track');
    }
}
