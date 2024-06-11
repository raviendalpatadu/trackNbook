<?php

/**
 * Fare controller
 */

class Fare extends Controller
{
    
    function index($id = '')
    {
        $route = new Routes();
        $data['routes'] = $route->getRoute();

        $train_type = new TrainTypes();
        $data['train_types'] = $train_type->findAll();

        $compartment_type = new CompartmentTypes(); 
        $data['compartment_types'] = $compartment_type->findAll();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $fare = new Fares();
            $priceData = $fare->validate($_POST['price_input']);

            for($i = 0; $i < count($priceData['price_data']); $i++){
                $fare->insert($priceData['price_data'][$i]);
            }

            $this->redirect('fare/');
            
        }
        $this->view('add.fare', $data);
    }

    

}