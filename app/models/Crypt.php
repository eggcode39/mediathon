<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 15/10/2018
 * Time: 17:32
 */

class Crypt{
    //Funcion que se encarga de ENCRIPTAR el texto entrante
    function encrypt($string, $key) {
        $result = '';
        for($i=0; $i<strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key))-1, 1);
            $char = chr(ord($char)+ord($keychar));
            $result.=$char;
        }
        return base64_encode($result);
    }

    //Funcion que se encarga de DESENCRIPTAR el texto entrante
    function decrypt($string, $key) {
        if ($string == ''){
            $result = null;
        } else {
            $result = '';
            $string = base64_decode($string);
            for($i=0; $i<strlen($string); $i++) {
                $char = substr($string, $i, 1);
                $keychar = substr($key, ($i % strlen($key))-1, 1);
                $char = chr(ord($char)-ord($keychar));
                $result.=$char;
            }
        }
        return $result;
    }
    //Triple encriptacion
    function tripleencrypt($contrasenha, $usuario, $fecha){
        $pass = '';
        $pass = password_hash($contrasenha, PASSWORD_BCRYPT);
        $pass = $this->encrypt($pass, $fecha);
        $pass = $usuario . '|' . $pass;
        $pass = $this->encrypt($pass, _FULL_KEY_);
        return $pass;
    }
    //Triple desencriptacion
    function tripledecrypt($hash){
        $pass = $hash;
        $pass = $this->decrypt($pass, _FULL_KEY_);
        $pass = explode("|", $pass);
        if(is_array($pass)){
            if(isset($pass[0])){
                $int = intval($pass[0]);
                if(!is_int($int) || $int === 0){
                    $pass = false;
                }
            } else {
                $pass = false;
            }
        } else {
            $pass = false;
        }
        return $pass;
    }
}

//Posdata: No pregunten, no tengo idea de como hace la encriptacion.
//Sólo hice copia y pega de internet.
//Apunte: Crear función propia de encriptacion.