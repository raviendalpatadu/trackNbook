<?php

class DisablePeriods extends Model{
    protected $table = 'tbl_disable_period';
    protected $allowedColumns = array('disable_period_start_date', 'disable_period_end_date');

    public function __construct(){
        parent::__construct();
    }   
}

