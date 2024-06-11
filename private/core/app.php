<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
/**
 * main app
 */
class App 
{
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = array();

    public function __construct()
    {
        try{

            $URL = $this->getURL();
    
            if (file_exists("../private/controllers/" . $URL[0] . ".php" )) {
                $this->controller = ucfirst($URL[0]);
                unset( $URL[0]);
            } 
            else {
               echo "<pre>";
                print_r($URL);
                echo "</pre>";
                require("../private/views/error404.view.php");
            }
    
            require ("../private/controllers/" . $this->controller . ".php" );
            $this->controller = new $this->controller();
    
            if (isset($URL[1]) && method_exists($this->controller, $URL[1])) 
            {
                $this->method = ucfirst($URL[1]);
                unset( $URL[1]);
            }
    
            $URL = array_values($URL);
            $this->params = $URL;
            
            call_user_func_array(array($this->controller,$this->method), $this->params);
        }
        catch(Exception $e)
        {
            die($e->getMessage());
        }
    }
    private function getURL()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : "home";

        return explode("/",  filter_var(trim($url, "/"), FILTER_SANITIZE_URL));
        
    }
}
?>