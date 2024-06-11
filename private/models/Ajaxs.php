<?php
class Ajaxs extends Model
{

    public static function getSession($name)
    {
        if (isset($_SESSION[$name])) {
            echo json_encode($_SESSION[$name]);
        }
        echo json_encode(false);
    }

}
