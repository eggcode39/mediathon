<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 16/08/2019
 * Time: 22:17
 */
require 'app/models/Person.php';
require 'app/models/Validate.php';
require 'app/models/Clean.php';
require 'app/models/ImageComp.php';
class PersonController{
    private $crypt;
    private $log;
    private $person;
    private $validate;
    private $clean;
    private $imagecomp;

    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->person = new Person();
        $this->validate = new Validate();
        $this->clean = new Clean();
        $this->imagecomp = new ImageComp();
    }
    //Edit Information About Person
    public function edit(){
        try{
            $message = "We did it. Your awesome... and beatiful";
            $model = new Person();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['person_name']) && isset($_POST['person_surname']) && isset($_POST['person_number_phone']) && isset($_POST['person_genre']) && isset($_POST['person_address']) && isset($_POST['person_birth']) && isset($_POST['id_person'])){
                //Clean Data
                $_POST['person_name'] = $this->clean->clean_post_str($_POST['person_name']);
                $_POST['person_surname'] = $this->clean->clean_post_str($_POST['person_surname']);
                $_POST['person_number_phone'] = $this->clean->clean_post_int($_POST['person_number_phone']);
                $_POST['person_genre'] = $this->clean->clean_post_str($_POST['person_genre']);
                $_POST['person_address'] = $this->clean->clean_post_str($_POST['person_address']);
                $_POST['person_birth'] = $this->clean->clean_post_str($_POST['person_birth']);
                //$_POST['person_city'] = $this->clean->clean_post_str($_POST['person_city']);
                //$_POST['person_country'] = $this->clean->clean_post_str($_POST['person_country']);
                $_POST['id_person'] = $this->clean->clean_post_str($_POST['id_person']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_just_str($_POST['person_name'], true, $ok_data, 200);
                $ok_data = $this->clean->validate_post_just_str($_POST['person_surname'], true, $ok_data,200);
                $ok_data = $this->clean->validate_post_int($_POST['person_number_phone'], true, $ok_data, 32);
                $ok_data = $this->clean->validate_post_just_str($_POST['person_genre'], true, $ok_data,1);
                $ok_data = $this->clean->validate_post_str($_POST['person_address'], true, $ok_data, 200);
                $ok_data = $this->clean->validate_post_date($_POST['person_birth'], true, $ok_data, 11,1);
                //$ok_data = $this->clean->validate_post_just_str($_POST['person_city'], true, $ok_data, 30);
                //$ok_data = $this->clean->validate_post_just_str($_POST['person_country'], true, $ok_data, 20);
                $ok_data = $this->clean->validate_post_int($_POST['id_person'], true, $ok_data, 11);
            } else {
                $ok_data = false;
            }
            //End of Data Integrity Evaluation
            //Start Push Data
            if($ok_data){
                //$modelp gets all the data abour person
                $model->person_name= $_POST['person_name'];
                $model->person_surname = $_POST['person_surname'];
                $model->person_birth = $_POST['person_birth'];
                $model->person_number_phone = $_POST['person_number_phone'];
                $model->person_genre = $_POST['person_genre'];
                $model->person_address = $_POST['person_address'];
                //$model->person_city = $_POST['person_city'];
                //$model->person_country = $_POST['person_country'];
                $model->id_person = $_POST['id_person'];
                //Edit Person
                $result = $this->person->edit($model);
            } else {
                //Code 6: False Data Integrity
                $result = 6;
                $message = "Code 6: Fail Data Integrity";
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            //Code 2: General Error
            $result = 2;
            $message = "Code 2: General Error";
        }
        //Result
        if($result === true){
            $result = 1;
        }
        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response);
        echo json_encode($data);
    }
}