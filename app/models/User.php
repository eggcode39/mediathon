<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 10/08/2019
 * Time: 19:41
 */
class User
{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Create New Users
    public function create($model)
    {
        $date_now = date("Y-m-d H:i:s");
        try {
            $sql = 'insert into user (id_person, id_role, user_nickname, user_password, user_email, user_image, user_status, user_created_at, user_last_login, user_modified_at) values (?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_person,
                $model->id_role,
                $model->user_nickname,
                $model->user_password,
                $model->user_email,
                $model->user_image,
                1,
                $date_now,
                $date_now,
                $date_now
            ]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Edit Users
    public function edit($model)
    {
        $date_now = date("Y-m-d H:i:s");
        try {
            $sql = 'update user set
            user_nickname = ?,
            user_email = ?,
            id_role = ?,
            user_status = ?,
            user_modified_at = ?
            where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_nickname,
                $model->user_email,
                $model->id_role,
                $model->user_status,
                $date_now,
                $model->id_user
            ]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Enable User
    public function enable($id_user)
    {
        try {
            $sql = 'update user set user_status = 1 where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_user]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Disable User
    public function disable($id_user)
    {
        try {
            $sql = 'update user set user_status = 0 where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_user]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //List Users (Disable For The Moment)
    /*public function list_all()
    {
        try {
            $sql = 'select * from user u inner join person p on u.id_person = p.id_person';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }*/
    //List User
    public function list($id_user){
        try{
            $sql = 'select 
                    u.id_user, u.id_person, u.user_nickname, u.user_email, u.user_image, u.user_status, u.user_last_login, u.user_modified_at, 
                    p.person_name, p .person_surname, p.person_dni, p.person_birth, p.person_number_phone, p.person_genre, p.person_address, p.person_city, p.person_country
                    from user u inner join person p on u.id_person = p.id_person where id_user = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_user]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    //Change Password
    public function change_password($model){
        try{
            $sql = 'update user set user_password = ? where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_password,
                $model->id_user
            ]);
            $result = true;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = false;
        }
        return $result;
    }
    //Change User Image
    public function change_image($id_user, $user_image){
        try{
            $sql = 'update user set user_image = ? where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $user_image,
                $id_user
            ]);
            $result = true;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Listar Un Unico Usuario por ID
    public function list_all($id){
        try{
            $sql = 'select * from user where id_user = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function selectNickname($id){
        try{
            $sql = 'select user_nickname from user u where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $re = $stm->fetch();
            $result = $re->user_nickname;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = "";
        }
        return $result;
    }

    public function validateUser($nickname){
        try{
            $sql = 'select * from user u where user_nickname = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$nickname]);
            $re = $stm->fetchAll();
            if(count($re) > 0){
                $result = true;
            } else {
                $result = false;
            }

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = false;
        }
        return $result;
    }
    //Cambiar Estado de Un Usuario
    public function changestatus($model){
        try {
            $sql = 'update user set
                user_status = ?
                where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_status,
                $model->id_user
            ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    //Identificar rol de usuario
    public function get_role($id_user){
        try{
            $sql = 'select u.id_role from user u inner join role r on u.id_role = r.id_role where u.id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_user]);
            $result1 = $stm->fetch();
            $result = $result1->id_role;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result;
    }
    //Cambiar Contraseña de un Usuario
    public function changepassword($model){
        try {
            $sql = 'update user set
                user_password = ?
                where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->user_password,
                $model->id_user
            ]);
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    //Obtener DNI Usuario
    public function getDni($id){
        try{
            $sql = 'select person_dni from user u inner join person p on u.id_person = p.id_person where u.id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 0;
        }
        return $result->person_dni;
    }

    public function sessionclose(){
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
            $okey = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $okey = 2;
        }
        return $okey;
    }
}