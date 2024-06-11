<?php

class Fares extends Model
{
    protected $table = 'tbl_fare';

    protected $allowedColumns = array('fare_route_id', 'fare_train_type_id', 'fare_compartment_id', 'fare_start_station', 'fare_end_station', 'fare_price');

    public function __construct()
    {
        parent::__construct();
    }

    public function getFareData($train_type, $compartment_type, $start_station, $end_station)
    {
        $query = "SELECT fare_price FROM $this->table WHERE fare_train_type_id = :train_type AND fare_compartment_id = :compartment_type AND fare_start_station = :start_station AND fare_end_station = :end_station";
        $data = $this->query($query, array('train_type' => $train_type, 'compartment_type' => $compartment_type, 'start_station' => $start_station, 'end_station' => $end_station));
        

        return $data;
    }

    // add fare
    public function validate($price_data)
    {
        $data = array();

        foreach ($price_data as $key => $value) {

            if (empty($value)) {
                continue;
            }

            $price_object =  json_decode($value, true);
            // echo "<pre>";
            // print_r($price_object);
            // echo "</pre>";

            $route_id = $price_object['route_id'];
            $train_type_id = $price_object['train_type_id'];
            $compartment_id = $price_object['compartment_type'];
            $start_station = $price_object['start_station_id'];
            $end_station = $price_object['end_station_id'];
            $price = $price_object['price'];

            if ($start_station == $end_station) {
                $data['errors'][] = "start and end station can not be same";
                return $data;
            }

            $data['price_data'][] = array(
                'fare_route_id' => $route_id,
                'fare_train_type_id' => $train_type_id,
                'fare_compartment_id' => $compartment_id,
                'fare_start_station' => $start_station,
                'fare_end_station' => $end_station,
                'fare_price' => $price
            );
        }
        return $data;
        // echo data length
        // echo "cont :" . count($data);
    }
}
