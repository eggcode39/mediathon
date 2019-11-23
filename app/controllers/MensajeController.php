<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 22/11/2019
 * Time: 22:22
 */
require 'app/models/WhatsmsApi.php';
class MensajeController{
    private $log;
    private $wa;
    private $crypt;
    private $nav;
    private $clean;
    public function __construct()
    {
        $this->log = new Log();
        $this->wa = new WhatsmsApi();
        $this->crypt = new Crypt();
        $this->clean = new Clean();
    }
    public function mensajes(){
        try{
            $this->nav = new Navbar();
            $navs = $this->nav->listMenu($this->crypt->decrypt($_SESSION['ru'],_FULL_KEY_));
            require _VIEW_PATH_ . 'header.php';
            require _VIEW_PATH_ . 'navbar.php';
            require _VIEW_PATH_ . 'mensajes/mensaje.php';
            require _VIEW_PATH_ . 'modal.php';
            require _VIEW_PATH_ . 'footer.php';
        } catch (Throwable $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "<script language=\"javascript\">alert(\"Error Al Mostrar Contenido. Redireccionando Al Inicio\");</script>";
            echo "<script language=\"javascript\">window.location.href=\"". _SERVER_ ."\";</script>";
        }
    }
    public function enviar_mensaje(){
        try{
            $this->wa->setApiKey("5dd89fbd620b1");
            $result = $this->wa->sendSms("51969902084", "El bot funciona, entra aqui https://www.bufeotec.com!");
            //$result2 = $this->wa->sendSms("51949805760", "El bot funciona x2!");
            //$result3 = $this->wa->sendSms("51987778574", "El bot funciona x3!");

            var_dump($result);
            //var_dump($result2);
            //var_dump($result3);
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            echo "NO FUNCIONA :(";
        }
    }
}