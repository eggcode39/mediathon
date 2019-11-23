<?php
/**
 * Created by PhpStorm
 * User: CESARJOSE39
 * Date: 12/08/2019
 * Time: 9:56
 */
class Person
{
    private $log;
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
        $this->log = new Log();
    }

    //Create Person
    public function create($model)
    {
        $date_now = date("Y-m-d H:i:s");
        try {
            $sql = 'insert into person (person_name, person_surname, person_dni, person_birth, person_number_phone, person_genre, person_address, person_city, person_country, person_created_at, person_modified_at) values (?,?,?,?,?,?,?,?,?,?,?)';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->person_name,
                $model->person_surname,
                $model->person_dni,
                $model->person_birth,
                $model->person_number_phone,
                $model->person_genre,
                $model->person_address,
                $model->person_city,
                $model->person_country,
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

    //Edit Person
    public function edit($model)
    {
        $date_now = date("Y-m-d H:i:s");
        try {
            $sql = 'update person set
            person_name = ?,
            person_surname = ?,
            person_number_phone = ?,
            person_genre = ?,
            person_address = ?,
            person_city = ?,
            person_country = ?,
            person_modified_at = ?
            where id_person = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->person_name,
                $model->person_surname,
                $model->person_number_phone,
                $model->person_genre,
                $model->person_address,
                $model->person_city,
                $model->person_country,
                $date_now,
                $model->id_person
            ]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Edit Person Especial
    public function edit_p($model)
    {
        $date_now = date("Y-m-d H:i:s");
        try {
            $sql = 'update person set
            person_name = ?,
            person_surname = ?,
            person_birth = ?,
            person_number_phone = ?,
            person_genre = ?,
            person_address = ?,
            person_modified_at = ?
            where id_person = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->person_name,
                $model->person_surname,
                $model->person_birth,
                $model->person_number_phone,
                $model->person_genre,
                $model->person_address,
                $date_now,
                $model->id_person
            ]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Select User By Dni
    public function list_by_dni($dni)
    {
        try {
            $sql = 'select * from person where person_dni = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$dni]);
            $resultado = $stm->fetch();
            $result = $resultado->id_person;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 0;
        }
        return $result;
    }

    //Delete Person By Dni
    public function delete_person_by_dni($id)
    {
        try {
            $sql = 'delete from person where person_dni = ?';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = true;
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = false;
        }
        return $result;
    }

    //Listar Toda La Info Sobre Una Persona
    public function list_all($id)
    {
        try {
            $sql = 'select * from person where id_person = ? limit 1';
            $stm = $this->pdo->prepare($sql);
            $stm->execute([$id]);
            $result = $stm->fetch();
        } catch (Exception $e) {
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = [];
        }
        return $result;
    }

    //Guardar o Editar Informacion de Role
    public function savei($model)
    {
        try {
            $sql = "update person
                set
                person_name = ?,
                person_surname = ?,
                person_birth = ?,
                person_number_phone = ?,
                person_genre = ?,
                person_address = ?
                where id_person = ?";

            $stm = $this->pdo->prepare($sql);
            $stm->execute([
                $model->person_name,
                $model->person_surname,
                $model->person_birth,
                $model->person_number_phone,
                $model->person_genre,
                $model->person_address,
                $model->id_person,
            ]);
            //Variable creada cuando un usuario propio edita sus datos
            unset($_SESSION['id_personeinfo']);
            $result = 1;
        } catch (Exception $e) {
            //throw new Exception($e->getMessage());
            $this->log->insert($e->getMessage(), get_class($this) . '|' . __FUNCTION__);
            $result = 2;
        }
        return $result;
    }

    //Listar Toda La Info Sobre Personas
    public function listAll(){
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