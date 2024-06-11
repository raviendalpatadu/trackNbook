<?php
class TrainDisablePeriods extends Model
{
    protected $table = 'tbl_train_disable_period';
    protected $allowedColumns = ['train_disable_period_id','disable_period_id', 'disable_period_train_id'];

    public function __construct()
    {
        parent::__construct();
    }

    public function validate($values = array())
    {

        
        if (empty($values['train_id']) || $values['train_id'] == 0) {
            $this->errors['errors']['train_id'] = 'Train is required';
        }


        //check if from date is exists in post
        if (empty($values['disable_period_start_date'])) {
            $this->errors['errors']['disable_period_start_date'] = 'date is required';
        }

        // check if from date is less than current date
        if (!(array_key_exists('errors', $this->errors)) && strtotime($values['disable_period_start_date']) < strtotime(date('Y-m-d'))) {
            $this->errors['errors']['disable_period_start_date'] = 'Date should be future date';
        }


        if (empty($values['disable_period_start_date'])) {
            $this->errors['errors']['disable_period_start_date'] = 'To Date is required';
        }

        // check if to date is less than current date and greater than from date
        if (!(array_key_exists('errors', $this->errors)) && strtotime($values['disable_period_start_date']) < strtotime(date('Y-m-d'))) {
            $this->errors['errors']['disable_period_start_date'] = 'Date should be future date';
        }

        if (!(array_key_exists('errors', $this->errors)) && strtotime($values['disable_period_start_date']) > strtotime($values['disable_period_end_date'])) {
            $this->errors['errors']['disable_period_end_date'] = 'End Date should be greater than Start Date';
        }

        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }

    public function getDisableForTrain($train_id)
    {
        $query = "SELECT t.train_id, dp.disable_period_start_date, dp.disable_period_end_date FROM tbl_train_disable_period tdp
        JOIN tbl_disable_period dp ON tdp.disable_period_id = dp.disable_period_id
        JOIN tbl_train t ON tdp.disable_period_train_id = t.train_id
        WHERE disable_period_train_id = :train_id";

        $result = $this->query(
            $query,
            [
                'train_id' => $train_id
            ]
        );

        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return [];
    }
    public function getAllDisableTrains()
    {
        $query = "SELECT *
        FROM tbl_train_disable_period tdp
            JOIN tbl_disable_period dp ON tdp.disable_period_id = dp.disable_period_id
            JOIN tbl_train t ON tdp.disable_period_train_id = t.train_id
            JOIN tbl_train_type tt ON t.train_type = tt.train_type_id
            JOIN tbl_route r ON t.train_route = r.route_no";

        $result = $this->query($query);

        if (is_array($result) && count($result) > 0) {
            return $result;
        }
        return [];
    }

    public function getDisablePeriodReservations($data){
        $query = "SELECT * FROM tbl_reservation WHERE reservation_train_id = :train_id AND reservation_date BETWEEN :disable_period_start_date AND :disable_period_end_date";
        $result = $this->query($query, $data);

        if(is_array($result) && count($result) > 0){
            return $result;
        }
        return [];
    }
}
