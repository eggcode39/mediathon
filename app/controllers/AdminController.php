<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 08/11/2019
 * Time: 17:25
 */
class AdminController{
    private $crypt;
    private $nav;
    private $log;
    private $clean;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->clean = new Clean();
    }
    //Vistas
    public function index(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'admin/index.php';
            require _VIEW_PATH_ . 'modal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
}