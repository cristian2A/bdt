<?php
namespace Core;
use Core\DBManager as DB;

class Model
{

    public $model;

    public function __construct ()
    {
        //la conexion se realiza el constructor del padre
        //$this->db = new DB;
    }

    public function generateToken($length = 10)
    { 
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
    } 
}
