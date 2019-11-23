<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/11/2019
 * Time: 12:38
 */
require 'app/models/Userg.php';
require 'app/models/Person.php';
require 'app/models/User.php';
require 'app/models/Validate.php';
require 'app/models/Role.php';
class UsergController{
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

    //Vistas
    public function all(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $id_role_u = $this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_);
            if($id_role_u == 2){
                $users = $this->userg->listAll();
            } else {
                $users = $this->userg->listAll_notsu();
            }
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'userg/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    //Agregar Usuario
    public function addu(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $id_role_u = $this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_);
            if($id_role_u == 2){
                $role = $this->rol->listAll();
            } else {
                $role = $this->rol->listAll_wsu();
            }
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'userg/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editpu(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            //$_SESSION['id_persone'] = $id;
            $person = $this->person->list_all($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'userg/editpu.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function edituu(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $id_role_u = $this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_);
            if($id_role_u == 2){
                $roles = $this->rol->listAll();
            } else {
                $roles = $this->rol->listAll_wsu();
            }
            //$_SESSION['id_usered'] = $id;
            $user = $this->user->list_all($id);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'userg/edituu.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }


    //Funciones
    public function new_u(){
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
    //Editar Datos de Persona
    public function save_edit_personu(){
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
                $result = $this->person->edit_p($model);
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


    public function save_edit_useru(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $model = new User();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['user_nickname']) && isset($_POST['user_email']) && isset($_POST['id_user']) && isset($_POST['id_role']) && isset($_POST['user_status'])){
                //Clean Data
                $_POST['user_nickname'] = $this->clean->clean_post_str($_POST['user_nickname']);
                $_POST['user_email'] = $this->clean->clean_post_str($_POST['user_email']);
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                $_POST['id_role'] = $this->clean->clean_post_int($_POST['id_role']);
                $_POST['user_status'] = $this->clean->clean_post_int($_POST['user_status']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_str($_POST['user_nickname'], true, $ok_data, 40);
                $ok_data = $this->clean->validate_post_email($_POST['user_email'], true, $ok_data,200);
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data,11);
                $ok_data = $this->clean->validate_post_int($_POST['id_role'], true, $ok_data,11);
                $ok_data = $this->clean->validate_post_int($_POST['user_status'], true, $ok_data,11);
            } else {
                $ok_data = false;
            }
            //End Evaluation Of Data Integrity
            //Start Push Data
            if($ok_data){
                //We get the old nickname and email to verify if these have changed
                $old_nickname = $this->validate->nickname_by_id($_POST['id_user']);
                $old_email = $this->validate->email_by_id($_POST['id_user']);
                //If nickname does not change, enter here
                if($old_nickname === $_POST['user_nickname']){
                    if($old_email === $_POST['user_email']){
                        //If enter here, the user do not make changes that need to be verificated
                        //Make the changes
                        $model->user_nickname= $_POST['user_nickname'];
                        $model->user_email = $_POST['user_email'];
                        $model->id_user = $_POST['id_user'];
                        $model->id_role = $_POST['id_role'];
                        $model->user_status = $_POST['user_status'];
                        $result = $this->user->edit($model);
                    } else {
                        //We need to validate if the new email does not exist
                        if($this->validate->email($_POST['user_email'])){
                            //Code 6: Duplicate User Email
                            $result = 5;
                            $message = "Code 5: Duplicate Email";
                        } else {
                            //Make the changes
                            $model->user_nickname= $_POST['user_nickname'];
                            $model->user_email = $_POST['user_email'];
                            $model->id_user = $_POST['id_user'];
                            $model->id_role = $_POST['id_role'];
                            $model->user_status = $_POST['user_status'];
                            $result = $this->user->edit($model);
                        }
                    }
                    //If nickname haved changed, enter here
                } else {
                    //We need to validate if the new nickname does not exist
                    if($this->validate->user($_POST['user_nickname'])){
                        //Code 3: Duplicate Nick Name
                        $result = 3;
                    } else {
                        //If email does not change, enter here
                        if($old_email === $_POST['user_email']){
                            //Make the changes
                            $model->user_nickname= $_POST['user_nickname'];
                            $model->user_email = $_POST['user_email'];
                            $model->id_user = $_POST['id_user'];
                            $model->id_role = $_POST['id_role'];
                            $model->user_status = $_POST['user_status'];
                            $result = $this->user->edit($model);
                            //If email haved changed, enter here
                        } else {
                            //We need to validate if the new email does not exist
                            if($this->validate->email($_POST['user_email'])){
                                //Code 6: Duplicate User Email
                                $result = 5;
                                $message = "Code 5: Duplicate Email";
                            } else {
                                //Make the changes
                                $model->user_nickname= $_POST['user_nickname'];
                                $model->user_email = $_POST['user_email'];
                                $model->id_user = $_POST['id_user'];
                                $model->id_role = $_POST['id_role'];
                                $model->user_status = $_POST['user_status'];
                                $result = $this->user->edit($model);
                            }
                        }
                    }
                }
            } else {
                //Code 6: False Data Integrity
                $result = 6;
                $message = "Code 6: Fail Data Integrity";
            }
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
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

    public function reset_pass(){
        try{
            $model = new User();
            $model->id_user = $_POST['id'];
            $dni = $this->user->getDni($_POST['id']);
            $model->user_password =  password_hash($dni, PASSWORD_BCRYPT);
            $result = $this->user->changepassword($model);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function change_status(){
        try{
            $model = new User();
            $model->id_user = $_POST['id'];
            $model->user_status =  $_POST['user_status'];
            $role = $this->user->get_role($_POST['id']);
            if($role == 2){
                $result = 3;
            } else {
                $result = $this->user->changestatus($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

}