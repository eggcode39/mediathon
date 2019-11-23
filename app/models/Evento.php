<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 8:18
 */
class Evento{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function crear_evento($model){
        try{
            $sql = "insert into evento (evento_descripcion, evento_fecha, evento_hora, evento_estado) values (?,?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->evento_descripcion,
                $model->evento_fecha,
                $model->evento_hora,
                $model->evento_estado
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_evento($id_evento){
        try{
            $sql = "select * from evento where id_evento = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_evento]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_usuarios_evento($id_evento){
        try{
            $sql = "select * from evento e inner join evento_usuario eu on e.id_evento = eu.id_evento inner join user u on eu.id_user = u.id_user where eu.id_evento = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_evento]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function agregar_usuario_evento($id_evento, $id_user){
        try{
            $sql = "insert into evento_usuario (id_evento, id_user) values (?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id_evento, $id_user]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}