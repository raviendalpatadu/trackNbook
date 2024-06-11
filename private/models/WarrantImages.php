<?php

class WarrantImages extends Model{
    protected $table = 'tbl_warrant_image';
    protected $allowedColumns = array('warrant_id', 'warrant_image_name',  'warrant_image_path', 'warrant_image_type');

    public function __construct(){
        parent::__construct();
    }   
}
