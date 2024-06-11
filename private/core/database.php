<?php
// database connection

class Database
{

    protected function connect()
    {
        $string = DBDRIVER . ":host=" . DBHOST . ";dbname=" . DBNAME;
        // echo $string;
        if (!$con = new PDO($string, DBUSER, DBPASS)) {
            die("database connection faild");
        }
        return $con;
    }


    public function query($query, $data = array(), $data_type = "object")
    {
        try {
            $con = $this->connect();
            $stm = $con->prepare($query);

            if ($stm) {
                $check = $stm->execute($data);
                if ($check) {
                    // if a insert query is been executed return the id of the inserted row
                    if (preg_match("/^INSERT/i", $query)) {

                        return $con->lastInsertId();
                    }

                    // if a call procedure is been executed return the result of the procedure
                    if (preg_match("/^CALL/i", $query)) {
                        $data = $stm->fetchAll(PDO::FETCH_OBJ);
                        $con = null;

                        if(is_object($data) && count($data)) return $data;
                        // return $data;
                    }

                    if ($data_type == "object") {
                        $data = $stm->fetchAll(PDO::FETCH_OBJ);
                    } elseif ($data_type == "array") {
                        $data = $stm->fetchAll(PDO::FETCH_ASSOC);
                    }

                    if (is_array($data) && count($data) > 0) {
                        // echo "<pre>";
                        // print_r($data);
                        // echo "</pre>";
                        $con = null;
                        return $data;
                    }
                }
            }
        } catch (PDOException $e) {
            // echo $query;
            die($e);
        }
        $con = null;
        return false;
    }
}
