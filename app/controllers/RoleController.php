<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 17:02
 */
require 'app/models/Role.php';
require 'app/models/Menu.php';
class RoleController{
    private $crypt;
    private $nav;
    private $role;
    private $log;
    private $menu;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->role = new Role();
        $this->log = new Log();
        $this->menu = new Menu();
    }

    //Vistas
    public function all(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $role = $this->role->listAll();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'role/all.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function add(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'role/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function edit(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $id_role = $id;
            $rol_e = $this->role->list_all($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'role/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (\Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function options(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id_role = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $role = $this->role->list_all($id_role);
            $menu = $this->role->listAllMenu();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';

            require _VIEW_PATH_ . 'role/options.php';
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
            $model = new Role();
            if(isset($_POST['id_role'])){
                $model->id_role = $_POST['id_role'];
                $model->role_name= $_POST['role_name'];
                $model->role_description = $_POST['role_description'];
                $result = $this->role->save($model);
            } else {
                $model->role_name= $_POST['role_name'];
                $model->role_description = $_POST['role_description'];
                $result = $this->role->save($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function delete(){
        try{
            if(isset($_POST['id'])){
                $id = $_POST['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $result = $this->role->delete($id);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function addRelation(){
        try{
            $model = new Role();
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                $id_role = $_POST['id_role'];
                $id_menu = $_POST['id_menu'];
                $result = $this->role->AddRelationship($id_role, $id_menu);
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteRelation(){
        try{
            $model = new Role();
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                $id_role = $_POST['id_role'];
                $id_menu = $_POST['id_menu'];
                $result = $this->role->DeleteRelationship($id_role, $id_menu);
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}