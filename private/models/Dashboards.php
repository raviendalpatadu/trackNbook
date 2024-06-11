<?php

class Routes extends Model
{
    protected $table = 'tbl_route';

    public function __construct()
    {
        parent::__construct();
    }

    public function getRoute()
    {
        try {
            $result = $this->findAll();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }


}
