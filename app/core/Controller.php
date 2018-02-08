<?php
namespace Core;

// Esta clase se encargar de cargar Modelos y Vistas
class Controller
{
    
    public $model;

    //Cargar modelos
    public function loadModel($mod)
    {
        $ruta_model = '../app/models/'. $mod . '.php';
        if(file_exists($ruta_model))
        {             
            require_once $ruta_model;
            $model_name = "Model\\".$mod;
            // instanciamos el modelo solicitado
            $this->model = new $model_name ();
            return $this->model;
        }
        else{
            die('Modelo no valido');
        }
    }
    
    //Cargar layout
    /**
     * Metodo para iniciar la carga del Layout
     * Instancia la clase Layout que es donde se gestiona la vista
     * se insertan la vista y los parametros.
     */
    public function setLayout($layout)
    {
        $ruta_layout = '../app/views/layouts/'.$layout.'.php';
        if(!file_exists($ruta_layout))
        { 
            //cargo el layout por defecto
            $layout= LAYOUT_DEFAULT;       
        }
        // die('layout no valido');
        return new Layout($layout);
    }


    public function redirect($url){
        header("Location:".BASE_LINK.$url);
        exit();
    }

}
