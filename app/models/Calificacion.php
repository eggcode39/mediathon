<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 7:48
 */
class Calificacion{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function guardar_calificacion($model){
        try{
            $sql = "insert into calificacion (id_user, id_noticia, calificacion_respuesta) values (?,?,?)";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->id_user,
                $model->id_noticia,
                $model->calificacion_respuesta
            ]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_calificacion_noticia($id_noticia){
        try{
            $sql = "select * from calificacion where id_noticia = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_noticia
            ]);
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_usuario_noticia($id_noticia, $id_user){
        try{
            $sql = "select * from calificacion where id_noticia = ? and id_user = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_noticia, $id_user
            ]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }
}