<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 10:22
 */
require 'app/models/Noticia.php';
require 'app/models/Calificacion.php';
class InicioController{
    private $crypt;
    private $nav;
    private $log;
    private $clean;
    private $noticia;
    private $calificacion;
    public function __construct()
    {
        $this->crypt = new Crypt();
        $this->log = new Log();
        $this->clean = new Clean();
        $this->noticia = new Noticia();
        $this->calificacion = new Calificacion();
    }
    //Vistas
    public function aprender(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            $noticias = $this->noticia->listar_noticias();
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inicio/aprender.php';
            require _VIEW_PATH_ . 'modal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function ver(){
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
            require _VIEW_PATH_ . 'inicio/ver.php';
            require _VIEW_PATH_ . 'modal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function respuesta(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            if(isset($_GET['id'])){
                $id_noticia = $_GET['id'];
            } else {
                throw new Exception('ID SIN DECLARAR');
            }
            $id_user = $this->crypt->decrypt($_SESSION['c_u'],_FULL_KEY_);
            $noticia = $this->noticia->listar_noticia($id_noticia);
            $respuesta = $this->calificacion->listar_usuario_noticia($id_noticia, $id_user);
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inicio/respuesta.php';
            require _VIEW_PATH_ . 'modal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }

    public function recompensas(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'inicio/recompensas.php';
            require _VIEW_PATH_ . 'modal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    //Funciones
    public function enviar_respuesta(){
        try{
            $model = new Calificacion();
            $model->calificacion_respuesta = $_POST['respuesta'];
            $model->id_noticia = $_POST['id_noticia'];
            $model->id_user = $_POST['id_user'];
            $result = $this->calificacion->guardar_calificacion($model);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        echo $result;
    }
}