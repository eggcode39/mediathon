<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 10/06/2019
 * Time: 10:25
 */
//Código para Gestión de WebServices de Bufeo Tec
//Inicio del código
try{
    //Establecer zona horaria
    date_default_timezone_set('America/Lima');
    //Para Mostrar o No Errores (Comentado Para SI, Descomentado Para NO)
    error_reporting(E_ALL);
    //Variables Globales
    require 'core/globals.php';
    //LLamada a archivo gestor de base de datos
    require 'core/Database.php';
    //Levantamiento del Log para registro de errores
    require 'app/models/Log.php';
    //Levantamiento de registro de roles y permisos para acceso a vistas
    require 'app/models/Rolei.php';
    //Inicio clase para la encriptacion de contenido
    require 'app/models/Crypt.php';
    //Inicio clase para limpieza de contenido
    require 'app/models/Clean.php';
    //Clase para validación de token
    require 'app/models/Token.php';
    //Inicio Clase Para Actualización de Datos de Usuario
    require 'app/models/Update.php';

    //Inicialización de clases necesarias
    $crypt = new Crypt();
    $error = new Log();
    $tokenizacion = new Token();
    $rolei = new Rolei();

    // Manejo de Errores Personalizado de PHP para Try/Catch
    function exception_error_handler($severidad, $mensaje, $fichero, $linea) {
        $cadena =  '[LEVEL]: ' . $severidad . ' IN ' . $fichero . ': ' . $linea . '[MESSAGGE]' . $mensaje . "\n";
        $guardar = new Log();
        $guardar->insert($cadena, "Excepcion No Manejada");
    }

    //Para manejo de caracteres (Por defecto utf-8)
    header("Content-Type: text/html;charset=utf-8");
    //Para Permitir CORS
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
    header('Access-Control-Allow-Methods: GET, POST');
    //Declarar el uso de manejo de Error con la Función que declaramos
    set_error_handler("exception_error_handler");

    //Inicio de Sesion
    session_start();
    //Verificación de Variables de Sesion y Cookies
    require 'core/session.php';

    //Inicialización de Variables Para Recepción de Parámetros $_GET
    $controlador = "";
    $accion = "";

    //Recepción del Controlador Enviado
    if(isset($_GET['c'])){
        //Aqui se recibe el controlador, si está declarado
        $controlador = $_GET['c'];
        //Tratamiento de Caracteres
        $controlador = trim(ucfirst($controlador));
        $controlador = filter_var($controlador, FILTER_SANITIZE_SPECIAL_CHARS);
    } else {
        //Si no hay Controlador declarado, se genera error y se detiene el código
        $response = array("code" => 2,"message" => 'INVALIDO');
        $data = array("result" => $response);
        echo json_encode($data);
    }
    //Recepción de la Función/Acción Enviada
    if(isset($_GET['a'])){
        //Aqui la Función/Acción, si está declarado
        $accion = $_GET['a'];
        //Tratamiento de Caracteres
        $accion = trim($accion);
        $accion = filter_var($accion, FILTER_SANITIZE_SPECIAL_CHARS);
    } else {
        //Si no hay Función/Acción declarada, se genera error y se detiene el código
        $response = array("code" => 2,"message" => 'INVALIDO');
        $data = array("result" => $response);
        echo json_encode($data);
        exit;
    }

    //Verificar Existencia del Controlador Solicitado
    $archivo = 'app/controllers/' . $controlador . 'Controller.php';
    if(file_exists($archivo)){
        //Variable Para Determinar Si Procede O No La Petición
        $autorizado = false;
        if(isset($_SESSION['ru'])){
            $role = $_SESSION['ru'];
            $rol = $crypt->decrypt($role, _FULL_KEY_);
            $autorizado = $rolei->verificar_permisos_rol($rol, $controlador, $accion);
            $permiso = $rolei->verificar_estado_usuario($crypt->decrypt($_SESSION['_n'], _FULL_KEY_));
        } else {
            if(isset($_POST['app']) && $_POST['app'] == true){
                if(isset($_POST['tn'])) {
                    //Función que verifica si el token proporcionado es válido
                    $validacion = $tokenizacion->validate_token($_POST['tn']);
                    if($validacion){
                        $usuario = $crypt->tripledecrypt($_POST['tn']);
                        $rol = $rolei->obtener_rol($usuario[0]);
                        $autorizado = $rolei->verificar_permisos_rol($rol, $controlador, $accion);
                        $permiso = $rolei->verificar_estado_usuario_id($usuario[0]);
                    } else {
                        //Si $validacion = false, se responde el json con la respuesta.
                        $response = array("code" => 2,"message" => 'TOKEN INVALIDO');
                        $data = array("result" => $response);
                        echo json_encode($data);
                    }
                } else {
                    $autorizado = $rolei->verificar_permisos_rol(1, $controlador, $accion);
                    $permiso = 1;
                }
            } else {
                $autorizado = $rolei->verificar_permisos_rol(1, $controlador, $accion);
                $permiso = 1;
            }
        }
        //Si $autorizado =  true Entra Aquí, Descomentar La Linea Siguiente Si Sólo Se Quiere Probar Funciones
        //$autorizado = true;
        //$permiso = 1;
        if($autorizado && $permiso == 1){
            try{
                //Entra Aquí Si La Clase Y La Funcion Existen
                require $archivo;
                $clase = sprintf('%sController', $controlador);
                $controller = new $clase;
                $controller->$accion();
            } catch (Throwable $e){
                //Si $validacion = false, se responde el json con la respuesta.
                $response = array("code" => 2,"message" => 'TOKEN INVALIDO');
                $data = array("result" => $response);
                echo json_encode($data);
            }
        } else {
            $errores->insert("SIN PERMISOS SUFICIENTES", $function_action);
            if($permiso == 0){
                $rolei->singOut();
            }
            $response = array("code" => 2,"message" => 'SIN PERMISOS');
            $data = array("result" => $response);
            echo json_encode($data);
        }
    } else {
        //Si no existe el Controlador Solicitado, se genera Error
        $response = array("code" => 2,"message" => 'INVALIDO');
        $data = array("result" => $response);
        echo json_encode($data);
    }
} catch (Exception $e){
    //Si Ocurriera Algún Error Durante la Ejecución del Código, Se Usarán Estas Líneas de Código
    $response = array("code" => 2,"message" => 'INVALIDO');
    $data = array("result" => $response);
    echo json_encode($data);
}

