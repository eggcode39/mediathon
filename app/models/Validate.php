<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/08/2019
 * Time: 11:56
 */
class Validate{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    //Validate if does not another nickname like this
    public function user($nickname){
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
    //Validate if does not another nickname like this if the user is editing his/her nickname
    public function nickname_by_id($id){
        try{
            $sql = 'select user_nickname from user where id_user = ?';
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
    //Validate if does not another email like this if the user is editing his/her email
    public function email_by_id($id){
        try{
            $sql = 'select user_email from user where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $re = $stm->fetch();
            $result = $re->user_email;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = "";
        }
        return $result;
    }
    //Validate if does not another dni like this
    public function dni($dni){
        try{
            $sql = 'select * from person where person_dni = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$dni]);
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
    //Validate if does not another email like this
    public function email($email){
        try{
            $sql = 'select * from user where user_email = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$email]);
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
    //Get Password of User
    public function password($id){
        try{
            $sql = 'select user_password from user where id_user = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $re = $stm->fetch();
            $result = $re->user_password;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = "";
        }
        return $result;
    }
}