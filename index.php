<?php
/**
 * Created by PhpStorm.
 * User: CesarJose39
 * Date: 22/10/2018
 * Time: 11:28
 */
//Gestión de Acceso a Vistas
try{
    //Establecer Zona Horaria
    date_default_timezone_set('America/Lima');

    //Para Mostrar o No Errores (Comentado Para SI, Descomentado Para NO)
    //error_reporting(E_ALL);

    //Variables Globales
    require 'core/globals.php';

    //Levantamiento del Log para registro de errores
    require 'app/models/Log.php';
    //LLamada a archivo gestor de base de datos
    require 'core/Database.php';
    //LLamada a archivo para limpieza de datos
    require 'app/models/Clean.php';
    //Inicio clase para la encriptacion de contenido
    require 'app/models/Crypt.php';
    //Levantamiento de registro de roles y permisos para acceso a vistas
    require 'app/models/Menui.php';
    //Inicio Clase Para Generación de Menus Dinamicos
    require 'app/models/Navbar.php';
    //Inicio Clase Para Actualización de Datos de Usuario
    require 'app/models/Update.php';

    //Inicialización de clases necesarias en Index
    $errores = new Log();
    $menui = new Menui();
    $crypt = new Crypt();

    // Manejo de Errores Personalizado de PHP a Try/Catch
    function exception_error_handler($severidad, $mensaje, $fichero, $linea) {
        $cadena =  '[LEVEL]: ' . $severidad . ' IN ' . $fichero . ': ' . $linea . '[MESSAGGE]' . $mensaje . "\n";
        $guardar = new Log();
        $guardar->insert($cadena, "Excepcion No Manejada");
        //echo $cadena;
    }

    //Para manejo de caracteres
    header("Content-Type: text/html;charset=utf-8");
    //Especificar el manejo de errores personalizados
    set_error_handler("exception_error_handler");
    //Inicio de Sesion
    session_start();

    //Verificación de Variables de Sesion y Cookies
    require 'core/session.php';

    //Inicio de Código de Verificación de Permisos

    //Captura de Datos para Obtener el Controlador y la Accion
    //Por Aquí Pasan Todas Las Funciones Para La Lectura de Vistas
    if(isset($_GET['c'])){
        //Aqui se recibe el controlador, si es que no está declarado
        $controlador = $_GET['c'];
    } else {
        //Si No Hay Controlador Declarado, Se Hace Validación

        //Esta Parte Del Código Es Para Software Que Sólo Funcionan Con Usuarios Registrados
        if(isset($_SESSION['ru'])){
            //Si Entra Aquí, Es Porque Hay Una Sesión Iniciada
            $controlador = "Admin";
        } else {
            $controlador = "Index";
        }
        //Esta Parte Del Código Es Para Software Que Tienes Varias Vistas Libres Para Varios Usuarios
        //$controlador = "Index";
    }
    $controlador = trim(ucfirst($controlador));

    //Obtencion de Datos de Accion, Si No Hay Una Declarada, Se Pone "Index" Por Defecto
    $accion = $_GET['a'] ?? "index";
    $accion = trim(strtolower($accion));
    //Variable Usada Para Declarar La Funcion En Caso De Error
    $function_action = $controlador . "|" . $accion;

    //Verificar existencia de los archivos
    $archivo = 'app/controllers/' . $controlador . 'Controller.php';
    //Verifica Si El Archivo Existe
    if(file_exists($archivo)){
        //Variable Para Determinar Si Procede O No La Petición
        $autorizado = false;

        if(isset($_SESSION['ru'])){
            $role = $_SESSION['ru'];
            $rol = $crypt->decrypt($role, _FULL_KEY_);
            $view = $controlador . '/' . $accion;
            $autorizado = $menui->verificar_rol_usuario($rol, $controlador, $accion);
            $permiso = $menui->verificar_estado_usuario($crypt->decrypt($_SESSION['_n'], _FULL_KEY_));
        } else {
            $view = $controlador . '/' . $accion;
            $autorizado = $menui->verificar_rol_usuario(1, $controlador, $accion);
            $permiso = 1;
        }
        //Si $autorizado =  true Entra Aquí, Descomentar La Linea Siguiente Si Sólo Se Quiere Probar Funciones
        //$autorizado = true;
        //$permiso = 1;
        if($autorizado && $permiso == 1){
            try{
                //Entra Aquí Si La Clase Y La Funcion Existen

                //Para usar en el menú y navbar
                $_SESSION['accion'] = $accion;
                $_SESSION['accionnav'] = $accion;
                $_SESSION['controlador'] = $controlador;

                require $archivo;
                $clase = sprintf('%sController', $controlador);
                $controller = new $clase;
                $controller->$accion();

                //Eliminación de Variables de Sesión Para Manejo de Menú
                unset($_SESSION['accion']);
                unset($_SESSION['controlador']);
                unset($_SESSION['accionnav']);
                unset($_SESSION['icono']);
            } catch (\Throwable $e){
                //Si La Funcion No Existe, Entra Aquí.
                require 'app/controllers/ErrorController.php';
                $clase = sprintf('%sController', 'Error');
                $accion = 'error';
                $controller = new $clase;
                $controller->$accion();
                $errores->insert($e->getMessage(), $function_action);
            }
        } else {
            require_once $archivo;
            $clase = sprintf('%sController',  $controlador);
            $controller = new $clase;
            $funcion_exists = method_exists($controller, $accion);

            if($funcion_exists){
                if(isset($_COOKIE['role']) || isset($_SESSION['role'])){
                    if($permiso == 0){
                        //LLEGA AQUI SI FUE INHABILITADO PERO TENIA PERMISOS DE ACCESO
                        $archivof = 'app/controllers/LoginController.php';
                        $controlador = 'Login';
                        $menui->singOut();
                    } else {
                        //LLEGA AQUI SI SE TRATA DE ACCEDER A ACCION O FUNCION SIN PERMISOS Y SI SE ESTA LOGUEADO
                        $archivof = 'app/controllers/ErrorController.php';
                        $controlador = 'Error';
                    }

                } else {
                    //LLEGA AQUI SI SE TRATA DE ACCEDER A ACCION O FUNCION SIN PERMISOS Y SI NO SE ESTA LOGUEADO
                    $archivof = 'app/controllers/LoginController.php';
                    $controlador = 'Login';
                }
                require $archivof;
                $clase = sprintf('%sController', $controlador);
                $accion = 'index';
                $controller = new $clase;
                $controller->$accion();
                $errores->insert("SIN PERMISOS SUFICIENTES", $function_action);
            } else {
                $archivof = 'app/controllers/ErrorController.php';
                $controlador = 'Error';
                require $archivof;
                $clase = sprintf('%sController', $controlador);
                $accion = 'index';
                $controller = new $clase;
                $controller->$accion();
                $errores->insert("ACCESO A METODO NO EXISTENTE", $function_action);
            }
        }
    } else {
        //Si el Archivo No Existe, Genera El Error Y Notifica En La Pantalla
        require 'app/controllers/ErrorController.php';
        $clase = sprintf('%sController', 'Error');
        $accion = 'error';
        $controller = new $clase;
        $controller->$accion();
        //Acciones si el archivo no existe
        //Automaticamente, notificar error
        $errores->insert("ACCESO A CONTROLADOR NO EXISTENTE", $function_action);
    }
} catch (Exception $e){
    //Error en Try/Catch
    require 'app/controllers/ErrorController.php';
    $clase = sprintf('%sController', 'Error');
    $accion = 'error';
    $controller = new $clase;
    $controller->$accion();
    //Acciones si el archivo no existe
    //Automaticamente, notificar error
    $errores->insert("ERROR EN MANEJO DE ERRORES", $function_action);
}
