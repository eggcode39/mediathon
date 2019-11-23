<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 13/11/2019
 * Time: 19:26
 */
class Update{
    private $pdo;
    private $log;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }
    //Obtiene datos del usuario actual
    public function get_information($id_user){
        try{
            $sql = 'select u.id_user, u.id_person, u.user_password, u.user_created_at , u.user_nickname, u.user_email, u.user_image, p.person_name, p.person_surname, u.id_role, r.role_name from user u inner join person p on u.id_person = p.id_person inner join role r on r.id_role = u.id_role where u.id_user = ? and u.user_status = 1 limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_user]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = false;
        }
        return $result;
    }

}