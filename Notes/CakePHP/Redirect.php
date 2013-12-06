<?php 

//redirect with params:

    $this->redirect(array("controller" => "myController", 
                          "action" => "myAction", 
                          $data_can_be_passed_here),
                    $status,
                    $exit);


                    

    $this->redirect(array("controller" => "myController", 
                          "action" => "myAction"));

                    