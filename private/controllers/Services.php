<?php

/**
 * home controller
 */

class Services extends Controller
{
    function index($id = '')
    {
        $this->view('services');
    }
    function manage($id = '')
    {
        $this->view('admin.manage');
    }
    function contact($id = '')
    {
        $this->view('contact');
    }
    function termsAndConditions($id = '')
    {
        $this->view('terms');
    }

    function inquires($id = '')
    {
        $this->view('passenger.inquiry');
    }
}