<?php

class Images extends Model
{
    protected $table = 'tbl_image';
    protected $allowedColumns = ['user_id', 'image_name', 'image_path', 'image_type'];

    public function __construct()
    {
        parent::__construct();
    }
}
