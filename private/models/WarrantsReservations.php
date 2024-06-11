<?php

class WarrantsReservations extends Model
{
    protected $table = 'tbl_warrant_reservation';


    public function __construct()
    {
        parent::__construct();
    }



    public function getReservation()
    {
        try {
            $result = $this->findAll();
            //sort an array in assending order
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }
    public function getReservations($id)
    {
        $result = [];

        try {
            $query = "WITH compartments AS (
                        SELECT c.compartment_id, ct.* 
                        FROM tbl_compartment c
                        JOIN tbl_compartment_class_type ct on c.compartment_class_type = ct.compartment_class_type_id
                        )

                        SELECT r.*, wr.* , c.compartment_class_type, t.*
                        FROM tbl_reservation r
                        JOIN tbl_warrant_reservation wr ON wr.warrant_reservation_id = r.reservation_id 
                        JOIN tbl_train t ON r.reservation_train_id = t.train_id
                        JOIN compartments c ON r.reservation_compartment_id = c.compartment_id

                        WHERE wr.warrant_id = :id

                        GROUP BY r.reservation_id;";

            $result = $this->query($query, [
                'id' => $id
            ]);
            if(is_array($result) && count($result) > 0){
                return $result;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getReservationsByTicketNo($id)
    {
        $result = [];

        try {
            $query = "WITH compartments AS (
                        SELECT c.compartment_id, ct.* 
                        FROM tbl_compartment c
                        JOIN tbl_compartment_class_type ct on c.compartment_class_type = ct.compartment_class_type_id
                        )

                        SELECT r.*, wr.* , c.compartment_class_type, t.*
                        FROM tbl_reservation r
                        JOIN tbl_warrant_reservation wr ON wr.warrant_reservation_id = r.reservation_id 
                        JOIN tbl_train t ON r.reservation_train_id = t.train_id
                        JOIN compartments c ON r.reservation_compartment_id = c.compartment_id

                        WHERE r.reservation_ticket_id = :id

                        GROUP BY r.reservation_id;";

            $result = $this->query($query, [
                'id' => $id
            ]);
            if(is_array($result) && count($result) > 0){
                return $result;
            }
            return $result;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getjoinReservation()
    {

        try {

            $query = "WITH compartments AS (

                SELECT c.compartment_id, ct.* 

                FROM tbl_compartment c 

                JOIN tbl_compartment_class_type ct on c.compartment_class_type = ct.compartment_class_type_id)

               SELECT wr.*, r.*, c.compartment_class_type

                FROM tbl_warrant_reservation wr

                JOIN tbl_reservation r ON r.reservation_id = wr.warrant_reservation_id

                JOIN compartments c ON r.reservation_compartment_id = c.compartment_id

              

                GROUP BY r.reservation_ticket_id;";


            $result = $this->query($query);

            if(is_array($result) && count($result) > 0){
                return $result;
            }
            return [];
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getOneReservation($column, $value)
    {
        try {
            $result = $this->whereOne($column, $value);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    // public function addReservation($data)
    // {
    //     $user_id = $_SESSION['USER']->user_id;
    //     $train_id = $data['train_id'];
    //     $class_id = $data['class_id'];
    //     $from_station = $data['from_station'];
    //     $to_station = $data['to_station'];
    //     $from_date = $data['from_date'];
    //     $selected_seats = $data['selected_seats'];
    //     $no_of_passengers = $data['no_of_passengers'];
    //     $passenger_titles = $data['passenger_data']['user_title'];
    //     $passenger_first_names = $data['passenger_data']['user_first_name'];
    //     $passenger_last_names = $data['passenger_data']['user_last_name'];
    //     $passenger_nics = $data['passenger_data']['user_nic'];
    //     $passenger_phone_numbers = $data['passenger_data']['user_phone_number'];
    //     $passenger_emails = $data['passenger_data']['user_email'];


    //     try {
    //         $con = $this->connect();
    //         for ($insert_count = 0; $insert_count < $no_of_passengers; $insert_count++) {
    //             $query = "INSERT INTO tbl_reservation "
    //                 . "(reservation_passenger_id, reservation_start_station, reservation_end_station, reservation_train_id, reservation_date, reservation_class, reservation_seat, reservation_passenger_title, reservation_passenger_first_name, reservation_passenger_last_name, reservation_passenger_nic, reservation_passenger_phone_number, reservation_passenger_email, reservation_passenger_gender) "
    //                 . "VALUES(:passenger_id, :from_station, :end_station, :train_id, :date, :class_id, :seat, :title, :first_name, :last_name, :nic, :phone_number, :email, :gender)";
    //             // echo $query . "<br>";
    //             $stm = $con->prepare($query);
    //             $stm->execute(array(
    //                 'passenger_id' => $user_id,
    //                 'from_station' => $from_station,
    //                 'end_station' => $to_station,
    //                 'train_id' => $train_id,
    //                 'date' => $from_date,
    //                 'class_id' => $class_id,
    //                 'seat' => $selected_seats[$insert_count],
    //                 'title' => $passenger_titles[$insert_count],
    //                 'first_name' => $passenger_first_names[$insert_count],
    //                 'last_name' => $passenger_last_names[$insert_count],
    //                 'nic' => $passenger_nics[$insert_count],
    //                 'phone_number' => $passenger_phone_numbers[$insert_count],
    //                 'email' => $passenger_emails[$insert_count],
    //                 'gender' => $data['passenger_data']['user_gender' . $insert_count]
    //             ));
    //         }
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    //     $con = null;

    //     // unset($_SESSION['reservation']);
    //     return true;

    // }

    // public function cancelReservation($reservation_id, $passenger_nic)
    // {
    //     try {
    //         $con = $this->connect();
    //         $query = "DELETE FROM tbl_reservation WHERE reservation_id = :reservation_id AND reservation_passenger_nic = :passenger_nic";
    //         $stm = $con->prepare($query);
    //         $stm->execute(array(
    //             'reservation_id' => $reservation_id,
    //             'passenger_nic' => $passenger_nic
    //         ));
    //     } catch (PDOException $e) {
    //         echo $e->getMessage();
    //         return false;
    //     }
    //     $con = null;

    //     // echo true;//for ajax call
    //     return true;   
    // }
}
