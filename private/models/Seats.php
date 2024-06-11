<?php

class Seats extends Model
{
    protected $table = 'tbl_reservation';

    public function __construct()
    {
        parent::__construct();
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function validate($values = array())
    {
        if(count($values['reservation_seat']) != $values['no_of_passengers'] ){
            // $this->errors['errors']['reservation_seat'] = "Select " . ($values['no_of_passengers'] -  count($values['reservation_seat'])) . " more seat(s) to proceed";
            $this->errors['errors']['reservation_seat'] = "Select seat(s) to proceed";
            
        }

        if ($this->isSeatReserved($values)) {
            $this->errors['errors']['reservation_seat'] = 'Seat is already reserved.';
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    private function isSeatReserved($values = array())
    {
             
        foreach ($values['reservation_seat'] as $seat) {
            $query = 'SELECT * FROM tbl_reservation 
                        WHERE reservation_train_id = :train_id   
                        AND reservation_compartment_id  = :class_id
                        AND reservation_date = :reservation_date
                        AND reservation_seat =  :seat_id
                        AND reservation_start_station = :from_station
                        AND reservation_end_station = :to_station';

            $data = $this->query($query, array(
                ':train_id' => $values['reservation_train_id'],
                ':class_id' => $values['reservation_compartment_id'],
                ':reservation_date' => $values['reservation_date'],
                ':seat_id' => $seat,
                ':from_station' => $values['reservation_start_station'],
                ':to_station' => $values['reservation_end_station']
            ));



            if (!empty($data)) {
                return true;
            }
        }

        return false;
    }

    public function getReservedSeats($values = array())
    {
        $query = 'WITH
                    res AS (
                        SELECT
                            r.reservation_id,
                            r.reservation_ticket_id,
                            r.reservation_train_id,
                            r.reservation_compartment_id,
                            r.reservation_date,
                            r.reservation_seat,
                            r.reservation_is_travelled,
                            s.station_name AS reservation_start_station,
                            reservation_start_st.stop_no AS reservation_start_stop_no,
                            e.station_name AS reservation_end_station,
                            reservation_end_st.stop_no AS reservation_end_stop_no
                        FROM
                            tbl_reservation r
                            JOIN tbl_train_stop_station reservation_start_st ON r.reservation_start_station = reservation_start_st.station_id
                            JOIN tbl_train_stop_station reservation_end_st ON r.reservation_end_station = reservation_end_st.station_id
                            JOIN tbl_station s ON reservation_start_st.station_id = s.station_id
                            JOIN tbl_station e ON reservation_end_st.station_id = e.station_id
                        WHERE
                            r.reservation_compartment_id = :class_id
                            AND r.reservation_train_id = :train_id
                            AND reservation_start_st.train_id = :train_id
                            AND reservation_end_st.train_id = :train_id
                            AND r.reservation_date = :reservation_date
                        GROUP BY
                            r.reservation_id, r.reservation_start_station, r.reservation_end_station
                    )
                SELECT
                    *
                FROM
                    res r
                WHERE
                    (
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
                                ) <= r.reservation_start_stop_no
                                AND r.reservation_start_stop_no < (
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
                                ) < r.reservation_end_stop_no
                                AND r.reservation_end_stop_no <= (
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
                            ) >= r.reservation_start_stop_no
                            AND r.reservation_end_stop_no >= (
                                SELECT
                                    stop_no
                                FROM
                                    tbl_train_stop_station
                                WHERE
                                    train_id = r.reservation_train_id
                                    AND station_id = :to_station
                            )
                        )
                    )';

        $data = $this->query($query, array(
            ':train_id' => $values['reservation_train_id'],
            ':class_id' => $values['reservation_compartment_id'],
            ':reservation_date' => $values['reservation_date'],
            ':from_station' => $values['reservation_start_station'],
            ':to_station' => $values['reservation_end_station']
        ));



        if (!empty($data)) {
            return $data;
        }

        return false;
    }

    public function getReservedSeatsTicketChecker($values = array())
    {
        $query = 'WITH
                    res AS (
                        SELECT
                            r.reservation_id,
                            r.reservation_ticket_id,
                            r.reservation_train_id,
                            r.reservation_compartment_id,
                            r.reservation_date,
                            r.reservation_seat,
                            r.reservation_is_travelled,
                            s.station_name AS reservation_start_station,
                            reservation_start_st.stop_no AS reservation_start_stop_no,
                            e.station_name AS reservation_end_station,
                            reservation_end_st.stop_no AS reservation_end_stop_no
                        FROM
                            tbl_reservation r
                            JOIN tbl_train_stop_station reservation_start_st ON r.reservation_start_station = reservation_start_st.station_id
                            JOIN tbl_train_stop_station reservation_end_st ON r.reservation_end_station = reservation_end_st.station_id
                            JOIN tbl_station s ON reservation_start_st.station_id = s.station_id
                            JOIN tbl_station e ON reservation_end_st.station_id = e.station_id
                        WHERE
                            r.reservation_compartment_id = :class_id
                            AND r.reservation_train_id = :train_id
                            AND reservation_start_st.train_id = :train_id
                            AND reservation_end_st.train_id = :train_id
                            AND r.reservation_date = :reservation_date
                            AND r.reservation_status = :reservation_status
                        GROUP BY
                            r.reservation_id, r.reservation_start_station, r.reservation_end_station
                    )
                SELECT
                    *
                FROM
                    res r
                WHERE
                    (
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
                                ) <= r.reservation_start_stop_no
                                AND r.reservation_start_stop_no < (
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
                                ) < r.reservation_end_stop_no
                                AND r.reservation_end_stop_no <= (
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
                            ) >= r.reservation_start_stop_no
                            AND r.reservation_end_stop_no >= (
                                SELECT
                                    stop_no
                                FROM
                                    tbl_train_stop_station
                                WHERE
                                    train_id = r.reservation_train_id
                                    AND station_id = :to_station
                            )
                        )
                    )';

        $data = $this->query($query, array(
            ':train_id' => $values['reservation_train_id'],
            ':class_id' => $values['reservation_compartment_id'],
            ':reservation_date' => $values['reservation_date'],
            ':from_station' => $values['reservation_start_station'],
            ':to_station' => $values['reservation_end_station'],
            ':reservation_status' => 'Reserved'
        ));



        if (!empty($data)) {
            return $data;
        }

        return false;
    }
}
