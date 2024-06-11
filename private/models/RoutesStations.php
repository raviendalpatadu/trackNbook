<?php

class RoutesStations extends Model
{
    protected $table = 'tbl_route_station';
    protected $allowedColumns = array('route_no', 'station_id', 'route_station_order');

    public function __construct()
    {
        parent::__construct();
    }

    
    public function validate($values)
    {
        if (!isset($values['station']) || !is_array($values['station']) || empty($values['station'])) {
            $this->errors['stations'] = 'At least one station must be selected';
        }

        if (count($this->errors) === 0) {
            return true;
        }
        return false;
    }

}
