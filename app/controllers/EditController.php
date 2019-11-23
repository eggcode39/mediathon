<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/11/2019
 * Time: 23:27
 */
require 'app/models/User.php';
require 'app/models/Person.php';
require 'app/models/Edit.php';

class EditController{
    private $crypt;
    private $nav;
    private $user;
    private $person;
    private $log;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->user = new User();
        $this->person = new Person();
        $this->log = new Log();
        $this->edit = new Edit();
    }
    //Vistas
    public function info(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            $_SESSION['id_personeinfo'] = $this->crypt->decrypt($_SESSION['c_p'],_FULL_KEY_);
            $person = $this->person->list_all($this->crypt->decrypt($_SESSION['c_p'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'edit/info.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function changeUser(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            $_SESSION['id_userededit'] = $this->crypt->decrypt($_SESSION['c_u'],_FULL_KEY_);
            $user = $this->user->list_all($this->crypt->decrypt($_SESSION['c_u'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'edit/changeUser.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function changepass(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            $_SESSION['id_userchginfo'] = $this->crypt->decrypt($_SESSION['c_u'],_FULL_KEY_);
            $user = $this->user->list_all($this->crypt->decrypt($_SESSION['c_u'],_FULL_KEY_));

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'edit/changepass.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }


    //Funciones
    public function save(){
        try{
            $model = new Person();
            if(isset($_SESSION['id_personeinfo'])){
                $model->id_person = $_SESSION['id_personeinfo'];
                $model->person_name= $_POST['person_name'];
                $model->person_surname = $_POST['person_surname'];
                $model->person_birth = $_POST['person_birth'];
                $model->person_number_phone = $_POST['person_number_phone'];
                $model->person_genre = $_POST['person_genre'];
                $model->person_address = $_POST['person_address'];
                $result = $this->person->savei($model);
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function saveNewNick(){
        try{
            $model = new User();
            if(isset($_SESSION['id_userededit'])){
                if($this->user->selectNickname($_SESSION['id_userededit']) == $_POST['user_nickname']){
                    $model->id_user = $_SESSION['id_userededit'];
                    $model->user_nickname = $_POST['user_nickname'];
                    $result = $this->edit->save($model);
                    //$this->user->sessionclose();
                } else {
                    if($this->user->validateUser($_POST['user_nickname'])){
                        $result = 3;
                    } else {
                        $model->id_user = $_SESSION['id_userededit'];
                        $model->user_nickname = $_POST['user_nickname'];
                        $result = $this->edit->save($model);
                        $this->user->sessionclose();
                    }
                }
            } else {
                $result = 2;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function chgpass(){
        try{
            $model = new User();
            if(isset($_SESSION['id_userchginfo'])){
                $model->id_user = $_SESSION['id_userchginfo'];
                $model->user_password =  password_hash($_POST['user_password'], PASSWORD_BCRYPT);
                $result = $this->user->changepassword($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}