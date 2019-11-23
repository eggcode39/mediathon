<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 4:33
 */
require 'app/models/Userg.php';
require 'app/models/Person.php';
require 'app/models/User.php';
require 'app/models/Validate.php';
require 'app/models/Role.php';
class RegistrarController{
    private $crypt;
    private $nav;
    private $log;
    private $userg;
    private $user;
    private $person;
    private $clean;
    private $validate;
    private $rol;

    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->userg = new Userg();
        $this->user = new User();
        $this->person = new Person();
        $this->clean = new Clean();
        $this->validate = new Validate();
        $this->rol = new Role();
    }

    public function index(){
        try{
            require _VIEW_PATH_ . 'registrar.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    //funciones
    public function registrar(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $model = new User();
            $modelp = new Person();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['person_name']) && isset($_POST['person_surname']) && isset($_POST['person_dni']) && isset($_POST['person_birth']) && isset($_POST['person_number_phone']) && isset($_POST['person_genre']) && isset($_POST['person_address']) && isset($_POST['person_city']) && isset($_POST['person_country']) && isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_nickname']) && isset($_POST['id_role'])){
                //Clean Data
                $_POST['person_name'] = $this->clean->clean_post_str($_POST['person_name']);
                $_POST['person_surname'] = $this->clean->clean_post_str($_POST['person_surname']);
                $_POST['person_dni'] = $this->clean->clean_post_int($_POST['person_dni']);
                $_POST['person_birth'] = $this->clean->clean_post_str($_POST['person_birth']);
                $_POST['person_number_phone'] = $this->clean->clean_post_int($_POST['person_number_phone']);
                $_POST['person_genre'] = $this->clean->clean_post_str($_POST['person_genre']);
                $_POST['person_address'] = $this->clean->clean_post_str($_POST['person_address']);
                $_POST['person_city'] = $this->clean->clean_post_str($_POST['person_city']);
                $_POST['person_country'] = $this->clean->clean_post_str($_POST['person_country']);
                $_POST['user_nickname'] = $this->clean->clean_post_str($_POST['user_nickname']);
                $_POST['user_email'] = $this->clean->clean_post_str($_POST['user_email']);
                $_POST['id_role'] = $this->clean->clean_post_str($_POST['id_role']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_just_str($_POST['person_name'], true, $ok_data, 200);
                $ok_data = $this->clean->validate_post_just_str($_POST['person_surname'], true, $ok_data,200);
                $ok_data = $this->clean->validate_post_int($_POST['person_dni'], true, $ok_data,8);
                $ok_data = $this->clean->validate_post_date($_POST['person_birth'], true, $ok_data, 10,1);
                $ok_data = $this->clean->validate_post_int($_POST['person_number_phone'], true, $ok_data, 32);
                $ok_data = $this->clean->validate_post_just_str($_POST['person_genre'], true, $ok_data,1);
                $ok_data = $this->clean->validate_post_str($_POST['person_address'], true, $ok_data, 200);
                $ok_data = $this->clean->validate_post_just_str($_POST['person_city'], true, $ok_data, 30);
                $ok_data = $this->clean->validate_post_just_str($_POST['person_country'], true, $ok_data, 20);
                $ok_data = $this->clean->validate_post_str($_POST['user_nickname'], true, $ok_data, 40);
                $ok_data = $this->clean->validate_post_str($_POST['user_password'], true, $ok_data, 64);
                $ok_data = $this->clean->validate_post_email($_POST['user_email'], true, $ok_data, 200);
                $ok_data = $this->clean->validate_post_int($_POST['id_role'], true, $ok_data, 11);
            } else {
                $ok_data = false;
            }
            //End Evaluation Of Data Integrity
            //Start Push Data
            if($ok_data){
                if($this->validate->user($_POST['user_nickname'])){
                    //Code 3: Duplicate Nick Name
                    $result = 3;
                    $message = "Code 3: Duplicate Nick Name";
                }
                else {
                    if($this->validate->dni($_POST['person_dni'])){
                        //Code 4: Duplicate Person DNI
                        $result = 4;
                        $message = "Code 4: Duplicate Person DNI";
                    }
                    else {
                        if($this->validate->email($_POST['user_email'])){
                            //Code 6: Duplicate User Email
                            $result = 5;
                            $message = "Code 5: Duplicate Email";
                        } else {
                            //$modelp gets all the data abour person
                            $modelp->person_name= $_POST['person_name'];
                            $modelp->person_surname = $_POST['person_surname'];
                            $modelp->person_dni = $_POST['person_dni'];
                            $modelp->person_birth = $_POST['person_birth'];
                            $modelp->person_number_phone = $_POST['person_number_phone'];
                            $modelp->person_genre = $_POST['person_genre'];
                            $modelp->person_address = $_POST['person_address'];
                            $modelp->person_city = $_POST['person_city'];
                            $modelp->person_country = $_POST['person_country'];
                            //First create the person
                            $resultp = $this->person->create($modelp);
                            if($resultp == 1){
                                //If person->create is ok, $model receives all about user
                                $model->user_nickname= $_POST['user_nickname'];
                                $model->user_password =  password_hash($_POST['user_password'], PASSWORD_BCRYPT);
                                $model->user_email = $_POST['user_email'];
                                $model->id_role = $_POST['id_role'];
                                $model->user_image = "media/user/1/user.jpg";
                                $model->id_person = $this->person->list_by_dni($_POST['person_dni']);
                                //Create the user
                                $result = $this->user->create($model);
                                if($result != 1){
                                    //If a error happened, delete all and send error message
                                    $this->person->delete_person_by_dni($_POST['person_dni']);
                                    //Code 2: General Error
                                    $result = 2;
                                    $message = "Code 2: General Error";
                                }
                            } else {
                                //If a error happened, delete all and send error message
                                $this->person->delete_person_by_dni($_POST['person_dni']);
                                //Code 2: General Error
                                $result = 2;
                                $message = "Code 2: General Error";
                            }
                        }
                    }
                }
            } else {
                //Code 6: False Data Integrity
                $result = 6;
                $message = "Code 6: Fail Data Integrity";
            }

        } catch (Exception $e){
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