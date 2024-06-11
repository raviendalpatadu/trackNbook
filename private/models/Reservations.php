<?php

class Reservations extends Model
{
    protected $table = 'tbl_reservation';
    protected $allowedColumns = array('reservation_id', 'reservation_ticket_id', 'reservation_passenger_id', 'reservation_start_station', 'reservation_is_dependent', 'reservation_end_station', 'reservation_train_id', 'reservation_compartment_id', 'reservation_date', 'reservation_seat', 'reservation_passenger_title', 'reservation_passenger_first_name', 'reservation_passenger_last_name', 'reservation_passenger_nic', 'reservation_passenger_phone_number', 'reservation_passenger_email', 'reservation_passenger_gender', 'reservation_created_time', 'reservation_status', 'reservation_type', 'reservation_amount', 'reservation_is_travelled');



    public function __construct()
    {
        parent::__construct();
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function validatePassenger($data)
    {
        $errors = array();

        for ($entry = 0; $entry < count($data['reservation_passenger_title']); $entry++) {

            //check if title exists in post
            if (empty($data['reservation_passenger_title'][$entry])) {
                $this->errors['reservation_passenger_title'][$entry] = 'Title is required';
            }

            //check if first name is exists in post
            if (empty($data['reservation_passenger_first_name'][$entry])) {
                $this->errors['reservation_passenger_first_name'][$entry] = 'First Name is required';
            }

            //check if last name is exists in post
            if (empty($data['reservation_passenger_last_name'][$entry])) {
                $this->errors['reservation_passenger_last_name'][$entry] = 'Last Name is required';
            }

            // //check if phone number is exists in post
            // if (empty($data['reservation_passenger_phone_number'][$entry]) || !is_numeric($data['reservation_passenger_phone_number'][$entry])) {
            //     $this->errors['reservation_passenger_phone_number'][$entry] = 'Phone Number is required';
            // }

            // 10 number validation
            if (!empty($data['reservation_passenger_phone_number'][$entry]) && strlen($data['reservation_passenger_phone_number'][$entry]) != 10) {
                $this->errors['reservation_passenger_phone_number'][$entry] = 'Phone Number is invalid';
            }

            //check nic is exists in post

            if (empty($data['reservation_passenger_nic'][$entry])) {
                $this->errors['reservation_passenger_nic'][$entry] = 'NIC is required';
            } else {
                // 10 number validation o rGroup13 - SRS-TrackNBookm in it
                if (strlen($data['reservation_passenger_nic'][$entry]) != 12) {
                    if (strlen($data['reservation_passenger_nic'][$entry]) == 10) {
                        $last_char = strtolower(substr($data['reservation_passenger_nic'][$entry], -1));
                        if ($last_char != 'v') {
                            $this->errors['reservation_passenger_nic'][$entry] = 'NIC is invalid last char is not V or v';
                        }
                    } else {
                        $this->errors['reservation_passenger_nic'][$entry] = 'NIC is invalid';
                    }
                }
            }



            // //check if email is exists in post
            // if (empty($data['reservation_passenger_email'][$entry])) {
            //     $this->errors['reservation_passenger_email'][$entry] = 'Email is required';
            // }

            //check if email is valid
            if (!empty($data['reservation_passenger_email'][$entry]) && !filter_var($_POST['reservation_passenger_email'][$entry], FILTER_VALIDATE_EMAIL)) {
                $this->errors['reservation_passenger_email'][$entry] = 'Invalid Email';
            }

            // check gender
            if (empty($data['reservation_passenger_gender'][$entry])) {
                $this->errors['reservation_passenger_gender'][$entry] = 'Gender Required';
            }

            // check if warrent is uploaded
            if (isset($data['warrant_booking']) && empty($_FILES['warrant_image']['name']) && $data['warrant_booking'] == "on") {
                $this->errors['warrant_image'] = 'Warrent is required';
            }
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function validateStaffTicketing($data)
    {
        $errors = array();

        for ($entry = 0; $entry < count($data['reservation_passenger_title']); $entry++) {

            //check if title exists in post
            if (empty($data['reservation_passenger_title'][$entry])) {
                $this->errors['reservation_passenger_title'][$entry] = 'Title is required';
            }

            //check if first name is exists in post
            if (empty($data['reservation_passenger_first_name'][$entry])) {
                $this->errors['reservation_passenger_first_name'][$entry] = 'First Name is required';
            }

            //check if last name is exists in post
            if (empty($data['reservation_passenger_last_name'][$entry])) {
                $this->errors['reservation_passenger_last_name'][$entry] = 'Last Name is required';
            }

            // //check if phone number is exists in post
            // if (empty($data['reservation_passenger_phone_number'][$entry])) {
            //     $this->errors['reservation_passenger_phone_number'][$entry] = 'Phone Number is required';
            // }

            // // 10 number validation
            // if (strlen($data['reservation_passenger_phone_number'][$entry]) != 10) {
            //     $this->errors['reservation_passenger_phone_number'][$entry] = 'Phone Number is invalid';
            // }

            if (isset($data['reservation_is_dependent'][$entry]) && $data['reservation_is_dependent'][$entry] == '0') {
                if (empty($data['reservation_passenger_nic'][$entry])) {
                    $this->errors['reservation_passenger_nic'][$entry] = 'NIC is required';
                } else {
                    // 10 number validation o
                    if (strlen($data['reservation_passenger_nic'][$entry]) != 12) {
                        if (strlen($data['reservation_passenger_nic'][$entry]) == 10) {
                            $last_char = strtolower(substr($data['reservation_passenger_nic'][$entry], -1));
                            if ($last_char != 'v') {
                                $this->errors['reservation_passenger_nic'][$entry] = 'NIC is invalid last char is not V or v';
                            }
                        } else {
                            $this->errors['reservation_passenger_nic'][$entry] = 'NIC is invalid';
                        }
                    }
                }
            }
            //check nic is exists in post



            // //check if email is exists in post
            // if (empty($data['reservation_passenger_email'][$entry])) {
            //     $this->errors['reservation_passenger_email'][$entry] = 'Email is required';
            // }

            // //check if email is valid
            // if (!filter_var($_POST['reservation_passenger_email'][$entry], FILTER_VALIDATE_EMAIL)) {
            //     $this->errors['reservation_passenger_email'][$entry] = 'Invalid Email';
            // }

            // check gender
            if (empty($data['reservation_passenger_gender'][$entry])) {
                $this->errors['reservation_passenger_gender'][$entry] = 'Gender Required';
            }
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function getReservation()
    {
        try {
            $result = $this->findAll();
            //sort an array in assending order
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return [];
    }
    public function getReservations($id, $type = '')
    {

        try {
            $table = 'tbl_reservation';
            if (strtolower($type) == 'cancelled') {
                $table = 'tbl_reservation_cancelled';
            }

            $query = "SELECT
                            	r.*,
                                tstop_start_time.train_stop_time AS estimated_departure_time,
                                tstop_end_time.train_stop_time AS estimated_arrival_time,
                                s.station_name AS reservation_start_station,
                                e.station_name AS reservation_end_station,
                                ct.compartment_class_type AS reservation_compartment_type
                        FROM
                            {$table} r
                            JOIN tbl_train_stop_station tstop_start_time ON tstop_start_time.station_id = r.reservation_start_station
                            JOIN tbl_train_stop_station tstop_end_time ON tstop_end_time.station_id = r.reservation_end_station
                            JOIN tbl_station s ON s.station_id = r.reservation_start_station
                            JOIN tbl_station e ON e.station_id = r.reservation_end_station
                            JOIN tbl_compartment c ON c.compartment_id = r.reservation_compartment_id
                            JOIN tbl_compartment_class_type ct ON ct.compartment_class_type_id = c.compartment_class_type
                        WHERE
                            r.reservation_passenger_id = :reservation_passenger_id
                        GROUP BY
                            r.reservation_seat,
	                        r.reservation_ticket_id";

            $result = $this->query(
                $query,
                array(
                    'reservation_passenger_id' => $id
                )
            );
            //sort an array in assending order
            if ($result > 0) {
                return $result;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }



    public function getCancelReservations()
    {
        try {
            $query = "SELECT c.*, start_st.station_name
                    FROM tbl_reservation_cancelled c
                    JOIN tbl_station start_st ON c.reservation_start_station = start_st.station_id;";

            $result = $this->query($query);
            if ($result > 0) {
                return $result;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }


    public function getReservationDataTicket($id, $type = '')
    {
        if ($id == '') {
            return 'false';
        }
        $table = 'tbl_reservation';
        if (strtolower($type) == 'cancelled') {
            $table = 'tbl_reservation_cancelled';
        }
        try {
            $query = "SELECT
                            	r.*,
                                t.train_no,
                                tt.train_type,
                                t.train_name AS reservation_train_name,
                                tstop_start_time.train_stop_time AS estimated_departure_time,
                                tstop_end_time.train_stop_time AS estimated_arrival_time,
                                s.station_name AS reservation_start_station,
                                e.station_name AS reservation_end_station,
                                ct.compartment_class_type AS reservation_compartment_type
                        FROM
                            {$table} r
                            JOIN tbl_train_stop_station tstop_start_time ON tstop_start_time.station_id = r.reservation_start_station
                            JOIN tbl_train_stop_station tstop_end_time ON tstop_end_time.station_id = r.reservation_end_station
                            JOIN tbl_station s ON s.station_id = r.reservation_start_station
                            JOIN tbl_station e ON e.station_id = r.reservation_end_station
                            JOIN tbl_compartment c ON c.compartment_id = r.reservation_compartment_id
                            JOIN tbl_compartment_class_type ct ON ct.compartment_class_type_id = c.compartment_class_type
                            JOIN tbl_train t ON t.train_id = r.reservation_train_id
                            JOIN tbl_train_type tt ON t.train_type = tt.train_type_id 
                        WHERE
                            r.reservation_ticket_id = :reservation_ticket_id
                        GROUP BY
                            r.reservation_seat,
	                        r.reservation_ticket_id";

            $result = $this->query(
                $query,
                array(
                    'reservation_ticket_id' => $id
                )
            );
            //sort an array in assending order
            if ($result > 0) {
                return $result;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function getOneReservation($value)
    {
        try {
            // echo "<pre>";
            // print_r($value);
            // echo "</pre>";

            $query = "SELECT * FROM tbl_reservation WHERE reservation_train_id = :train_id AND reservation_compartment_id = :class_id AND reservation_start_station = :from_station AND reservation_end_station = :to_station AND reservation_date = :from_date";
            $result = $this->query(
                $query,
                array(
                    'train_id' => $value['train_id'],
                    'class_id' => $value['class_id'],
                    'from_station' => $value['from_station'],
                    'to_station' => $value['to_station'],
                    'from_date' => "2024-01-29"
                    // 'selected_seats' => $value['selected_seats']
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    // cancel reservation

    //refund
    public function getRefund($reservation_id, $total_fare_amount)
    {

        try {
            $data = $this->getReservationDataTicket($reservation_id);


            if (strtolower($data[0]->reservation_type) == 'warrant') {
                return 0;
            }

            $refundedAmount = 0;

            $reservation_depature_date = new DateTime($data[0]->reservation_date);
            $reservation_time = new DateTime($data[0]->estimated_departure_time);

            $time_hour = $reservation_time->format('H');
            $time_minute = $reservation_time->format('i');
            $time_second = $reservation_time->format('s');

            // Combine date and time
            $reservation_depature_date->setTime($time_hour, $time_minute, $time_second);

            $reservation_created_time = new DateTime($data[0]->reservation_created_time);

            // get the differencr in total hours
            $remainTime = $reservation_depature_date->diff($reservation_created_time);



            $remainTime = hms_date_diff($remainTime);

            if ($remainTime > 168) {
                $refundedAmount = $total_fare_amount * 0.75;
            } elseif ($remainTime > 48) {
                $refundedAmount = $total_fare_amount * 0.50;
            } else {
                $refundedAmount = 0;
            }

            return $refundedAmount;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // getRefundDetails oka haddnna 
    // eya reservation id eka, total_fare_amount

    // return 

    public function getReservationDetails($startDate = null, $endDate = null, $reservationType = 'all')
    {
        try {
            $query = "SELECT
                        reservation_date,
                        reservation_type,
                        COUNT(reservation_id) AS total_reservations,
                        SUM(reservation_amount) AS total_amount
                      FROM
                        tbl_reservation";

            $params = [];

            if ($startDate && $endDate) {
                $query .= " WHERE reservation_date BETWEEN :startDate AND :endDate";
                $params = [':startDate' => $startDate, ':endDate' => $endDate];
            }

            if ($reservationType !== 'all') {
                if ($startDate && $endDate) {
                    $query .= " AND reservation_type = :reservationType";
                } else {
                    $query .= " WHERE reservation_type = :reservationType";
                }
                $params[':reservationType'] = $reservationType;
            }

            $query .= " GROUP BY reservation_date, reservation_type ORDER BY reservation_date ASC";

            $result = $this->query($query, $params);

            if ($result > 0) {
                return $result;
            } else {
                return 0;
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function countReservationFromAndTo($startDate,  $endDate)
    {
        // this should rerturn the total number of reservations from start and end date if there a no reservations it should return 0
        try {
            $query = "SELECT
                        reservation_date,
                        COUNT(reservation_id) AS total_reservations
                      FROM
                        tbl_reservation
                      WHERE
                        reservation_date BETWEEN :startDate AND :endDate
                      GROUP BY reservation_date
                      ORDER BY reservation_date ASC";

            $result = $this->query($query, [':startDate' => $startDate, ':endDate' => $endDate]);

            if (is_array($result) && $result > 0) {
                return $result;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function reservationCountByReservationType($startDate,  $endDate)
    {
        try {
            $query = "SELECT
                        reservation_date,
                        reservation_type,
                        COUNT(reservation_id) AS total_reservations
                      FROM
                        tbl_reservation
                      WHERE
                        reservation_date BETWEEN :startDate AND :endDate
                      GROUP BY reservation_type
                      ORDER BY reservation_date ASC";

            $result = $this->query($query, [':startDate' => $startDate, ':endDate' => $endDate]);

            if (is_array($result) && $result > 0) {
                return $result;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getCancelReservationSummary($id)
    {
        try {
            $query = "SELECT
                    r.*,
                    t.train_no,
                    tt.train_type,
                    t.train_name AS reservation_train_name,
                    tstop_start_time.train_stop_time AS estimated_departure_time,
                    tstop_end_time.train_stop_time AS estimated_arrival_time,
                    s.station_name AS reservation_start_station,
                    e.station_name AS reservation_end_station,
                    ct.compartment_class_type AS reservation_compartment_type
            FROM
                tbl_reservation_cancelled r
                JOIN tbl_train_stop_station tstop_start_time ON tstop_start_time.station_id = r.reservation_start_station
                JOIN tbl_train_stop_station tstop_end_time ON tstop_end_time.station_id = r.reservation_end_station
                JOIN tbl_station s ON s.station_id = r.reservation_start_station
                JOIN tbl_station e ON e.station_id = r.reservation_end_station
                JOIN tbl_compartment c ON c.compartment_id = r.reservation_compartment_id
                JOIN tbl_compartment_class_type ct ON ct.compartment_class_type_id = c.compartment_class_type
                JOIN tbl_train t ON t.train_id = r.reservation_train_id
                JOIN tbl_train_type tt ON t.train_type = tt.train_type_id 
            WHERE
                r.reservation_ticket_id = :reservation_ticket_id
            GROUP BY
                r.reservation_seat,
                r.reservation_ticket_id;";

            $result = $this->query($query, [':reservation_ticket_id' => $id]);

            if (is_array($result) && $result > 0) {
                return $result;
            } else {
                return [];
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
