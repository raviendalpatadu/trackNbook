<?php

/**
 * home controller
 */
class Dashboard extends Controller
{
    function index($id = '')
    {
        if (Auth::is_logged_in()) {
            $this->view('dashboard');
        } else {
            $this->redirect('login');
        }

    }
    function admin($id = '')
    {
        if (Auth::is_logged_in()) {
            $user = new Users();
            $data['usersCount'] = $user->getCount();
            $train = new Trains();
            $data['trainsCount'] = $train->getCount();
            $train_disable = new TrainDisablePeriods();
            $data['trains'] = $train_disable->getAllDisableTrains();
            $this->view('admin.dashboard', $data);
        } else {
            $this->view('login');
        }
    }

    //to be made
    function staff_general($id = '')
    {
        if (Auth::is_logged_in()) {
            $train = new Trains();
            $data = array();

            $data['trains'] = $train->findAllTrains();
            $this->view('staff_general.dashboard', $data);
        } else {
            $this->view('login');
        }
    }
    //to be made
    function staff_ticketing($id = '')
    {
        if (Auth::is_logged_in()) {
            $this->view('staff_ticketing.dashboard');
        } else {
            $this->view('login');
        }
    }
    //to be made
    function train_driver($id = '')
    {
        $this->view('dashboard.traindriver');
    }
    //to be made
    function station_master($id = '')
    {
        $station = new Stations();
        $data = array();
        $data['stations'] = $station->getStations();
        $train = new Trains();
        $inquiry = new Inquiries();
        $data['inquiries'] = $inquiry->getInquiry();


        $data['trains'] = $train->getAllTrainsByStation($_SESSION['USER']->user_data);
        //get count of the trains by station
        
        $waitinglist = new WaitingLists();
        $data['waitinglistCount'] = $waitinglist->getCount();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        $this->view('dashboard.stationmaster', $data);

    }

    function ticket_checker($id = '')
    {
        $this->view('dashboard.ticketchecker');
    }

}