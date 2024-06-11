<?php

class Compartments extends Model
{
    protected $table = 'tbl_compartment';
    protected $allowedColumns = ['compartment_train_id', 'compartment_class', 'compartment_class_type', 'compartment_seat_layout', 'compartment_total_seats', 'compartment_total_number'];

    public function __construct()
    {
        parent::__construct();
    }

    public function getCompartment($id)
    {
        try {
            $query = "SELECT c. * , ct.compartment_class_type

            FROM tbl_compartment c INNER JOIN tbl_compartment_class_type ct ON c.compartment_class_type = ct.compartment_class_type_id
            
            WHERE c.compartment_train_id = :id;";
            
            $result = $this->query($query, ['id' => $id]);
           
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return $result;
    }

}