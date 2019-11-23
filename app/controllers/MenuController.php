<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 09/11/2019
 * Time: 3:23
 */
require 'app/models/Menu.php';
class MenuController{
    private $crypt;
    private $nav;
    private $log;
    private $menu;
    private $clean;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->clean = new Clean();

        $this->menu = new Menu();
    }

    //Vistas
    public function list(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $menu = $this->menu->list();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'menu/list.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function add(){
        try {
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'], _FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'menu/add.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"" . _SERVER_ . "\";</script>";
        }
    }

    public function edit(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $id = $_GET['id'] ?? 0;
            if($id == 0){
                throw new Exception('ID Sin Declarar');
            }
            $menue = $this->menu->listMenu($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'menu/edit.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function role(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            if(isset($_GET['id'])){
                $id_menu = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }

            $menust = $this->menu->listMenuRole($id_menu);
            $menusf = $this->menu->listRole();

            $menuname = $this->menu->listMenuName($id_menu);

            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'menu/role.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    //
    public function functions(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id_menu = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $menuname = $this->menu->listMenuName($id_menu);
            $options = $this->menu->listOptionsPerMenu($id_menu);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'option/list.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function addf(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            if(isset($_GET['id'])){
                $id_menu = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $_SESSION['id_menuee'] = $id_menu;
            $menuname = $this->menu->listMenuName($id_menu);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'option/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editf(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            if(isset($_GET['id'])){
                $id_optionm = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $opt = $this->menu->listOption($id_optionm);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'option/edit.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function listp(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            if(isset($_GET['id'])){
                $id_optionm = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $optionname = $this->menu->listOptionName($id_optionm);
            $id_menu= $this->menu->listOptionIdMenu($id_optionm);
            $permits = $this->menu->listPermitPerOption($id_optionm);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'permit/list.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function addp(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));

            if(isset($_GET['id'])){
                $id_optionm = $_GET['id'];
            } else {
                throw new Exception('ID Sin Declarar');
            }
            $optionname = $this->menu->listOptionName($id_optionm);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'permit/add.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function icons(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'menu/icons.php';
            require _VIEW_PATH_ . 'footer.php';

        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    //Funciones
    public function save(){
        try{
            $model = new Menu();
            //Start Evaluation Of Data Integrity
            $ok_data = true;
            if(isset($_POST['menu_name']) && isset($_POST['menu_icon']) && isset($_POST['menu_controller']) && isset($_POST['menu_order']) && isset($_POST['menu_status']) && isset($_POST['menu_show'])){
                if(isset($_POST['id_menu'])){
                    $_POST['id_menu'] = $this->clean->clean_post_int($_POST['id_menu']);
                    $ok_data = $this->clean->validate_post_int($_POST['id_menu'], true, $ok_data, 11);
                }
                $_POST['menu_name'] = $this->clean->clean_post_str($_POST['menu_name']);
                $_POST['menu_icon'] = $this->clean->clean_post_str($_POST['menu_icon']);
                $_POST['menu_controller'] = $this->clean->clean_post_str($_POST['menu_controller']);
                $_POST['menu_order'] = $this->clean->clean_post_str($_POST['menu_order']);
                $_POST['menu_status'] = $this->clean->clean_post_int($_POST['menu_status']);
                $_POST['menu_show'] = $this->clean->clean_post_int($_POST['menu_show']);
                //Evaluation If All Data is Ok
                $ok_data = $this->clean->validate_post_just_str($_POST['menu_name'], true, $ok_data, 60);
                $ok_data = $this->clean->validate_post_str($_POST['menu_icon'], true, $ok_data, 30);
                $ok_data = $this->clean->validate_post_just_str($_POST['menu_controller'], true, $ok_data, 40);
                $ok_data = $this->clean->validate_post_int($_POST['menu_order'], true, $ok_data, 11);
                $ok_data = $this->clean->validate_post_int($_POST['menu_status'], true, $ok_data, 4);
                $ok_data = $this->clean->validate_post_int($_POST['menu_show'], true, $ok_data, 1);
            } else {
                $ok_data = false;
            }
            if($ok_data){
                if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                    if(isset($_POST['id_menu'])){
                        $model->id_menu = $_POST['id_menu'];
                        $model->menu_name= $_POST['menu_name'];
                        $model->menu_icon= $_POST['menu_icon'];
                        $model->menu_controller= $_POST['menu_controller'];
                        $model->menu_order= $_POST['menu_order'];
                        $model->menu_status= $_POST['menu_status'];
                        $model->menu_show= $_POST['menu_show'];
                        $result = $this->menu->save($model);
                    } else {
                        $model->menu_name= $_POST['menu_name'];
                        $model->menu_icon= $_POST['menu_icon'];
                        $model->menu_controller= $_POST['menu_controller'];
                        $model->menu_order= $_POST['menu_order'];
                        $model->menu_status= $_POST['menu_status'];
                        $model->menu_show= $_POST['menu_show'];
                        $result = $this->menu->save($model);
                    }
                } else {
                    $result = 3;
                }
            } else {
                //Code 6: False Data Integrity
                $result = 6;
                $message = "Code 6: Fail Data Integrity";
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        $response = array("code" => $result);
        $data = array("result" => $response);
        echo json_encode($data);
    }

    public function insertRole(){
        try{
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                if(isset($_POST['id_role']) && isset($_POST['id_menu'])){
                    $result = $this->menu->insertRole($_POST['id_menu'], $_POST['id_role']);
                }
            } else {
                $result = 3;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deleteRole(){
        try{
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                if(isset($_POST['id_role']) && isset($_POST['id_menu'])){
                    $result = $this->menu->deleteRole($_POST['id_menu'], $_POST['id_role']);
                }
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function saveOption(){
        try{
            $model = new Menu();
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                if(isset($_POST['id_optionm'])){
                    $model->id_optionm = $_POST['id_optionm'];
                    $model->optionm_name= $_POST['optionm_name'];
                    $model->optionm_function= $_POST['optionm_function'];
                    $model->optionm_show= $_POST['optionm_show'];
                    $model->optionm_status= $_POST['optionm_status'];
                    $model->optionm_order= $_POST['optionm_order'];
                    $result = $this->menu->saveOption($model);
                } else {
                    $model->id_menu = $_POST['id_menu'];
                    $model->optionm_name= $_POST['optionm_name'];
                    $model->optionm_function= $_POST['optionm_function'];
                    $model->optionm_show= $_POST['optionm_show'];
                    $model->optionm_status= $_POST['optionm_status'];
                    $model->optionm_order= $_POST['optionm_order'];
                    $result = $this->menu->saveOption($model);
                }
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function savePermit(){
        try{
            $model = new Menu();
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                if(isset($_POST['id_permit'])){
                    $model->id_permit = $_POST['id_permit'];
                    $model->permit_action= $_POST['permit_action'];
                    $model->permit_status= $_POST['permit_status'];
                    $result = $this->menu->savePermit($model);
                } else {
                    $model->id_optionm = $_POST['id_optionm'];
                    $model->permit_action= $_POST['permit_action'];
                    $model->permit_status= $_POST['permit_status'];
                    $result = $this->menu->savePermit($model);
                }
            } else {
                $result = 3;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }

    public function deletePermit(){
        $result = 0;
        try{
            if($this->menu->verificatePassword($this->crypt->decrypt($_SESSION['_n'],_FULL_KEY_), $_POST['password'])) {
                if(isset($_POST['id_permit'])){
                    //$this->menu->deletePermit($_POST['id_permit']);
                    $result = $this->menu->deletePermit($_POST['id_permit']);
                }
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