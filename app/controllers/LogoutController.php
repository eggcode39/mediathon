<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 08/11/2019
 * Time: 17:37
 */
class LogoutController{
    private $log;
    private $crypt;
    public function __construct()
    {
        $this->log = new Log();
        $this->crypt = new Crypt();
    }
    //Funciones
    public function singOut(){
        try{
            session_start();
            unset($_SESSION['c_u']);
            unset($_SESSION['c_p']);
            unset($_SESSION['_n']);
            unset($_SESSION['u_e']);
            unset($_SESSION['u_i']);
            unset($_SESSION['p_n']);
            unset($_SESSION['p_s']);
            unset($_SESSION['ru']);
            unset($_SESSION['rn']);
            unset($_SESSION['tn']);
            session_destroy();

            setcookie('c_u', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('c_p', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('_n', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('u_e', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('u_i', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('p_n', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('p_s', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('ru', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie("rn", '1', time() - 365 * 30 * 24 * 60 * 60, "/");

            $okey = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $okey = 2;
            header('Location: ' . _SERVER_);
        }
        if($okey ==1){
            header('Location: ' . _SERVER_ );
        }
    }
}