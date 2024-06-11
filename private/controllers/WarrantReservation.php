<?php

/**
 * home controller
 */

class WarrantReservation extends Controller
{
    function getWarrantimg($folder, $file_name)
    {   
       try {
            $this->getPrivateImage($folder, $file_name);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

     

    

}
