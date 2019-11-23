<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 11/11/2019
 * Time: 17:03
 */
class Role{
    private $pdo;
    private $log;
    public function __construct(){
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Listar Toda La Info Sobre Roles de Usuario
    public function listAll(){
        try{
            $sql = 'select * from role';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    //Listar Roles sin SuperUsuario
    public function listAll_wsu(){
        try{
            $sql = 'select * from role where id_role <> 2';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    //Guardar o Editar Informacion de Role
    public function save($model){
        try {
            if(empty($model->id_role)){
                $sql = 'insert into role(
                    role_name, role_description
                    ) values(?,?)';
                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->role_name,
                    $model->role_description
                ]);

            } else {
                $sql = "update role
                set
                role_name = ?,
                role_description = ?
                where id_role = ?";

                $stm = $this->pdo->prepare($sql);
                $stm->execute([
                    $model->role_name,
                    $model->role_description,
                    $model->id_role
                ]);
            }
            $result = 1;
        } catch (Exception $e){
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    //Listar Un Unico Rol por ID
    public function list_all($id){
        try{
            $sql = 'select * from role where id_role = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    //Listar Todos Los Menus Del Sistema
    public function listAllMenu(){
        try{
            $sql = 'select * from menu';
            $stm = $this->pdo->prepare($sql);
            $stm->execute();
            $result = $stm->fetchAll();

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = [];
        }
        return $result;
    }
    //Listar Todos Los Menus Del Sistema
    public function SearchRelationship($id_role, $id_menu){
        try{
            $sql = 'select * from rolemenu where id_role = ? and id_menu = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_role,
                $id_menu
            ]);
            $total = $stm->fetchAll();
            if(count($total) != 0){
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
    public function AddRelationship($id_role, $id_menu){
        try{
            $sql = 'insert into rolemenu (id_role, id_menu) values (?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_role,
                $id_menu
            ]);
            $result = 1;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    public function DeleteRelationship($id_role, $id_menu){
        try{
            $sql = 'delete from rolemenu where id_role = ? and id_menu = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $id_role,
                $id_menu
            ]);
            $result = 1;

        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
    //Borrar un Registro
    public function delete($id){
        try{
            $sql = 'delete from role where id_role = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = 1;
        } catch (Exception $e){
            $this->log->insert($e->getMessage(), get_class($this).'|'.__FUNCTION__);
            $result = 2;
        }
        return $result;
    }
}

