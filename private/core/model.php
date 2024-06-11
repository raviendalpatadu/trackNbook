<?php
// main model class

// use function PHPSTORM_META\type;

class Model extends Database
{

    public $errors = array();
    protected $table;
    // protected $allowedColumns;
    // protected $beforeInsert;
    // protected $afterSelect;

    public function __construct()
    {
        if (!property_exists($this, 'table')) {
            $this->table = "tbl_" . strtolower(get_class($this));
        }
    }


    public function where($column, $value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        // echo 'where ::  '.$query .'<br>';
        $data = $this->query($query, [
            'value' => $value
        ]);

        // run after select
        if (is_array($data) && property_exists($this, 'afterSelect')) {
            foreach ($this->afterSelect as $func) {
                $data = $this->$func($data);
            }
        }

        return $data;
    }
    public function whereOne($column, $value)
    {
        $column = addslashes($column);
        $query = "select * from $this->table where $column = :value";
        // echo 'where ::  '.$query .'<br>';
        $data = $this->query($query, [
            'value' => $value
        ]);

        // run after select
        if (is_array($data) && property_exists($this, 'afterSelect')) {
            foreach ($this->afterSelect as $func) {
                $data = $this->$func($data);
            }
        }
        if (is_array($data)) {
            $data = $data[0];
        }

        return $data;
    }


    public function findAll()
    {

        $query = "select * from $this->table ";

        $data = $this->query($query);
        // run after select
        if (is_array($data) && property_exists($this, 'afterSelect')) {
            foreach ($this->afterSelect as $func) {
                $data = $this->$func($data);
            }
        }

        return $data;
    }

    public function insert($data)
    {
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }

        if (property_exists($this, 'beforeInsert')) {
            foreach ($this->beforeInsert as $func) {
                $data = $this->$func($data);
            }
        }


        $keys = array_keys($data);
        $column = implode(',', $keys);
        $value = implode(',:', $keys);

        $query = "insert into $this->table ($column) values(:$value)";
        // echo $query;
        return $this->query($query, $data);
    }


    public function update($id, $data, $id_feild = '')
    {
        // revmove unwanted columns
        if (property_exists($this, 'allowedColumns')) {
            foreach ($data as $key => $column) {
                if (!in_array($key, $this->allowedColumns)) {
                    unset($data[$key]);
                }
            }
        }
        
        $str = '';
        foreach ($data as $key => $value) {
            $str .= $key . "= :" . $key . ",";
        }
        $str = trim($str, ",");
        $data['id'] = $id;
        // echo "{$id}<pre>";
        //     print_r($data);
        //     echo "</pre>";
            
        try {
            if ($id_feild == '') {
                $query = "update $this->table set $str where " . strtolower(get_class($this)) . "_id = :id";
            } else {
                $query = "update $this->table set $str where $id_feild = :id";
            }
            return $this->query($query, $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }


    public function delete($id, $id_feild = '')
    {
        $data['id'] = $id;

        try {
            if ($id_feild == '') {
                $query = "delete from $this->table where " . strtolower(get_class($this)) . "_id = :id";
            } else {
                $query = "delete from $this->table where $id_feild = :id";
            }
            return $this->query($query, $data);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }



    public function getCount()
    {
        try {
            $query = "select count(*) as count from $this->table";
            $data = $this->query($query);
            return $data[0]->count;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function callProcedure($procedure, $data)
    {
        // no of arguments arw in $data
        $str = '';
        for ($i = 0; $i < count($data); $i++) {
            $str .= '?,';
        }
        $str = trim($str, ',');
         
        try {
            $query = "call $procedure($str)";
            // echo "<pre>";
            // print_r(array_values($data));
            // echo "</pre>";
            return $this->query($query, array_values($data));
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}
