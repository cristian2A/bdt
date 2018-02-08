<?php
namespace Core;

use \PDO as PDO;

/**
 * Autor: https://victorroblesweb.es/2014/07/15/ejemplo-php-poo-mvc/
 */
 
class DBManager extends PDO
{
    private $db_motor = DB_MOTOR;
    private $db_host = DB_HOST;
    private $db_name = DB_NAME;
    private $db_user = DB_USER;
    private $db_pass = DB_PASS;
    

    private $dbh;
    private $stmt;
    private $error;
    private $table;

    public function __construct()
    {
        $dns = $this->db_motor.':host='.$this->db_host.';dbname='.$this->db_name;
        $options = array(   PDO::ATTR_PERSISTENT=>true,
                            PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION);
        try{
        //Establecer conexion con base de datos
        $this->dbh = new PDO($dns , $this->db_user, $this->db_pass, $options);
        $this->dbh->exec('set names utf8');
        return $this->dbh;
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo $this->error;
            die();
        }
    }

    //preparamos la consulta
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
        //var_dump($this->stmt);
    }
    //vinculamos la consulta
    public function bindP($param, $value, $type=null)
    {
        if(is_null($type))
        {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;               
                default:
                    $type = PDO::PARAM_STR;
                    break;
            }
            return $this->stmt->bindValue($param, $value, $type);
        }
    }
    //ejecutamos la consulta
    public function execute()
    {        
        try{
            return $this->stmt->execute();
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
                die();
            }
    }

    public function resultAll()
    {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function resultSet()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }



    public function rowCount()
    {
        $this->execute();
        return $this->stmt->rowCount();
    }



    public function getById($table, int $id){
        $query = self::query("SELECT * FROM $this->table WHERE id=$id");
 
        if($row = $query->fetch()) {
           $resultSet=$row;
        }
        return $resultSet;
    }
     
    public function getBy($column,$value){
        $query=$this->db->query("SELECT * FROM $this->table WHERE $column='$value'");
 
        while($row = $query->fetchObject()) {
           $resultSet[]=$row;
        }
        return $resultSet;
    }
     
    public function deleteById($id){
        $query=$this->db->query("DELETE FROM $this->table WHERE id=$id"); 
        return $query;
    }
     
 
    public function disconnect()
    {
        unset($_REQUEST);
        $this->db = '';
    }

}
?>