<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 1:08
 */
class Person{
    private $pdo;
    private $log;
    public function __construct(){
        $this->log = new Log();
        $this->pdo = Database::getConnection();
    }
    //Listar Personas
    public function listar_personas(){
        try{
            $sql = 'select * from person';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}