<?php
namespace Core;

class Layout 
{

    //Propiedad
    public $layout = ''; //layout a utilizar / por defecto
    
    public $title = "Bolsa de Trabajo";
    public $description ="Bolsa de Trabajo de la UTN ROSARIO";
    public $keywords  = "Bolsa de Trabajo, Laboral, UTN"; 
    
    public $css = "";
    public $js = "";

    public $view = 'index'; // vista a utilizar

    public $datos_v = []; //datos a enviar a la vista

	public function __construct( $layout = LAYOUT_DEFAULT)
	{
        $this->layout	= $layout;
	}   


    
	/**
	 * Retorna o renderea una vista dentro de un layout
	 *
	 * @param	string		$view			Nombre de la vista a procesar
	 * @param	array		$data			Datos que se enviaran a la vista
	 * @param	boolean		$return			Determina si una vista debe ser devuelta o rendereada directamente
	 * @return	string						Si se pasa $return en true, devuelve el contenido de la vista
	 */
    public function loadView($view = 'index', $datos_v = array(), $layout = true)
    {
        $ruta_vista = '../app/views/'.$view.'.php';
        if(file_exists($ruta_vista))
        {  

            // CSS y JS
            self::getCSS();
            self::getJS();

            //Manejo de datos
            if(isset($datos_v) && !empty($datos_v))
            {
                $user = $datos_v['usuario']??'';
                $datos = $datos_v['datos']??'';
                $error = $datos_v['error']??'';
                $seccion = $datos_v['seccion']??'postulantes';
            }
            else{
                $user = [];
                $datos = [];
                $error = '';
                $seccion = '';
            }

            //defino si uso o no un layout
            if($layout == false)
            {
                require_once $ruta_vista; // renderiza la vista sola (para ajax)
            }
            else{
                //renderiza la vista dentro del layout
                $carga_layout = '../app/views/layouts/'.$this->layout.'Layout.php';
                $this->view  =  $ruta_vista;
                require_once $carga_layout;
            }
        }else{
            die('la vista no existe');
        }
    }



	/**
     * Metodos de gestion de parametros HTML
     * Se llamaran desde la vista a traves del metodo get correspondiente
     * 
     */

    public function setTitle($title)
	{
		$this->title = $title;
	}
	public function setKeywords($keywords)
	{
		$this->keywords = $keywords;
	}
	public function setDescription($description)
	{
		$this->description = $description;
	}
    
    public function getTitle()
	{
		return $this->title;
	}	
	public function getKeywords()
	{
		return $this->keywords;
	}
	public function getDescription()
	{
		return $this->description;
    }
    
    /**
     * Metodos de gestion de asset para  el HTML
     * - Hojas de estilos especifcas de la vista. $css = [];
     *     Origen 0 => local |  1 => externo
     * - Script JS especificas de la vista js = [];
     *  Origen 0 => local |  1 => externo
     */
    public function loadCSS($css_v, $origen=0)
    {        
        if($origen == 0)
        {
            $href = url_base()."css/".$css_v; //archivo local
        }
        else
        {
            $href= $css_v;    // archivo externo
        }
        $this->css .= '<link rel="stylesheet" type="text/css" href="'.$href.'" />
    '; //para que el siguiente quede debajo en el html y no en la misma linea

        return $this->css;
    }
    
    public function getCSS()
    {
        return $this->css;
    }

    public function loadJS($js_v, $origen = 0)
    {
        //<script src="main.js"></script>
        if($origen == 0)
        {
            $src = url_base()."js/".$js_v; //archivo local
        }
        else
        {
            $src= $js_v;    // archivo externo
        }
        $this->js .= '<script src="'.$src.'" /></script>
    '; //para que el siguiente quede debajo en el html y no en la misma linea

        return $this->js;
    }
    public function getJS()
    {
        return $this->js;
    }







    /**
     * 
     * Metodos para formatear los datos en dos variables
     * Datos de Sesion de Usuario -> $usuario
     * Datos de la app a pasar a la vista -> $datos[]
     * 
     */

    public function prepareUsuario()
    {
        if(isset($this->datos_v['usuario']) && !empty($this->datos_v['usuario']))
        {
            $usuario = $this->datos_v['usuario'];
        }else{
            $usuario = [];
        }
        return $usuario;
    }
    public function prepareDatos()
    {
        if(isset($this->datos_v['vista']) && !empty($this->datos_v['vista']))
        {
            $datos = $this->datos_v['vista'];
        } else {
            $datos = [];
        }
        return $datos;
    }


}
