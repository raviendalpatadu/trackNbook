<?php

class Inquiries extends Model
{
    protected $table = 'tbl_inquiry';
    protected $allowedColumns = ['inquiry_passenger_id', 'inquiry_ticket_id', 'inquiry_station', 'inquiry_reason', 'inquiry_status', 'inquiry_created_time', 'inquiry_to_station_master'];

    public function __construct()
    {
        parent::__construct();
    }

    public function validateInquiry($data)
    {


        if (empty($data['inquiry_ticket_id'])) {
            $this->errors['inquiry_ticket_id'] = 'Ticket ID is required';
        }

        if (empty($data['inquiry_station'])) {
            $this->errors['inquiry_station'] = 'Station is required';
        }

        if (empty($data['inquiry_reason'])) {
            $this->errors['inquiry_reason'] = 'Inquiry reason is required';
        }

        if (count($this->errors) > 0) {
            return false;
        }

        return true;
    }

    public function getInquiry()
    {

        $data = [];
        try {
            // search table tbl_reservation
            $query = "SELECT i.*,
                            r.*,
                            u.*,
                            t.train_start_station,
                            t.train_end_station,
                            t.train_name,
                            t.train_start_time,
                            t.train_end_time,
                            t.train_type,
                            ctt.compartment_class_type,
                            tt.train_type,
                            start_st.station_name AS start_station_name,
                            end_st.station_name AS end_station_name
                        FROM tbl_inquiry i
                            INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                            INNER JOIN tbl_reservation r ON i.inquiry_ticket_id = r.reservation_ticket_id
                            INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                            JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                            JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                            JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                            JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                            JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    
                        GROUP BY i.inquiry_id;";


            $result_reservation = $this->query($query);

            if (is_array($result_reservation) && count($result_reservation) > 0) {
                $data = array_merge($data, $result_reservation);
            }

            // if not found in tbl_reservation
            // check in tbl_reservation canceled
            $query = "SELECT i.*,
                        r.*,
                        u.*,
                        t.train_start_station,
                        t.train_end_station,
                        t.train_name,
                        t.train_start_time,
                        t.train_end_time,
                        t.train_type,
                        ctt.compartment_class_type,
                        tt.train_type,
                        start_st.station_name AS start_station_name,
                        end_st.station_name AS end_station_name
                    FROM tbl_inquiry i
                        INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                        INNER JOIN tbl_reservation_cancelled r ON i.inquiry_ticket_id = r.reservation_ticket_id
                        INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                        JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                        JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                        JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                        JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                        JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    GROUP BY i.inquiry_id;";

            $result_cancel = $this->query($query);

            if (is_array($result_cancel) && count($result_cancel) > 0) {
                $data = array_merge($data, $result_cancel);
            }

            // if not found in tbl_reservation_cancelled and tbl_reservation
            //check with table tbl_warrant_reservation_rejected.
            $query = "SELECT i.*,
                    r.*,
                    u.*,
                    t.train_start_station,
                    t.train_end_station,
                    t.train_name,
                    t.train_start_time,
                    t.train_end_time,
                    t.train_type,
                    ctt.compartment_class_type,
                    tt.train_type,
                    start_st.station_name AS start_station_name,
                    end_st.station_name AS end_station_name
                FROM tbl_inquiry i
                    INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                    INNER JOIN tbl_warrant_reservation_rejected r ON i.inquiry_ticket_id = r.reservation_ticket_id
                    INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                    JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                    JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                    JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                    JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                    JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
             
                GROUP BY i.inquiry_id;";
            $result_rejected = $this->query($query);

            if (is_array($result_rejected) && count($result_rejected) > 0) {
                $data = array_merge($data, $result_rejected);
            }

        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        
        if(is_array($data) && count($data) > 0){
            return $data;
        }
        return [];
    }

    public function getInquirySummary($id)
    {
        try {
            $query = "SELECT i.*,
                    r.*,
                    u.*,
                    t.train_start_station,
                    t.train_end_station,
                    t.train_name,
                    t.train_start_time,
                    t.train_end_time,
                    t.train_type,
                    ctt.compartment_class_type,
                    tt.train_type,
                    start_st.station_name AS start_station_name,
                    end_st.station_name AS end_station_name,
                    wr.*,
                    wi.warrant_image_path
                FROM tbl_inquiry i
                    INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                    INNER JOIN tbl_reservation r ON i.inquiry_ticket_id = r.reservation_ticket_id
                    INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                    JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                    JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                    JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                    JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                    JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    LEFT JOIN tbl_warrant_reservation wr ON r.reservation_id = wr.warrant_reservation_id 
                    LEFT JOIN tbl_warrant_image wi ON wr.warrant_image_id = wi.warrant_image_id
                
                WHERE i.inquiry_ticket_id = :id ;";

            $result = $this->query($query, ['id' => $id]);

            if (is_array($result) && count($result) > 0) {
                return $result;
            }


            $query = "SELECT i.*,
                    r.*,
                    u.*,
                    t.train_start_station,
                    t.train_end_station,
                    t.train_name,
                    t.train_start_time,
                    t.train_end_time,
                    t.train_type,
                    ctt.compartment_class_type,
                    tt.train_type,
                    start_st.station_name AS start_station_name,
                    end_st.station_name AS end_station_name,
                    wr.*,
                    wi.warrant_image_path
                FROM tbl_inquiry i
                    INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                    INNER JOIN tbl_reservation_cancelled r ON i.inquiry_ticket_id = r.reservation_ticket_id
                    INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                    JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                    JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                    JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                    JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                    JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    LEFT JOIN tbl_warrant_reservation wr ON r.reservation_id = wr.warrant_reservation_id 
                    LEFT JOIN tbl_warrant_image wi ON wr.warrant_image_id = wi.warrant_image_id
                
                WHERE i.inquiry_ticket_id = :id ;";

            $result = $this->query($query, ['id' => $id]);

            if (is_array($result) && count($result) > 0) {
                return $result;
            }


            $query = "SELECT i.*,
                    r.*,
                    u.*,
                    t.train_start_station,
                    t.train_end_station,
                    t.train_name,
                    t.train_start_time,
                    t.train_end_time,
                    t.train_type,
                    ctt.compartment_class_type,
                    tt.train_type,
                    start_st.station_name AS start_station_name,
                    end_st.station_name AS end_station_name,
                    wr.*,
                    wi.warrant_image_path
                FROM tbl_inquiry i
                    INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                    INNER JOIN tbl_warrant_reservation_rejected r ON i.inquiry_ticket_id = r.reservation_ticket_id
                    INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                    JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                    JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                    JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                    JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                    JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    LEFT JOIN tbl_warrant_reservation wr ON r.reservation_id = wr.warrant_reservation_id 
                    LEFT JOIN tbl_warrant_image wi ON wr.warrant_image_id = wi.warrant_image_id
                
                WHERE i.inquiry_ticket_id = :id ;";

            $result = $this->query($query, ['id' => $id]);

            if (is_array($result) && count($result) > 0) {
                return $result;
            }

            return [];
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return [];
    }

    public function getStationInquiry()
    {
        $query = "SELECT * FROM tbl_inquiry WHERE inquiry_station = :station";
        $data = $this->query($query, array('station' => $_SESSION['USER']->user_data));
        if (is_array($data) && count($data) > 0) {
            return $data;
        }
        return [];
    }

    public function getInquiryStationMaster()
    {
        $data = [];
        try {
            // search table tbl_reservation
            $query = "SELECT i.*,
                            r.*,
                            u.*,
                            t.train_start_station,
                            t.train_end_station,
                            t.train_name,
                            t.train_start_time,
                            t.train_end_time,
                            t.train_type,
                            ctt.compartment_class_type,
                            tt.train_type,
                            start_st.station_name AS start_station_name,
                            end_st.station_name AS end_station_name
                        FROM tbl_inquiry i
                            INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                            INNER JOIN tbl_reservation r ON i.inquiry_ticket_id = r.reservation_ticket_id
                            INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                            JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                            JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                            JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                            JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                            JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    
                        GROUP BY i.inquiry_id;";


            $result = $this->query($query);

            if (is_array($result) && count($result) > 0) {
                $data = array_merge($data, $result);
            }

            // if not found in tbl_reservation
            // check in tbl_reservation canceled
            $query = "SELECT i.*,
                        r.*,
                        u.*,
                        t.train_start_station,
                        t.train_end_station,
                        t.train_name,
                        t.train_start_time,
                        t.train_end_time,
                        t.train_type,
                        ctt.compartment_class_type,
                        tt.train_type,
                        start_st.station_name AS start_station_name,
                        end_st.station_name AS end_station_name
                    FROM tbl_inquiry i
                        INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                        INNER JOIN tbl_reservation_cancelled r ON i.inquiry_ticket_id = r.reservation_ticket_id
                        INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                        JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                        JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                        JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                        JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                        JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
                    GROUP BY i.inquiry_id;";

            $result = $this->query($query);

            if (is_array($result) && count($result) > 0) {
                $data = array_merge($data, $result);
            }

            // if not found in tbl_reservation_cancelled and tbl_reservation
            //check with table tbl_warrant_reservation_rejected.
            $query = "SELECT i.*,
                    r.*,
                    u.*,
                    t.train_start_station,
                    t.train_end_station,
                    t.train_name,
                    t.train_start_time,
                    t.train_end_time,
                    t.train_type,
                    ctt.compartment_class_type,
                    tt.train_type,
                    start_st.station_name AS start_station_name,
                    end_st.station_name AS end_station_name
                FROM tbl_inquiry i
                    INNER JOIN tbl_user u ON i.inquiry_passenger_id = u.user_id
                    INNER JOIN tbl_warrant_reservation_rejected r ON i.inquiry_ticket_id = r.reservation_ticket_id
                    INNER JOIN tbl_train t ON r.reservation_train_id = t.train_id
                    JOIN tbl_compartment c ON r.reservation_compartment_id = c.compartment_id
                    JOIN tbl_compartment_class_type ctt ON c.compartment_class_type = ctt.compartment_class_type_id
                    JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
                    JOIN tbl_station start_st ON t.train_start_station = start_st.station_id
                    JOIN tbl_station end_st ON t.train_end_station = end_st.station_id
             
                GROUP BY i.inquiry_id;";
            $result = $this->query($query);

            if (is_array($result) && count($result) > 0) {
                return $data = array_merge($data, $result);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return [];
    }
}
