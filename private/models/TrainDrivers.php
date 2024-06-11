<?php

class TrainDrivers extends Model{
    protected $table = 'tbl_train_driver';
    protected $allowedColumns = array('train_driver_id', 'train_driver_pin_code', 'pin_changed');

    public function __construct(){
        parent::__construct();
    }   
}

