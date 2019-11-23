<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 08/08/2019
 * Time: 12:29
 */
require 'app/models/User.php';
require 'app/models/Person.php';
require 'app/models/Validate.php';
require 'app/models/Clean.php';
require 'app/models/ImageComp.php';
class UserController{
    private $crypt;
    private $log;
    private $person;
    private $user;
    private $validate;
    private $clean;
    private $imagecomp;

    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->person = new Person();
        $this->user = new User();
        $this->validate = new Validate();
        $this->clean = new Clean();
        $this->imagecomp = new ImageComp();
    }
    //Create New User
    public function create(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $model = new User();
            $modelp = new Person();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['person_name']) && isset($_POST['person_surname']) && isset($_POST['person_dni']) && isset($_POST['person_birth']) && isset($_POST['person_number_phone']) && isset($_POST['person_genre']) && isset($_POST['person_address']) && isset($_POST['person_city']) && isset($_POST['person_country']) && isset($_POST['user_email']) && isset($_POST['user_password']) && isset($_POST['user_nickname'])){
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
                                $model->user_image = "media/user/user.jpg";
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
    //Edit Information About User
    public function edit_user(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $model = new User();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['user_nickname']) && isset($_POST['user_email']) && isset($_POST['id_user'])){
                //Clean Data
                $_POST['user_nickname'] = $this->clean->clean_post_str($_POST['user_nickname']);
                $_POST['user_email'] = $this->clean->clean_post_str($_POST['user_email']);
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_str($_POST['user_nickname'], true, $ok_data, 40);
                $ok_data = $this->clean->validate_post_email($_POST['user_email'], true, $ok_data,200);
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data,11);
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
                        //If enter here, the user do not make changes
                        $result = 1;
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
    //Change the password
    public function change_password(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $model = new User();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['id_user']) && isset($_POST['old_password']) && isset($_POST['new_password'])){
                //Clean Data
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                $_POST['old_password'] = $this->clean->clean_post_str($_POST['old_password']);
                $_POST['new_password'] = $this->clean->clean_post_str($_POST['new_password']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data, 11);
                $ok_data = $this->clean->validate_post_str($_POST['old_password'], true, $ok_data,64);
                $ok_data = $this->clean->validate_post_str($_POST['new_password'], true, $ok_data,64);
            } else {
                $ok_data = false;
            }
            //End Evaluation Of Data Integrity
            //Start Push Data
            if($ok_data){
                $old_password_user = $this->validate->password($_POST['id_user']);
                if(password_verify($_POST['old_password'], $old_password_user)){
                    $model->id_user = $_POST['id_user'];
                    $model->user_password = password_hash($_POST['new_password'], PASSWORD_BCRYPT);
                    $result = $this->user->change_password($model);
                } else {
                    //Code 7: Wrong Password
                    $result = 7;
                    $message = "Code 7: Wrong Password";
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
    //List All Users (Disable for The Moment)
    /*public function list(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            $model = $this->user->list_all();
            $result = true;
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
        $data = array("result" => $response, "data" => $model);
        echo json_encode($data);
    }*/
    //List a User Information
    public function list_id(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['id_user'])){
                //Clean Data
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data, 11);
            } else {
                $ok_data = false;
            }
            //End Evaluation Of Data Integrity
            if($ok_data){
                $model = $this->user->list($_POST['id_user']);
                $result = true;
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
        $data = array("result" => $response, "data" => $model);
        echo json_encode($data);
    }
    //Change User Image
    public function change_image(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            //Start of data evaluation integrity
            if(isset($_POST['id_user']) && isset($_FILES['user_image'])){
                //Clean Data
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data, 11);
                $ok_data = $this->clean->validate_post_image($_FILES['user_image'], $ok_data);
            } else {
                $ok_data = false;
            }
            //End Evaluation Of Data Integrity
            if($ok_data){
                $user_image_t = "tmp/user/".$_POST['id_user'].".jpg";
                move_uploaded_file($_FILES['user_image']['tmp_name'],$user_image_t);
                $file_path = "media/user/".$_POST['id_user'].".jpg";
                if($this->imagecomp->redimensionarImagen($user_image_t, $file_path, false)){
                    $user_image = $file_path;
                } else {
                    $user_image = "media/user/user.jpg";
                }
                $result = $this->user->change_image($_POST['id_user'], $user_image);
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
    //Disable User (Disable for the moment)
    /*public function disable(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['id_user'])){
                //Clean Data
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data, 11);
            } else {
                $ok_data = false;
            }
            //End of data integrity evaluation
            //Start Push Data
            if($ok_data){
                $result = $this->user->disable($_POST['id_user']);
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
    }*/
    //Enable User (Disable for the Moment)
    /*public function enable(){
        try{
            //If All OK, the message does not change
            $message = "We did it. Your awesome... and beatiful";
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['id_user'])){
                //Clean Data
                $_POST['id_user'] = $this->clean->clean_post_int($_POST['id_user']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_int($_POST['id_user'], true, $ok_data, 11);
            } else {
                $ok_data = false;
            }
            //End of data integrity evaluation
            //Start Push Data
            if($ok_data){
                $result = $this->user->enable($_POST['id_user']);
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
    }*/
}