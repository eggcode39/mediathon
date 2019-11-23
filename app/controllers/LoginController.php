<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 07/08/2019
 * Time: 18:38
 */
require 'app/models/Login.php';
class LoginController{
    private $log;
    private $login;
    private $clean;
    public function __construct()
    {
        $this->log = new Log();
        $this->login = new Login();
        $this->clean = new Clean();
    }

    public function singIn(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['user']) && isset($_POST['pass'])){
                //Clean Data
                $_POST['user'] = $this->clean->clean_post_str($_POST['user']);
                $_POST['pass'] = $this->clean->clean_post_str($_POST['pass']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_str($_POST['user'], true, $ok_data, 40);
                $ok_data = $this->clean->validate_post_str($_POST['pass'], true, $ok_data, 64);
            } else {
                $ok_data = false;
            }
            //End Evaluation Of Data Integrity
            //Start Validating Data
            if($ok_data){
                $usuario = $_POST['user'];
                $contrasenha = $_POST['pass'];
                $model = $this->login->login($usuario);
                if(isset($model[0]->id_user)){
                    if($model[0]->user_status == 1){
                        if(password_verify($contrasenha, $model[0]->user_password)){
                            $this->login->last_login($model[0]->id_user);
                            $user = array(
                                "c_u" => $model[0]->id_user,
                                "c_p" => $model[0]->id_person,
                                "_n" => $model[0]->user_nickname,
                                "u_e" => $model[0]->user_email,
                                "u_i" => _SERVER_ . $model[0]->user_image,
                                "p_n" => $model[0]->person_name,
                                "p_s" => $model[0]->person_surname
                            );
                            $result = true;
                        } else {
                            //Code 3: Wrong Credentials
                            $user = [];
                            $result = 3;
                            $message = "Code 3: Wrong Credentials";
                        }
                    } else {
                        //Code 4: Inhabilite User
                        $user = [];
                        $result = 4;
                        $message = "Code 4: Inhabilite User";
                    }
                } else {
                    //If enter here, the nickname do not have a user
                    if($model == 2){
                        //Code 2: General Error
                        $user = [];
                        $result = 2;
                        $message = "Code 2: General Error";
                    } else {
                        //Code 3: Wrong Credentials
                        $user = [];
                        $result = 3;
                        $message = "Code 3: Wrong Credentials";
                    }
                }
            } else {
                //Code 6: False Data Integrity
                $user= [];
                $result = 6;
                $message = "Code 6: Fail Data Integrity";
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $user = [];
            $result = 2;
            $message = "Code 2: General Error";
        }
        //Result
        if($result === true){
            $result = 1;
        }
        /*$response = array("code" => $result,"message" => $message);
        $data = array("result" => $response, "data" => $user);
        echo json_encode($data);*/

        $response = array("code" => $result,"message" => $message);
        $data = array("result" => $response, "data" => $user);
        echo json_encode($data);
    }
}