SELECT i.*,
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
GROUP BY i.inquiry_id;