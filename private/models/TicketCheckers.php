<?php

class TicketCheckers extends Model
{
    protected $table = 'tbl_ticket_checker';
    protected $allowedColumns = array('ticket_checker_id', 'ticket_checker_pin_code', 'pin_changed');

    public function __construct()
    {
        parent::__construct();
    }



    public function validateTicketChecker($data)
    {

        // check if id is enter
        if (!isset($data['train_id']) || empty($data['train_id'])) {
            $this->errors['errors']['train_id'] = 'Train ID is required';
        }

        $train = new Trains();
        $train = $train->whereOne('train_no', $data['train_id']);
        $data['train_id'] = $train->train_id;
        // want to check if the train is valid

        // check if the train_id exists in the tbl_train table
        $query = "SELECT t.* FROM tbl_train t WHERE t.train_id = :train_id;";

        $result = $this->query($query, [
            'train_id' => $data['train_id']
        ]);

        $exists = is_array($result) && count($result) > 0;

        if (!$exists) {
            $this->errors['errors']['train_id'] = 'Train ID does not exist';
        }


        // // check if id is a number
        // if (is_numeric(intval($data['train_id']))) {
        //     $this->errors['errors']['train_id'] = 'Train ID must be a number';
        // }
        // check if the particular train is in disable table
        $query = "SELECT t.*,
                 dp.disable_period_start_date,
                 dp.disable_period_end_date
                FROM tbl_train t
                INNER JOIN tbl_train_disable_period td ON t.train_id = td.disable_period_train_id
                INNER JOIN tbl_disable_period dp ON td.disable_period_id = dp.disable_period_id
                WHERE t.train_id = :train_id
                AND dp.disable_period_start_date <= :date 
                AND dp.disable_period_end_date >= :date;";

        $result = $this->query($query, [
            'train_id' => $data['train_id'],
            'date' => date('Y-m-d')
        ]);


        if (is_array($result) && count($result) > 0) {
            $this->errors['errors']['train_id'] = 'Train is not working at now.';
        }



        // check error count
        if (count($this->errors) > 0) {
            return false;
        }
        return true;
    }
}
