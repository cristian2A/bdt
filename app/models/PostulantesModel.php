<?php
namespace Model;
use Core\Model as Model;

class PostulantesModel extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function pruebaModel()
    {
        echo "Hola desde postulantes Modelo";
    }
}
?>