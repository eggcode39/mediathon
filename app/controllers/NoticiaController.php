<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 3:54
 */
require 'app/models/Noticia.php';
class NoticiaController{
    private $crypt;
    private $nav;
    private $log;
    private $menu;
    private $noticia;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->noticia = new Noticia();
    }
    //Vistas
    public function ver(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $noticias = $this->noticia->listar_noticias();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'noticia/ver.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);;
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function agregar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'noticia/agregar.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function editar(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id = $_GET['id'];
            } else {
                throw new Exception('ID SIN DECLARAR');
            }
            $noticia = $this->noticia->listar_noticia($id);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'noticia/editar.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    //Funciones
    public function guardar(){
        try{
            $model = new Noticia();
            if(isset($_POST['id_noticia'])){
                $model->id_noticia = $_POST['id_noticia'];
                $model->noticia_titulo = $_POST['noticia_titulo'];
                $model->noticia_contexto = $_POST['noticia_contexto'];
                $model->noticia_bajada = $_POST['noticia_bajada'];
                $model->noticia_estado = $_POST['noticia_estado'];
                $model->noticia_mostrar = $_POST['noticia_mostrar'];
                $result = $this->noticia->guardar_noticia($model);
            } else {
                $model->noticia_titulo = $_POST['noticia_titulo'];
                $model->noticia_contexto = $_POST['noticia_contexto'];
                $model->noticia_bajada = $_POST['noticia_bajada'];
                $model->noticia_estado = $_POST['noticia_estado'];
                $model->noticia_mostrar = $_POST['noticia_mostrar'];
                $result = $this->noticia->guardar_noticia($model);
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}