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
    private $crypt;
    private $clean;
    public function __construct()
    {
        $this->log = new Log();
        $this->login = new Login();
        $this->crypt = new Crypt();
        $this->clean = new Clean();
    }

    public function index(){
        require _VIEW_PATH_ . 'login/login.php';
    }

    public function singIn(){
        $model = [];
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
                            $permisos = [];
                            if(isset($_POST['app']) && $_POST['app'] == true){
                                $user = array(
                                    "c_u" => $model[0]->id_user,
                                    "c_p" => $model[0]->id_person,
                                    "_n" => $model[0]->user_nickname,
                                    "u_e" => $model[0]->user_email,
                                    "u_i" => _SERVER_ . $model[0]->user_image,
                                    "p_n" => $model[0]->person_name,
                                    "p_s" => $model[0]->person_surname,
                                    "ru" => $model[0]->id_role,
                                    "rn" => $model[0]->role_name,
                                    "tn" => $this->crypt->tripleencrypt($model[0]->user_password, $model[0]->id_user, $model[0]->user_created_at)
                                );
                                $permisos = $this->login->role_per_user($model[0]->id_role);
                            } else {
                                if(isset($_POST['remember'])){
                                    if($_POST['remember'] == "true"){
                                        setcookie('c_u', $this->crypt->encrypt($model[0]->id_user, _FULL_KEY_), time() + 30 * 24 * 60 * 60, "/");
                                        setcookie('c_p', $this->crypt->encrypt($model[0]->id_person, _FULL_KEY_), time() + 30 * 24 * 60 * 60, "/");
                                        setcookie('_n', $this->crypt->encrypt($model[0]->user_nickname, _FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
                                        setcookie('u_e', $this->crypt->encrypt($model[0]->user_email, _FULL_KEY_), time() + 30 * 24 * 60 * 60, "/");
                                        setcookie('u_i', $this->crypt->encrypt($model[0]->user_image, _FULL_KEY_), time() + 30 * 24 * 60 * 60, "/");
                                        setcookie('p_n', $this->crypt->encrypt($model[0]->person_name, _FULL_KEY_), time() + 30 * 24 * 60 * 60, "/");
                                        setcookie('p_s', $this->crypt->encrypt($model[0]->person_surname, _FULL_KEY_), time() + 30 * 24 * 60 * 60, "/");
                                        setcookie("ru", $this->crypt->encrypt($model[0]->id_role, _FULL_KEY_), time() + 30* 24 * 60 * 60,"/");
                                        setcookie("rn", $this->crypt->encrypt($model[0]->role_name, _FULL_KEY_), time() + 30* 24 * 60 * 60, "/");
                                        setcookie("tn", $this->crypt->tripleencrypt($model[0]->user_password, $model[0]->id_user, $model[0]->user_created_at), time() + 30* 24 * 60 * 60, "/");
                                    }
                                }
                                $_SESSION['c_u'] = $this->crypt->encrypt($model[0]->id_user, _FULL_KEY_);
                                $_SESSION['c_p'] = $this->crypt->encrypt($model[0]->id_person, _FULL_KEY_);
                                $_SESSION['_n'] = $this->crypt->encrypt($model[0]->user_nickname, _FULL_KEY_);
                                $_SESSION['u_e'] = $this->crypt->encrypt($model[0]->user_email, _FULL_KEY_);
                                $_SESSION['u_i'] = $this->crypt->encrypt($model[0]->user_image, _FULL_KEY_);
                                $_SESSION['p_n'] = $this->crypt->encrypt($model[0]->person_name, _FULL_KEY_);
                                $_SESSION['p_s'] = $this->crypt->encrypt($model[0]->person_surname, _FULL_KEY_);
                                $_SESSION['ru'] = $this->crypt->encrypt($model[0]->id_role, _FULL_KEY_);
                                $_SESSION['rn'] = $this->crypt->encrypt($model[0]->role_name, _FULL_KEY_);
                                $_SESSION['tn'] = $this->crypt->tripleencrypt($model[0]->user_password, $model[0]->id_user, $model[0]->user_created_at);
                            }
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

        if(isset($_POST['app']) && $_POST['app'] == true){
            $response = array("code" => $result,"message" => $message);
            $data = array("result" => $response, "data" => $user, "role" => $permisos);
            echo json_encode($data);
        } else {
            $response = array("code" => $result,"message" => $message);
            $data = array("result" => $response);
            echo json_encode($data);
        }
    }
}