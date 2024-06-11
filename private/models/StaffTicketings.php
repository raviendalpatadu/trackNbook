<?php

class StaffTicketings extends Model{
    protected $table = 'tbl_staff_ticketing';
    protected $allowedColumns = array('staff_ticketing_id', 'staff_ticketing_station');

    public function __construct(){
        parent::__construct();
    }   
}

