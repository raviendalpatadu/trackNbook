<?php
class Sales extends Model
{
    protected $table = 'tbl_sales';

    public function __construct()
    {
        parent::__construct();
    }

    public function getSales()
    {
        // try{
        //     $result = $this->where($column, $value);

        //     if($result){
        //         return $result;
        //     }else{
        //         return false;
        //     }
        // }catch(PDOException $e){
        //     echo $e->getMessage();
        // }
        try {
            $con = $this->connect();
            $sql = "SELECT Amount FROM $this->table";
            $result = $con->query($sql);
            if ($result->rowCount() > 0) {
                $amounts = array();

                while ($row = $result->fetch()) {
                    $amounts[] = $row['Amount'];
                }
                unset($result);

                return $amounts;

            } else {
                echo "No records matching your query were found.";
            }
        } catch (PDOException $e) {
            die("ERROR: Could not able to execute $sql. " . $e->getMessage());

        }
    }

}
?>