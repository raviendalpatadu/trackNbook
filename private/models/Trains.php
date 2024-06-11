<?php

use Sabberworm\CSS\Value\Value;

class Trains extends Model
{
    protected $table = 'tbl_train';
    protected $allowedColumns = ['train_no', 'train_name', 'train_type', 'train_start_time', 'train_end_time', 'train_start_station', 'train_end_station', 'train_route'];

    public function __construct()
    {
        parent::__construct();
    }

    public function trainsAvailableValidate($values = array())
    {
        if (empty($values['from_station']) || $values['from_station'] == 0) {
            $this->errors['errors']['from_station'] = 'Station is required';
        }

        if (empty($values['to_station']) || $values['to_station'] == 0) {
            $this->errors['errors']['to_station'] = 'Station is required';
        }

        if (empty($values['from_date'])) {
            $this->errors['errors']['from_date'] = 'Date is required';
        }

        if (empty($values['from_compartment_and_train']) || !isset($values['from_compartment_and_train'])) {
            $this->errors['errors']['from_compartment_and_train'] = 'From compartment should be selected';
        }

        if (empty($values['no_of_passengers'])) {
            $this->errors['errors']['no_of_passengers'] = 'Passenger count is required';
        }

        if (isset($values['return']) && $values['return'] == 'on') {
            if (!isset($values['to_date'])) {
                $this->errors['errors']['to_date'] = 'To date is required';
            }

            if (empty($values['to_date'])) {
                $this->errors['errors']['to_date'] = 'To date is required';
            }

            if (!isset($values['to_compartment_and_train'])) {
                $this->errors['errors']['to_compartment_and_train'] = 'To compartment should be selected';
            }
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }




    public function findAllTrains()
    {
        $data = array();

        try {

            //insert query to search train must come form route
            $query = "SELECT
                            tbl_train.*,
                            start.station_name AS start_station,
                            end.station_name AS end_station,
                            tbl_compartment_class_type.compartment_class_type,
                            tbl_train_type.train_type AS train_type_name
                        FROM
                            tbl_train
                        JOIN
                            tbl_station AS start ON tbl_train.train_start_station = start.station_id
                        JOIN
                            tbl_station AS end ON tbl_train.train_end_station = end.station_id
                        JOIN
                            tbl_compartment ON tbl_train.train_id = tbl_compartment.compartment_train_id
                        JOIN
                            tbl_compartment_class_type ON tbl_compartment.compartment_class_type = tbl_compartment_class_type.compartment_class_type_id
                        JOIN
                            tbl_train_type ON tbl_train.train_type = tbl_train_type.train_type_id
                        GROUP BY
                            tbl_train.train_id";

            $data = $this->query($query);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if ($data > 0) {
            return $data;
        }
        return [];
    }
    public function getAllTrainsWithEstimatedArrival($station_id)
    {
        $query = "SELECT
                        tbl_train.*,
                        start.station_name AS start_station,
                        end.station_name AS end_station,
                        tbl_compartment_class_type.compartment_class_type,
                        tbl_train_type.train_type,
                        tbl_train_stop_station.train_stop_time AS estimated_arrival_time
                    FROM
                        tbl_train
                    JOIN
                        tbl_station AS start ON tbl_train.train_start_station = start.station_id
                    JOIN
                        tbl_station AS end ON tbl_train.train_end_station = end.station_id
                    JOIN
                        tbl_compartment ON tbl_train.train_id = tbl_compartment.compartment_train_id
                    JOIN
                        tbl_compartment_class_type ON tbl_compartment.compartment_class_type = tbl_compartment_class_type.compartment_class_type_id
                    JOIN
                        tbl_train_type ON tbl_train.train_type = tbl_train_type.train_type_id
                    JOIN
                        tbl_train_stop_station ON tbl_train.train_id = tbl_train_stop_station.train_id AND tbl_train_stop_station.station_id = :station_id
                    WHERE
                        tbl_train.train_id IN (
                            SELECT
                                train_id
                            FROM
                                tbl_train_stop_station
                            WHERE
                                station_id = :station_id
                        )
                    GROUP BY
                        tbl_train.train_id";

        $result = $this->query($query, [
            'station_id' => $station_id
        ]);

        if (!empty($result)) {
            return $result;
        }

        return [];
    }
    function getAllTrainsByStation($station_id)
    {
        $query = "SELECT
                            tbl_train.*,
                            start.station_name AS start_station,
                            end.station_name AS end_station,
                            tbl_compartment_class_type.compartment_class_type,
                            tbl_train_type.train_type,
                            tbl_train_stop_station.train_stop_time AS estimated_arraival_time
                        FROM
                            tbl_train
                        JOIN
                            tbl_station AS start ON tbl_train.train_start_station = start.station_id
                        JOIN
                            tbl_station AS end ON tbl_train.train_end_station = end.station_id
                        JOIN
                            tbl_compartment ON tbl_train.train_id = tbl_compartment.compartment_train_id
                        JOIN
                            tbl_compartment_class_type ON tbl_compartment.compartment_class_type = tbl_compartment_class_type.compartment_class_type_id
                        JOIN
                            tbl_train_type ON tbl_train.train_type = tbl_train_type.train_type_id
                        JOIN
                            tbl_train_stop_station ON tbl_train.train_id = tbl_train_stop_station.train_id AND tbl_train_stop_station.station_id = :station_id

                        -- get all trains where it stops in the given station
                        WHERE
                            tbl_train.train_id IN (
                                SELECT
                                    train_id
                                FROM
                                    tbl_train_stop_station
                                WHERE
                                    station_id = :station_id
                            )
                            -- and where the train's current location's stop number is less than or eqaul to the station's stop number
                            AND tbl_train.train_id IN (
                                SELECT
                                    train_id
                                FROM
                                    tbl_train_stop_station
                                WHERE
                                    station_id = :station_id
                                    -- AND stop_no <= (
                                    --     SELECT
                                    --         stop_no
                                    --     FROM
                                    --         tbl_train_stop_station
                                    --     WHERE
                                    --         train_id = tbl_train.train_id
                                    --         AND station_id = :station_id
                                    -- )
                            )
                        GROUP BY
                            tbl_train.train_id";

        $result = $this->query($query, [
            'station_id' => $station_id
        ]);

        if (is_array($result) && count($result) > 0) {
            return $result;
        }

        return [];
    }


    public function findTrain($trainId)
    {

        try {


            // Insert query to search train based on trainId
            $query = "SELECT
                            tbl_train.*,
                            start.station_name AS start_station,
                            end.station_name AS end_station
                        FROM
                            tbl_train
                        JOIN
                            tbl_station AS start ON tbl_train.train_start_station = start.station_id
                        JOIN
                            tbl_station AS end ON tbl_train.train_end_station = end.station_id
                            
                        WHERE
                            tbl_train.train_id = :train_id;"; // Add WHERE condition to filter by trainId
            $result = $this->query(
                $query,
                array(
                    'train_id' => $trainId
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if ($result > 0) {
            return $result;
        }
    }

    public function validate($values = array())
    {


        if (empty($values['to_station']) || $values['to_station'] == 0) {
            $this->errors['errors']['to_station'] = 'Station is required';
        }

        //check if from_station is exists in post
        if (empty($values['from_station']) || $values['from_station'] == 0) {
            $this->errors['errors']['from_station'] = 'Staion is required';
        }

        //check if from staion = to_station
        if (!(array_key_exists('errors', $this->errors)) && $values['from_station'] == $values['to_station']) {
            $this->errors['errors']['from_station'] = 'From and To stations are same';
            $this->errors['errors']['to_station'] = 'From and To stations are same';
        }

        //check if from date is exists in post
        if (empty($values['from_date'])) {
            $this->errors['errors']['from_date'] = 'date is required';
        }

        if (isset($values['return'])) {
            //check if to date is exists in post
            if (empty($values['to_date'])) {
                $this->errors['errors']['to_date'] = 'Date is required';
            }
        }

        //check if from no of passengers is exists in post
        if (empty($values['no_of_passengers'])) {
            $this->errors['errors']['no_of_passengers'] = 'Passenger count is required';
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }
    public function search($values = array())
    {
        $errors = array();


        $data = array();
        //   //check if to_station is exists in post

        if (!array_key_exists('errors', $errors)) {

            try {
                //insert query to search train must come form route
                $query = "WITH
                            StartingTrains AS (
                                SELECT
                                    *
                                FROM
                                    tbl_train_stop_station
                                WHERE
                                    station_id = :from_station
                            ),
                            res AS (
                            SELECT
                            r.reservation_id,
                            r.reservation_ticket_id,
                            r.reservation_train_id,
                            r.reservation_compartment_id,
                            r.reservation_date,
                            s.station_name AS reservation_start_station,
                            reservation_start_st.stop_no AS reservation_start_stop_no,
                            e.station_name AS reservation_end_station,
                            reservation_end_st.stop_no AS reservation_end_stop_no
                            FROM
                            tbl_reservation r
                            JOIN tbl_train_stop_station reservation_start_st ON r.reservation_start_station = reservation_start_st.station_id AND r.reservation_train_id = reservation_start_st.train_id
                            JOIN tbl_train_stop_station reservation_end_st ON r.reservation_end_station = reservation_end_st.station_id AND r.reservation_train_id = reservation_end_st.train_id
                            JOIN tbl_station s ON reservation_start_st.station_id = s.station_id
                            JOIN tbl_station e ON reservation_end_st.station_id = e.station_id
                            GROUP BY
                            r.reservation_id
                        ),
                        CountReservations AS (
                            SELECT
                            ac.*,
                            COUNT(r.reservation_compartment_id) AS no_of_reservations
                            FROM
                            tbl_compartment ac
                            LEFT JOIN res r ON ac.compartment_id = r.reservation_compartment_id
                            AND r.reservation_date = :from_date
                            AND (
                                (
                                (
                                    (
                                        SELECT
                                            stop_no
                                        FROM
                                            tbl_train_stop_station
                                        WHERE
                                            train_id = r.reservation_train_id
                                            AND station_id = :from_station
                                    )  <= r.reservation_start_stop_no
                                    AND r.reservation_start_stop_no < 
                                    (
                                        SELECT
                                            stop_no
                                        FROM
                                            tbl_train_stop_station
                                        WHERE
                                            train_id = r.reservation_train_id
                                            AND station_id = :to_station
                                    ) 
                                )
                                OR (
                                    (
                                        SELECT
                                            stop_no
                                        FROM
                                            tbl_train_stop_station
                                        WHERE
                                            train_id = r.reservation_train_id
                                            AND station_id = :from_station
                                    )  < r.reservation_end_stop_no
                                    AND r.reservation_end_stop_no <= 
                                    (
                                        SELECT
                                            stop_no
                                        FROM
                                            tbl_train_stop_station
                                        WHERE
                                            train_id = r.reservation_train_id
                                            AND station_id = :to_station
                                    ) 
                                )
                                )
                                OR (
                                (
                                        SELECT
                                            stop_no
                                        FROM
                                            tbl_train_stop_station
                                        WHERE
                                            train_id = r.reservation_train_id
                                            AND station_id = :from_station
                                    )  >= r.reservation_start_stop_no
                                AND r.reservation_end_stop_no >= 
                                (
                                        SELECT
                                            stop_no
                                        FROM
                                            tbl_train_stop_station
                                        WHERE
                                            train_id = r.reservation_train_id
                                            AND station_id = :to_station
                                    ) 
                                )
                            )
                            GROUP BY
                            ac.compartment_id,
                            ac.compartment_class_type
                        )
                        SELECT
                            DISTINCT train.train_id,
                            train.train_no,
                            train.train_name,
                            train_type.train_type,
                            train.train_start_time,
                            train.train_end_time,
                            START.station_name AS train_start_station,
                            END.station_name AS train_end_station,
                            TS1.train_stop_time AS estimated_start_time,
                            TS2.train_stop_time AS estimated_end_time,
                            reservation.*,
                            compartment_type.compartment_class_type,
                            fare.fare_price
                        FROM
                            StartingTrains ST
                            JOIN tbl_train_stop_station TS1 ON ST.train_id = TS1.train_id
                            JOIN tbl_train_stop_station TS2 ON TS1.train_id = TS2.train_id
                            JOIN tbl_train train ON ST.train_id = train.train_id
                            JOIN tbl_train_type train_type ON train_type.train_type_id = train.train_type
                            JOIN tbl_station AS START ON train.train_start_station = START.station_id
                            JOIN tbl_station AS END ON train.train_end_station = END.station_id
                            JOIN tbl_compartment AS compartment ON compartment.compartment_train_id = train.train_id
                            JOIN tbl_compartment_class_type AS compartment_type ON compartment_type.compartment_class_type_id = compartment.compartment_class_type
                            JOIN CountReservations AS reservation ON reservation.compartment_id = compartment.compartment_id
                            JOIN tbl_fare AS fare ON fare.fare_train_type_id = train.train_type 

                        WHERE
                            TS1.station_id = :from_station
                            AND TS2.station_id = :to_station
                            
                            AND TS1.stop_no < TS2.stop_no
                            -- AND reservation.compartment_total_seats > reservation.no_of_reservations 
                            -- AND (compartment.compartment_total_seats - reservation.no_of_reservations) >= :no_of_passengers
                            
                            -- AND reservation.compartment_total_seats > reservation.no_of_reservations
                            
                            AND fare.fare_compartment_id = compartment.compartment_class_type
                            AND fare.fare_route_id = train.train_route
                            AND fare.fare_start_station = :from_station
                            AND fare.fare_end_station = :to_station
                            
                            -- check if the train is not disabled
                            AND train.train_id NOT IN (
                                SELECT tbl_train_disable_period.disable_period_train_id
                                FROM tbl_train_disable_period
                                    JOIN tbl_disable_period ON tbl_train_disable_period.disable_period_id = tbl_disable_period.disable_period_id
                                WHERE disable_period_start_date <= :from_date
                                    AND disable_period_end_date >= :from_date
                            )
                            
                            ORDER BY train.train_start_time, compartment_type.compartment_class_type_id ASC";


                $data = $this->query(
                    $query,
                    array(
                        'from_station' => $values['from_station']->station_id,
                        'to_station' => $values['to_station']->station_id,
                        'from_date' => $values['from_date'],
                        'no_of_passengers' => $values['no_of_passengers']
                    )
                );
            } catch (PDOException $e) {
                die($e->getMessage());
            }

            if ($data > 0) {
                return $data;
            }
        }
        return $errors;
    }

    public function addTrainValidate()
    {
        // Check if required fields are empty
        if (empty($_POST['train_no'])) {
            $this->errors['train_no'] = 'Train Id is required';
        }

        // Check if train no is already exists
        $train = $this->whereOne('train_no', $_POST['train_no']);
        if ($train) {
            $this->errors['train_no'] = 'Train Id already exists';
        }

        if (empty($_POST['train_name'])) {
            $this->errors['train_name'] = 'Train Name is required';
        }

        if (empty($_POST['train_route'])) {
            $this->errors['train_route'] = 'Train route is required';
        }

        if (empty($_POST['train_start_station'])) {
            $this->errors['train_start_station'] = 'Start Station is required';
        }

        if (empty($_POST['train_end_station'])) {
            $this->errors['train_end_station'] = 'End Station is required';
        }

        if (empty($_POST['train_start_time'])) {
            $this->errors['train_start_time'] = 'Start Time is required';
        }

        if (empty($_POST['train_end_time'])) {
            $this->errors['train_end_time'] = 'End Time is required';
        }

        if (empty($_POST['train_type'])) {
            $this->errors['train_type'] = 'Train Type is required';
        }

        if (empty($_POST['no_of_compartments']) || $_POST['no_of_compartments'] == 0) {
            $this->errors['no_of_compartments'] = 'No of compartments is required';
        }

        if (!isset($_POST['compartment']['class']) || empty($_POST['compartment']['class'])) {
            $this->errors['errors']['compartment_class'] = 'Compartment class is required';
        }

        if (isset($_POST['compartment']['class']) && count($_POST['compartment']['class']) == $_POST['no_of_compartments']) {
            foreach ($_POST['compartment']['class'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_class'] = 'Compartment class is required';
                }
            }

            foreach ($_POST['compartment']['type'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_type'] = 'Compartment type is required';
                }
            }

            foreach ($_POST['compartment']['seat_layout'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_seat_layout'] = 'Compartment seat layout is required';
                }
            }
        }

        if (isset($_POST['compartment']['class']) && count($_POST['compartment']['class']) == $_POST['no_of_compartments']) {

            // echo "<pre>";
            // print_r($_POST['compartment']);
            // echo "</pre>";
            foreach ($_POST['compartment']['class'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment'] = 'Compartment class is required';
                }
            }

            foreach ($_POST['compartment']['type'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment'] = 'Compartment type is required';
                }
            }

            foreach ($_POST['compartment']['seat_layout'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment'] = 'Compartment seat layout is required';
                }
            }


            foreach ($_POST['compartment']['total_seats'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment'] = 'Compartment total seats is required';
                }
            }

            foreach ($_POST['compartment']['total_number'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment'] = 'Compartment total number is required';
                }
            }
        }

        if (isset($_POST['stopping_station']['id'])) {

            foreach ($_POST['stopping_station']['id'] as $key => $value) {
                if (empty($value)) {
                    // $this->errors['errors']['stopping_station'] = 'Stopping station is required';
                    unset($_POST['stopping_station']['id'][$key]);
                }
            }
            $_POST['stopping_station']['time_verified'] = $_POST['stopping_station']['time'];
            foreach ($_POST['stopping_station']['time'] as $key => $value) {
                if (empty($value)) {
                    // unset and reindex the array
                    unset($_POST['stopping_station']['time'][$key]);
                    $_POST['stopping_station']['time_verified'] = array_values($_POST['stopping_station']['time']);
                }
            }

            if ($_POST['stopping_station']['time_verified'][0] != $_POST['train_start_time']) {
                $this->errors['errors']['train_start_time'] = 'First stopping station time should be same as start time';
            }

            // fromat time into 24 hours format and with seconds
            $_POST['train_start_time'] = date("H:i", strtotime($_POST['train_start_time']));
            $_POST['train_end_time'] = date("H:i", strtotime($_POST['train_end_time']));

            if ($_POST['stopping_station']['time_verified'][count($_POST['stopping_station']['time_verified']) - 1] != $_POST['train_end_time']) {
                $this->errors['errors']['train_end_time'] = 'Last stopping station time should be same as end time';
            }

            if (count($_POST['stopping_station']['id']) != count($_POST['stopping_station']['time_verified'])) {
                $this->errors['errors']['stopping_station'] = 'Stopping station and time is required';
            }

            if ($_POST['train_start_station'] != $_POST['stopping_station']['id'][0]) {
                $this->errors['errors']['train_start_station'] = 'First stopping station should be same as start station';
            }

            if ($_POST['train_end_station'] != $_POST['stopping_station']['id'][count($_POST['stopping_station']['id']) - 1]) {
                $this->errors['errors']['train_end_station'] = 'Last stopping station should be same as end station';
            }
        }

        if (!isset($_POST['stopping_station']['id']) || empty($_POST['stopping_station']['id'])) {
            $this->errors['errors']['stopping_station'] = 'Stopping station is required';
        }

        if (empty($this->errors)) {
            return true; // Successful insertion
        }
        return false;
    }

    public function addTrain()
    {
        try {

            // die("add train");

            $train_id =  $this->insert(
                [
                    'train_no' => $_POST['train_no'],
                    'train_name' => $_POST['train_name'],
                    'train_type' => $_POST['train_type'],
                    'train_start_time' => $_POST['train_start_time'],
                    'train_end_time' => $_POST['train_end_time'],
                    'train_start_station' => $_POST['train_start_station'],
                    'train_end_station' => $_POST['train_end_station'],
                    'train_route' => $_POST['train_route']
                ]
            );



            // insert into tbl_train_stop_station
            $train_stop_stations = new TrainStopStations();
            foreach ($_POST['stopping_station']['id'] as $key => $value) {

                // if station is not empty then insert
                $train_stop_stations->insert(
                    [
                        'train_id' => $train_id,
                        'station_id' => $value,
                        'stop_no' => $key + 1,
                        'train_stop_time' => $_POST['stopping_station']['time_verified'][$key]
                    ]
                );
                
                
            }
            // die("train id is " . $train_id);

            // compartment tbl
            $compartment = new Compartments();
            foreach ($_POST['compartment']['class'] as $key => $value) {

                $compartment->insert(
                    [
                        'compartment_train_id' => $train_id,
                        'compartment_class_type' => $_POST['compartment']['type'][$key],
                        'compartment_class' => $value,
                        'compartment_seat_layout' => $_POST['compartment']['seat_layout'][$key],
                        'compartment_total_seats' => $_POST['compartment']['total_seats'][$key],
                        'compartment_total_number' => $_POST['compartment']['total_number'][$key]
                    ]
                );
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    //get reservation for a specific train
    public function getTrainReservation($class_id = "", $train_id = "")
    {

        $date = $_SESSION['reservation']['from_date'];

        try {
            $query = "SELECT t.*, r.*, c.*, ct.*,\n"
                . "start.station_name AS start_station,\n"

                . "end.station_name AS end_station\n"

                . " FROM tbl_train t\n"

                . " JOIN tbl_reservation r ON t.train_id = r.reservation_train_id\n"

                . " JOIN tbl_station start ON t.train_start_station = start.station_id\n"

                . " JOIN tbl_station end ON t.train_end_station = end.station_id\n"

                . " JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id\n"

                . " JOIN tbl_compartment_class_type ct ON ct.compartment_class_type_id = c.compartment_class_type\n"

                . " WHERE r.reservation_train_id = :train_id AND r.reservation_compartment_id = :class AND r.reservation_date = :date";

            $data = $this->query(
                $query,
                array(
                    'train_id' => $train_id,
                    'class' => $class_id,
                    'date' => $date
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        if ($data > 0) {
            return $data;
        }
    }

    public function getTrain($id)
    {
        try {


            //insert query to search train must come form route
            $query = "SELECT\n"

                . "tbl_train.*,\n"

                . "start.station_name AS start_station,\n"

                . "end.station_name AS end_station\n"

                . "\n"

                . "FROM\n"

                . "	tbl_train\n"

                . "JOIN\n"

                . "	tbl_station AS start ON tbl_train.train_start_station = start.station_id\n"

                . " JOIN\n"

                . " 	tbl_station AS end ON tbl_train.train_end_station = end.station_id\n"

                . "WHERE\n"

                . "	tbl_train.train_id = :train_id LIMIT 1";

            $data = $this->query(
                $query,
                array(
                    'train_id' => $id
                )
            );
        } catch (PDOException $e) {
            echo $e->getMessage();
        }


        return $data;
    }

    public function validateUpdateTrain($data)
    {
        // Check if required fields are empty
        if (empty($data['train_name'])) {
            $this->errors['errors']['train_name'] = 'Train Name is required';
        }

        if (empty($data['train_route'])) {
            $this->errors['errors']['train_route'] = 'Train route is required';
        }

        if (empty($data['train_start_station'])) {
            $this->errors['errors']['train_start_station'] = 'Start Station is required';
        }

        if (empty($data['train_end_station'])) {
            $this->errors['errors']['train_end_station'] = 'End Station is required';
        }

        if (empty($data['train_start_time'])) {
            $this->errors['errors']['train_start_time'] = 'Start Time is required';
        }

        if (empty($data['train_end_time'])) {
            $this->errors['errors']['train_end_time'] = 'End Time is required';
        }

        if (empty($data['train_type'])) {
            $this->errors['errors']['train_type'] = 'Train Type is required';
        }

        if (empty($data['no_of_compartments']) || $data['no_of_compartments'] == 0) {
            $this->errors['errors']['no_of_compartments'] = 'No of compartments is required';
        }

        if (!isset($data['compartment']['class']) || empty($data['compartment']['class'])) {
            $this->errors['errors']['compartment_class'] = 'Compartment class is required';
        }

        if (isset($data['compartment']['class']) && count($data['compartment']['class']) == $data['no_of_compartments']) {
            foreach ($data['compartment']['class'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_class'] = 'Compartment class is required';
                }
            }

            foreach ($data['compartment']['type'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_type'] = 'Compartment type is required';
                }
            }

            foreach ($data['compartment']['seat_layout'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_seat_layout'] = 'Compartment seat layout is required';
                }
            }
        }

        if (isset($data['compartment']['class']) && count($data['compartment']['class']) == $data['no_of_compartments']) {

            foreach ($data['compartment']['class'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_class'][$key] = 'Compartment class is required';
                }
            }

            foreach ($data['compartment']['type'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_type'][$key] = 'Compartment type is required';
                }
            }

            foreach ($data['compartment']['seat_layout'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_seat_layout'][$key] = 'Compartment seat layout is required';
                }
            }


            foreach ($data['compartment']['total_seats'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_total_seats'][$key] = 'Compartment total seats is required';
                }
            }

            foreach ($data['compartment']['total_number'] as $key => $value) {
                if (empty($value)) {
                    $this->errors['errors']['compartment_total_number'][$key] = 'Compartment total number is required';
                }
            }
        }

        if (isset($data['stopping_station']['id'])) {

            foreach ($data['stopping_station']['id'] as $key => $value) {
                if (empty($value)) {
                    // $this->errors['errors']['stopping_station'] = 'Stopping station is required';
                    unset($data['stopping_station']['id'][$key]);
                }
            }
            $data['stopping_station']['time_verified'] = $data['stopping_station']['time'];
            foreach ($data['stopping_station']['time'] as $key => $value) {
                if (empty($value)) {
                    // unset and reindex the array
                    unset($data['stopping_station']['time'][$key]);
                    $data['stopping_station']['time_verified'] = array_values($data['stopping_station']['time']);
                }
            }

            // fromat time into 24 hours format and with seconds
            $data['train_start_time'] = date("H:i:s", strtotime($data['train_start_time']));
            $data['train_end_time'] = date("H:i:s", strtotime($data['train_end_time']));

            if (get_time($data['stopping_station']['time_verified'][0], 'H:i:s') != get_time($data['train_start_time'], 'H:i:s')) {
                $this->errors['errors']['train_start_time'] = 'First stopping station time should be same as start time';
            }


            if (get_time($data['stopping_station']['time_verified'][count($data['stopping_station']['time_verified']) - 1], 'H:i:s') != get_time($data['train_end_time'], 'H:i:s')) {
                $this->errors['errors']['train_end_time'] = 'Last stopping station time should be same as end time';
            }

            if (count($data['stopping_station']['id']) != count($data['stopping_station']['time_verified'])) {
                $this->errors['errors']['stopping_station'] = 'Stopping station and time is required';
            }

            if ($data['train_start_station'] != $data['stopping_station']['id'][0]) {
                $this->errors['errors']['train_start_station'] = 'First stopping station should be same as start station';
            }

            if ($data['train_end_station'] != $data['stopping_station']['id'][count($data['stopping_station']['id']) - 1]) {
                $this->errors['errors']['train_end_station'] = 'Last stopping station should be same as end station';
            }
        }

        if (!isset($data['stopping_station']['id']) || empty($data['stopping_station']['id'])) {
            $this->errors['errors']['stopping_station'] = 'Stopping station is required';
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    function updateTrain($id, $data)
    {

        try {
            if (isset($data['stopping_station']['id'])) {

                foreach ($data['stopping_station']['id'] as $key => $value) {
                    if (empty($value)) {
                        // $this->errors['errors']['stopping_station'] = 'Stopping station is required';
                        unset($data['stopping_station']['id'][$key]);
                    }
                }
                $data['stopping_station']['time_verified'] = $data['stopping_station']['time'];
                foreach ($data['stopping_station']['time'] as $key => $value) {
                    if (empty($value)) {
                        // unset and reindex the array
                        unset($data['stopping_station']['time'][$key]);
                        $data['stopping_station']['time_verified'] = array_values($data['stopping_station']['time']);
                    }
                }
    
                // fromat time into 24 hours format and with seconds
                $data['train_start_time'] = date("H:i:s", strtotime($data['train_start_time']));
                $data['train_end_time'] = date("H:i:s", strtotime($data['train_end_time']));
            }

            // tbl_tain
            $this->update($id, [
                'train_name' => $data['train_name'],
                'train_type' => $data['train_type'],
                'train_start_time' => get_time($data['train_start_time'], 'H:i:s'),
                'train_end_time' => get_time($data['train_end_time'], 'H:i:s'),
                'train_start_station' => $data['train_start_station'],
                'train_end_station' => $data['train_end_station'],
                'train_route' => $data['train_route']
            ], 'train_id');

            // tbl_compartment
            $compartment = new Compartments();
            $compartment->delete($id, 'compartment_train_id');

            foreach ($data['compartment']['class'] as $key => $value) {
                $compartment->insert(array(
                    'compartment_train_id' => $id,
                    'compartment_class_type' => $data['compartment']['type'][$key],
                    'compartment_class' => $value,
                    'compartment_seat_layout' => $data['compartment']['seat_layout'][$key],
                    'compartment_total_seats' => $data['compartment']['total_seats'][$key],
                    'compartment_total_number' => $data['compartment']['total_number'][$key]
                ));
            }

            // tbl_train_stop_station

            $train_stop_stations = new TrainStopStations();
            $train_stop_stations->delete($id, 'train_id');

            foreach ($data['stopping_station']['id'] as $key => $value) {
                // echo $key . " =>" . $value . " " . $data['stopping_station']['time'][$key] . "<br>";
                $train_stop_stations->insert(array(
                    'train_id' => $id,
                    'station_id' => $value,
                    'stop_no' => $key + 1,
                    'train_stop_time' => get_time($data['stopping_station']['time_verified'][$key], 'H:i:s')
                ));
            }

            return true; // Successful insertion
            // die('update');
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    //Update Train Status
    public function updateStatus($id, $data)
    {
        $con = $this->connect();
        $errors = array();

        try {
            $query = "UPDATE tbl_train SET  WHERE train_id = :train_id";

            $stm = $con->prepare($query);
            $stm->execute(
                array(
                    'train_name' => $data['train_name'],
                    'train_type' => $data['train_type'],
                    'train_start_time' => $data['start_time'],
                    'train_end_time' => $data['end_time'],
                    'train_start_station' => $data['start_station'],
                    'train_end_station' => $data['end_station'],
                    'train_route' => $data['train_route'],
                    'train_id' => $id
                )
            );

            return true; // Successful insertion
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getTrainScheduleForStationMaster($station_id, $date){
        $data = array();
        
        $query = "WITH StartingTrains AS (
            SELECT *
            FROM tbl_train_stop_station
            WHERE station_id = :station_id
        ),
        res AS (
            SELECT r.reservation_id,
                r.reservation_ticket_id,
                r.reservation_train_id,
                r.reservation_compartment_id,
                r.reservation_date,
                s.station_name AS reservation_start_station,
                reservation_start_st.stop_no AS reservation_start_stop_no,
                e.station_name AS reservation_end_station,
                reservation_end_st.stop_no AS reservation_end_stop_no
            FROM tbl_reservation r
                JOIN tbl_train_stop_station reservation_start_st ON r.reservation_start_station = reservation_start_st.station_id
                AND r.reservation_train_id = reservation_start_st.train_id
                JOIN tbl_train_stop_station reservation_end_st ON r.reservation_end_station = reservation_end_st.station_id
                AND r.reservation_train_id = reservation_end_st.train_id
                JOIN tbl_station s ON reservation_start_st.station_id = s.station_id
                JOIN tbl_station e ON reservation_end_st.station_id = e.station_id
            GROUP BY r.reservation_id
        ),
        CountReservations AS (
            SELECT ac.*,
                COUNT(r.reservation_compartment_id) AS no_of_reservations
            FROM tbl_compartment ac
                LEFT JOIN res r ON ac.compartment_id = r.reservation_compartment_id
                AND r.reservation_date = :date_today
                
            GROUP BY ac.compartment_id,
                ac.compartment_class_type
        )
        SELECT DISTINCT train.train_id,
            train.train_name,
            train_type.train_type,
            train.train_start_time,
            train.train_end_time,
            START.station_name AS train_start_station,
        END.station_name AS train_end_station,
        TS1.train_stop_time AS estimated_start_time,
        TS2.train_stop_time AS estimated_end_time,
        reservation.*,
        compartment_type.compartment_class_type,
        fare.fare_price
        FROM StartingTrains ST
            JOIN tbl_train_stop_station TS1 ON ST.train_id = TS1.train_id
            JOIN tbl_train_stop_station TS2 ON TS1.train_id = TS2.train_id
            JOIN tbl_train train ON ST.train_id = train.train_id
            JOIN tbl_train_type train_type ON train_type.train_type_id = train.train_type
            JOIN tbl_station AS START ON train.train_start_station = START.station_id
            JOIN tbl_station AS
        END ON train.train_end_station =
        END.station_id
        JOIN tbl_compartment AS compartment ON compartment.compartment_train_id = train.train_id
        JOIN tbl_compartment_class_type AS compartment_type ON compartment_type.compartment_class_type_id = compartment.compartment_class_type
        JOIN CountReservations AS reservation ON reservation.compartment_id = compartment.compartment_id
        JOIN tbl_fare AS fare ON fare.fare_train_type_id = train.train_type
        WHERE TS1.station_id = :station_id
          
            AND TS1.stop_no < TS2.stop_no 
            AND fare.fare_compartment_id = compartment.compartment_class_type
            AND fare.fare_route_id = train.train_route
            AND fare.fare_start_station = :station_id
            AND train.train_id NOT IN (
                SELECT tbl_train_disable_period.disable_period_train_id
                FROM tbl_train_disable_period
                    JOIN tbl_disable_period ON tbl_train_disable_period.disable_period_id = tbl_disable_period.disable_period_id
                WHERE disable_period_start_date <= :date_today
                    AND disable_period_end_date >= :date_today
            )
        GROUP BY compartment.compartment_id
        ORDER BY train.train_start_time,
            compartment_type.compartment_class_type_id ASC";

        $data = $this->query(
            $query,
            array(
                'station_id' => $station_id,
                'date_today' => $date
            )
        );

        if(is_array($data) && count($data) > 0){
            return $data;
        }
        return $data;
    }
}
