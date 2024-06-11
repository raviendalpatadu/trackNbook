<?php

/**
 * home controller
 */

class Home extends Controller
{
    function index($id = '')
    {
        $station = new Stations();
        $data = array();
        $data['stations'] = $station->getStations();

        if (isset($_SESSION['reservation'])) {
            if (isset(Auth::reservation()['reservation_status']) && Auth::reservation()['reservation_status'] == "Pending") {
                $reservation = new Reservations();
                try {
                    foreach (Auth::reservation()['reservation_id']['from'] as $key => $value) {
                        $reservation->callProcedure('expire_reservation', array($value));
                    }

                    if (Auth::reservation()['return'] == 'on') {
                        foreach (Auth::reservation()['reservation_id']['to'] as $key => $value) {
                            $reservation->callProcedure('expire_reservation', array($value));
                        }
                    }

                    
                } catch (Exception $e) {
                    die($e->getMessage());
                }
            }

            unset($_SESSION['reservation']);
        }

        if (isset($_SESSION['errors'])) {
            $data['errors'] = $_SESSION['errors'];
            unset($_SESSION['errors']);
        }
        // unset($_SESSION['error']);

        if ($_SERVER['REQUEST_METHOD'] == 'POST' || isset($_POST['submit'])) {
            $home = new Homes();

            if ($home->validate($_POST) == false) {

                // concat 2 arrays
                $data = array_merge($data, $home->errors);
                $this->view('home', $data);
            } else {

                $data['from_date'] = $_POST['from_date'];
                $data['from_station'] = $station->getOneStation('station_id', $_POST['from_station']);
                $data['to_station'] = $station->getOneStation('station_id', $_POST['to_station']);
                $data['no_of_passengers'] = $_POST['no_of_passengers'];
                $data['return'] = (isset($_POST['return'])) ? $_POST['return'] : 0;

                if (isset($_POST['to_date'])) {
                    $data['to_date'] = $_POST['to_date'];
                }

                // setcookie('reservation', json_encode($data), time() + 300, '/');
                if (isset($data['stations'])) {
                    unset($data['stations']);
                }

                $_SESSION['reservation'] = $data;

                $this->redirect('train/available');
            }
        } else {
            $this->view('home', $data);
        }
    }

    function validate()
    {

        $home = new Homes();

        if ($home->validate($_POST)) :
            echo json_encode(true);
        else :
            echo json_encode($home->errors);
        endif;
    }
}
