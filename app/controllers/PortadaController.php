<?php
use Core\Controller as Controller;
class PortadaController extends Controller
{
    public function __construct()
    {
        // Seteo el layout a usar 
        $this->layout = parent::setLayout('portada');
    }

    public function index()
    {
        /** VISTA  **/
        //puedo definir las varibles web: title / Keyword  / Description
        $this->layout->setTitle('Bolsa de Trabajo');
        $this->layout->setKeywords('Hola');
        $this->layout->setDescription('Otra descripcion');

        //cargo la vista correspondiente
        $this->layout->loadView('portada/inicio');
    }
}
