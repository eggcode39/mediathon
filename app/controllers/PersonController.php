<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 1:07
 */
require 'app/models/Person.php';
class PersonController{
    private $log;
    private $person;
    public function __construct()
    {
        $this->log = new Log();
        $this->person = new Person();
    }

    public function listar_personas(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $datos = $this->person->listar_personas();
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $datos = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response, "data" => $datos);
        echo json_encode($data);
    }
}