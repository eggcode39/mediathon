<?php
/**
 * Created by PhpStorm.
 * User: Cesar Jose Ruiz
 * Date: 08/04/2019
 * Time: 00:24
 */

if(!isset($_SESSION['c_u'])){
    if(isset($_COOKIE['c_u']) && isset($_COOKIE['c_p']) && isset($_COOKIE['_n']) && isset($_COOKIE['u_e']) && isset($_COOKIE['u_i']) && isset($_COOKIE['p_n']) && isset($_COOKIE['p_s']) && isset($_COOKIE['ru']) && isset($_COOKIE['rn']) && isset($_COOKIE['tn'])) {
        $id_user = $crypt->decrypt($_COOKIE['c_u'], _FULL_KEY_);
        $update = new Update();
        $user = $update->get_information($id_user);
        if(!$user){
            //Si $user = false, por seguridad elimina todas las variables de sesión y cookies
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

            setcookie('c_u', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('c_p', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('_n', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('u_e', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('u_i', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('p_n', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('p_s', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie('ru', '1', time() - 365 * 24 * 60 * 60, "/");
            setcookie("rn", '1', time() - 365 * 30 * 24 * 60 * 60, "/");
            setcookie("tn", '1', time() - 365 * 24 * 60 * 60, "/");
            session_destroy();
            session_start();
        } else {
            //Si $user trae datos, actualiza las variables de sesión
            $_SESSION['c_u'] = $crypt->encrypt($user->id_user,_FULL_KEY_);
            $_SESSION['c_p'] = $crypt->encrypt($user->id_person,_FULL_KEY_);
            $_SESSION['_n'] = $crypt->encrypt($user->user_nickname,_FULL_KEY_);
            $_SESSION['u_e'] = $crypt->encrypt($user->user_email,_FULL_KEY_);
            $_SESSION['u_i'] = $crypt->encrypt($user->user_image,_FULL_KEY_);
            $_SESSION['p_n'] = $crypt->encrypt($user->person_name,_FULL_KEY_);
            $_SESSION['p_s'] = $crypt->encrypt($user->person_surname,_FULL_KEY_);
            $_SESSION['ru'] = $crypt->encrypt($user->id_role,_FULL_KEY_);
            $_SESSION['rn'] = $crypt->encrypt($user->role_name,_FULL_KEY_);
            $_SESSION['tn'] = $crypt->tripleencrypt($user->user_password, $user->id_user, $user->user_created_at);

            setcookie('c_u', $crypt->encrypt($user->id_user,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('c_p', $crypt->encrypt($user->id_person,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('_n', $crypt->encrypt($user->user_nickname,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('u_e', $crypt->encrypt($user->user_email,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('u_i', $crypt->encrypt($user->user_image,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('p_n', $crypt->encrypt($user->person_name,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('p_s', $crypt->encrypt($user->person_surname,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie('ru', $crypt->encrypt($user->id_role,_FULL_KEY_), time() + 365 * 24 * 60 * 60, "/");
            setcookie("rn", $crypt->encrypt($user->role_name,_FULL_KEY_), time() + 365 * 30 * 24 * 60 * 60, "/");
            setcookie("tn", $crypt->tripleencrypt($user->user_password, $user->id_user, $user->user_created_at), time() + 365 * 24 * 60 * 60, "/");
        }
    } else {
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

        setcookie('c_u', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('c_p', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('_n', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('u_e', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('u_i', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('p_n', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('p_s', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('ru', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie("rn", '1', time() - 365 * 30 * 24 * 60 * 60, "/");
        setcookie("tn", '1', time() - 365 * 24 * 60 * 60, "/");
        session_destroy();
        session_start();
    }
} else {
    $id_user = $crypt->decrypt($_SESSION['c_u'], _FULL_KEY_);
    $update = new Update();
    $user = $update->get_information($id_user);
    if(!$user){
        //Si $user = false, por seguridad elimina todas las variables de sesión y cookies
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

        setcookie('c_u', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('c_p', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('_n', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('u_e', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('u_i', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('p_n', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('p_s', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie('ru', '1', time() - 365 * 24 * 60 * 60, "/");
        setcookie("rn", '1', time() - 365 * 30 * 24 * 60 * 60, "/");
        setcookie("tn", '1', time() - 365 * 24 * 60 * 60, "/");
        session_destroy();
        session_start();
    } else {
        //Si $user trae datos, actualiza las variables de sesión
        $_SESSION['c_u'] = $crypt->encrypt($user->id_user,_FULL_KEY_);
        $_SESSION['c_p'] = $crypt->encrypt($user->id_person,_FULL_KEY_);
        $_SESSION['_n'] = $crypt->encrypt($user->user_nickname,_FULL_KEY_);
        $_SESSION['u_e'] = $crypt->encrypt($user->user_email,_FULL_KEY_);
        $_SESSION['u_i'] = $crypt->encrypt($user->user_image,_FULL_KEY_);
        $_SESSION['p_n'] = $crypt->encrypt($user->person_name,_FULL_KEY_);
        $_SESSION['p_s'] = $crypt->encrypt($user->person_surname,_FULL_KEY_);
        $_SESSION['ru'] = $crypt->encrypt($user->id_role,_FULL_KEY_);
        $_SESSION['rn'] = $crypt->encrypt($user->role_name,_FULL_KEY_);
        $_SESSION['tn'] = $crypt->tripleencrypt($user->user_password, $user->id_user, $user->user_created_at);
    }
}