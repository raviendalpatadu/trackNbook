<?php

class CompartmentTypes extends Model
{
    protected $table = 'tbl_compartment_class_type';

    public function __construct()
    {
        parent::__construct();
    }


    // public function findAllTrains()
    // {


    //     $data = array();


    //     try {
    //         $con = $this->connect();
    //         $con->beginTransaction();

    //         //insert query to search train must come form route
    //         $query = "SELECT\n"

    //             . "tbl_train.*,\n"

    //             . "start.station_name AS start_station,\n"

    //             . "end.station_name AS end_station\n"

    //             . "\n"

    //             . "FROM\n"

    //             . "	tbl_train\n"

    //             . "JOIN\n"

    //             . "	tbl_station AS start ON tbl_train.train_start_station = start.station_id\n"

    //             . " JOIN\n"

    //             . " 	tbl_station AS end ON tbl_train.train_end_station = end.station_id ";
    //         $stm = $con->prepare($query);

    //         $stm->execute();

    //         $data = $stm->fetchAll(PDO::FETCH_OBJ);
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }

    //     if ($data > 0) {
    //         return $data;
    //     }
    // }
    // public function search()
    // {
    //     $errors = array();


    //     $data = array();
    //     //   //check if to_station is exists in post
    //     if (empty($_POST['to_station']) || $_POST['to_station'] == 0) {
    //         $errors['errors']['to_station'] = 'Station is required';
    //     }

    //     //check if from_station is exists in post
    //     if (empty($_POST['from_station']) || $_POST['from_station'] == 0) {
    //         $errors['errors']['from_station'] = 'Staion is required';
    //     }

    //     //check if from staion = to_station
    //     if (!(array_key_exists('errors', $errors)) && $_POST['from_station'] == $_POST['to_station']) {
    //         $errors['errors']['from_station'] = 'From and To stations are same';
    //         $errors['errors']['to_station'] = 'From and To stations are same';
    //     }

    //     //check if from date is exists in post
    //     if (empty($_POST['from_date'])) {
    //         $errors['errors']['from_date'] = 'date is required';
    //     }

    //     if (isset($_POST['return'])) {
    //         //check if to date is exists in post
    //         if (empty($_POST['to_date'])) {
    //             $errors['errors']['to_date'] = 'Date is required';
    //         }
    //     }

    //     //check if from no of passengers is exists in post
    //     if (empty($_POST['no_of_passengers'])) {
    //         $errors['errors']['no_of_passengers'] = 'Passenger count is required';
    //     }


    //     if (!array_key_exists('errors', $errors)) {

    //         try {
    //             $con = $this->connect();
    //             $con->beginTransaction();

    //             //insert query to search train must come form route
    //             $query = "WITH StartingTrains AS (
    //                         SELECT *
    //                         FROM tbl_train_stop_station
    //                         WHERE station_id = (SELECT station_id FROM tbl_station WHERE station_id = :from_station) 
    //                     ),
    //                     CountReservations AS (
    //                         SELECT c.*, COUNT(r.reservation_id) AS no_of_reservations
    //                             FROM
    //                                 tbl_compartment c
    //                             LEFT JOIN
    //                                 tbl_reservation r ON c.compartment_id = r.reservation_compartment_id AND r.reservation_date = :from_date
    //                             GROUP BY
    //                                 c.compartment_id, c.compartment_class_type
    //                             )
    //                     SELECT DISTINCT 
    //                         train.train_id, train.train_name, train.train_type, train.train_start_time, train.train_end_time, 
    //                         start.station_name AS train_start_station,
    //                     end.station_name AS train_end_station,
    //                         reservation.* 
    //                     FROM StartingTrains ST
    //                     JOIN tbl_train_stop_station TS1 ON ST.train_id = TS1.train_id
    //                     JOIN tbl_train_stop_station TS2 ON TS1.train_id = TS2.train_id
    //                     JOIN tbl_train train ON ST.train_id = train.train_id
    //                     JOIN tbl_station AS start ON train.train_start_station = start.station_id
    //                     JOIN tbl_station AS end ON train.train_end_station = end.station_id
    //                     JOIN tbl_compartment AS compartment ON compartment.compartment_train_id = train.train_id
    //                     JOIN CountReservations AS reservation ON reservation.compartment_id = compartment.compartment_id
    //                     WHERE TS1.station_id = (SELECT station_id FROM tbl_station WHERE station_id = :from_station) 
    //                         AND TS2.station_id = (SELECT station_id FROM tbl_station WHERE station_id = :to_station) 
    //                         AND TS1.stop_no < TS2.stop_no
    //                         AND reservation.compartment_total_seats > reservation.no_of_reservations;";
    //             $stm = $con->prepare($query);

    //             $stm->execute(
    //                 array(
    //                     'from_station' => $_POST['from_station'],
    //                     'to_station' => $_POST['to_station'],
    //                     'from_date' => $_POST['from_date']
    //                 )
    //             );

    //             $data['trains'] = $stm->fetchAll(PDO::FETCH_OBJ);
    //         } catch (PDOException $e) {
    //             echo $e->getMessage();
    //         }

    //         if ($data > 0) {
    //             return $data;
    //         }
    //     }
    //     return $errors;
    // }

    // public function addTrain()
    // {
    //     $con = $this->connect();
    //     $errors = array();

    //     // Check if required fields are empty
    //     if (empty($_POST['train_name'])) {
    //         $errors['train_name'] = 'Train Name is required';
    //     }

    //     if (empty($_POST['train_route'])) {
    //         $errors['train_route'] = 'Train route is required';
    //     }

    //     if (empty($_POST['start_station'])) {
    //         $errors['start_station'] = 'Start Station is required';
    //     }

    //     if (empty($_POST['end_station'])) {
    //         $errors['end_station'] = 'End Station is required';
    //     }

    //     if (empty($_POST['start_time'])) {
    //         $errors['start_time'] = 'Start Time is required';
    //     }

    //     if (empty($_POST['end_time'])) {
    //         $errors['end_time'] = 'End Time is required';
    //     }

    //     if (empty($_POST['train_type'])) {
    //         $errors['train_type'] = 'Train Type is required';
    //     }

    //     if (empty($errors)) {
    //         try {
    //             $query = "INSERT INTO tbl_train (train_name, train_type, train_start_time, train_end_time, train_start_station, train_end_station, train_route)
    //                       VALUES (:train_name, :train_type, :train_start_time, :train_end_time, :train_start_station, :train_end_station, :train_route)";

    //             $stm = $con->prepare($query);
    //             $stm->execute(array(
    //                 'train_name' => $_POST['train_name'],
    //                 'train_type' => $_POST['train_type'],
    //                 'train_start_time' => $_POST['start_time'],
    //                 'train_end_time' => $_POST['end_time'],
    //                 'train_start_station' => $_POST['start_station'],
    //                 'train_end_station' => $_POST['end_station'],
    //                 'train_route' => $_POST['train_route']
    //             ));

    //             return true; // Successful insertion
    //         } catch (PDOException $e) {
    //             echo $e->getMessage();
    //         }
    //     }
    //     return $errors;
    // }




    // //get reservation for a specific train
    // public function getTrainReservation($class_id = "", $train_id = "")
    // {
    //     $con = $this->connect();

    //     $date = $_SESSION['reservation']['from_date'];

    //     try {
    //         $query = "SELECT t.*, r.*, c.*,\n"
    //             . "start.station_name AS start_station,\n"

    //             . "end.station_name AS end_station\n"

    //             . " FROM tbl_train t\n"

    //             . " JOIN tbl_reservation r ON t.train_id = r.reservation_train_id\n"

    //             . " JOIN tbl_station start ON t.train_start_station = start.station_id\n"

    //             . " JOIN tbl_station end ON t.train_end_station = end.station_id\n"

    //             . " JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id\n"

    //             . " WHERE r.reservation_train_id = :train_id AND r.reservation_date = :date AND r.reservation_class = :class";

    //         $stm = $con->prepare($query);

    //         $stm->execute(array(
    //             'train_id' => $train_id,
    //             'class' => $class_id,
    //             'date' => $date
    //         ));
    //         $data = $stm->fetchAll(PDO::FETCH_OBJ);
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }

    //     if ($data > 0) {
    //         return $data;
    //     }
    // }

    // public function getTrain($id)
    // {
    //     try {
    //         $con = $this->connect();
    //         $con->beginTransaction();

    //         //insert query to search train must come form route
    //         $query = "SELECT\n"

    //             . "tbl_train.*,\n"

    //             . "start.station_name AS start_station,\n"

    //             . "end.station_name AS end_station\n"

    //             . "\n"

    //             . "FROM\n"

    //             . "	tbl_train\n"

    //             . "JOIN\n"

    //             . "	tbl_station AS start ON tbl_train.train_start_station = start.station_id\n"

    //             . " JOIN\n"

    //             . " 	tbl_station AS end ON tbl_train.train_end_station = end.station_id\n"

    //             . "WHERE\n"

    //             . "	tbl_train.train_id = :train_id LIMIT 1";
    //         $stm = $con->prepare($query);

    //         $stm->execute(array(
    //             'train_id' => $id
    //         ));

    //         $data = $stm->fetchAll(PDO::FETCH_OBJ);
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //     }

    //     if ($data > 0) {
    //         return $data[0];
    //     }
    // }

    // public function updateTrain($id, $data)
    // {
    //     $con = $this->connect();
    //     $errors = array();

    //     // Check if required fields are empty
    //     if (empty($data['train_name'])) {
    //         $errors['train_name'] = 'Train Name is required';
    //     }

    //     if (empty($data['train_route'])) {
    //         $errors['train_route'] = 'Train route is required';
    //     }

    //     if (empty($data['start_station'])) {
    //         $errors['start_station'] = 'Start Station is required';
    //     }

    //     if (empty($data['end_station'])) {
    //         $errors['end_station'] = 'End Station is required';
    //     }

    //     if (empty($data['start_time'])) {
    //         $errors['start_time'] = 'Start Time is required';
    //     }

    //     if (empty($data['end_time'])) {
    //         $errors['end_time'] = 'End Time is required';
    //     }

    //     if (empty($data['train_type'])) {
    //         $errors['train_type'] = 'Train Type is required';
    //     }

    //     if (empty($errors)) {
    //         try {
    //             $query = "UPDATE tbl_train SET train_name = :train_name, train_type = :train_type, train_start_time = :train_start_time, train_end_time = :train_end_time, train_start_station = :train_start_station, train_end_station = :train_end_station, train_route = :train_route WHERE train_id = :train_id";

    //             $stm = $con->prepare($query);
    //             $stm->execute(array(
    //                 'train_name' => $data['train_name'],
    //                 'train_type' => $data['train_type'],
    //                 'train_start_time' => $data['start_time'],
    //                 'train_end_time' => $data['end_time'],
    //                 'train_start_station' => $data['start_station'],
    //                 'train_end_station' => $data['end_station'],
    //                 'train_route' => $data['train_route'],
    //                 'train_id' => $id
    //             ));

    //             return true; // Successful insertion
    //         } catch (PDOException $e) {
    //             echo $e->getMessage();
    //         }
    //     }
    //     return $errors;
    // }
}


// SELECT DISTINCT
//     tbl_train_stop_station.stop_no,
//     train.train_name,
//     start.station_name AS train_start_station,
//     end.station_name AS train_end_station,
//     p_s_station.station_name AS p_start,
//     p_e_station.station_name AS p_end
// FROM
// 	tbl_train_stop_station
// JOIN
// 	tbl_station AS station ON tbl_train_stop_station.station_id = station.station_id
// JOIN
// 	tbl_station AS p_s_station ON tbl_train_stop_station.station_id = p_s_station.station_id
// JOIN
// 	tbl_station AS p_e_station ON tbl_train_stop_station.station_id = p_e_station.station_id
// JOIN
// 	tbl_train AS train ON tbl_train_stop_station.train_id = train.train_id
// JOIN
//     tbl_station AS start ON train.train_start_station = start.station_id
// JOIN
//     tbl_station AS end ON train.train_end_station = end.station_id;
    
//  # get positive and negative for another direction