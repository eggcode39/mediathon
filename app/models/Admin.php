<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 9:46
 */
class Admin{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function contar_noticias(){
        try{
            $sql = "select count(id_noticia) total from noticias where noticia_estado = 1";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }
}