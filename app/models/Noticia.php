<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 23/11/2019
 * Time: 3:54
 */
class Noticia{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    public function guardar_noticia($model){
        try{
            if(isset($model->id_noticia)){
                $sql = "update noticias set
                    noticia_titulo = ?,
                    noticia_contexto = ?,
                    noticia_bajada = ?,
                    noticia_estado = ?,
                    noticia_mostrar = ?,
                    noticia_link = ?,
                    noticia_esfake = ?,
                    noticia_motivo = ?
                    where id_noticia = ?";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->noticia_titulo,
                    $model->noticia_contexto,
                    $model->noticia_bajada,
                    $model->noticia_estado,
                    $model->noticia_mostrar,
                    $model->noticia_link,
                    $model->noticia_esfake,
                    $model->noticia_motivo,
                    $model->id_noticia
                ]);
                $result = 1;
            } else {
                $sql = "insert into noticias (noticia_titulo, noticia_contexto, noticia_bajada, noticia_link, noticia_esfake, noticia_motivo, noticia_estado, noticia_mostrar) values (?,?,?,?,?,?,?,?)";
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->noticia_titulo,
                    $model->noticia_contexto,
                    $model->noticia_bajada,
                    $model->noticia_estado,
                    $model->noticia_mostrar,
                    $model->noticia_link,
                    $model->noticia_esfake,
                    $model->noticia_motivo
                ]);
                $result = 1;
            }
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function listar_noticias(){
        try{
            $sql = "select * from noticias";
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }

    public function listar_noticia($id){
        try{
            $sql = "select * from noticias where id_noticia = ?";
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
}