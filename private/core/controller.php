<?php

/**
 * main home controller
 */

class Controller
{
    public function view($view, $data = array())
    {
        if (is_array($data) && count($data) > 0)
            extract($data);

        if (file_exists("../private/views/" . $view . ".view.php")) {
            require("../private/views/" . $view . ".view.php");
        } else {
            require("../private/views/error404.view.php");
        }
    }
    public function load_model($model)
    {
        if (file_exists("../private/models/". ucfirst($model) .".php")) {
            require("../private/models/". ucfirst($model) .".php");
            return $model = new $model();
        }
        return false;
    }
    public function redirect($link)
    {
        header("Location:" . ROOT . trim($link, "/"));
        die;
    }
}
