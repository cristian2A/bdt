<?php
namespace Core;
/* Mapear la url ingresada */
/*
* 1 -> Seccion
* 2 -> Controlador 
* 3 -> Metodo
* 4 -> Parametros
*/

class App 
{
    protected $controlador_actual = CONTROLLER_DEFAULT;
    protected $metodo_actual = METODO_DEFAULT;
    protected $parametros = array();

    public function __construct()
    {
        //Obtengo la url
        $url = $this->getUrl();
       
        /** COTNROLADORES  **/
        //armo la ruta para verificar que exista el archivo
        $ruta_controlador = '../app/controllers/'. ucwords($url[0]).'Controller.php';
        if ( file_exists($ruta_controlador))
        {
            //si existe armo el nombre del controlador= nombreController
            $this->controlador_actual = ucwords($url[0]).'Controller';
            
            // unset indice
            unset($url[0]);
        }
        
        //requiero el controlador actual
        //armo la ruta de controlador actual
        $ruta_controlador_actual = '../app/controllers/'.$this->controlador_actual.'.php';
        require_once $ruta_controlador_actual;
        //Instancio el controlador actual
        $this->controlador_actual = new $this->controlador_actual;

        /** METODOS **/
        // si fue seteada la segunda parte de la url
        //compruebo que exista un metodo dentro del controlador actual
        if(isset ($url[1]))
        {
            if(method_exists($this->controlador_actual, $url[1]))
            {
                //si existe lo seteo como actual
                $this->metodo_actual= $url[1];
                
                // unset indice
                unset($url[1]);
            }
        }
        
        //echo $this->metodo_actual;


        /** PARAMETROS **/
        $this->parametros = $url ? array_values($url):[''];
        //var_dump($this->parametros);
        //llamar callback
        call_user_func_array( [$this->controlador_actual,$this->metodo_actual], array($this->parametros));

    }


    public function getUrl()
    {
        /*
            La ruta al controlador es:
            ../app/controllers/controladorController.php
        */
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url']);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode ('/', $url);
            return $url;
        }

    }
    
}