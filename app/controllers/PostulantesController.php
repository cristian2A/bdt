<?php
use Core\Controller as Controller;
use UsuariosController as Usuarios;


class PostulantesController extends Controller
{
       
    public $layout = '';
    public $usuario = array();
    public $datos = [];
    public $db;
    public $model;
    public $load_model;
    public $seccion = 'postulantes';

    public function __construct()
    {  
        // Seteo el layout a usar 
        // En este metodo se instancia la clase Layout
        $this->layout = parent::setLayout('postulantes');

        //Control de Usuarios
        $this->usuario = new Usuarios;
        $this->usuario->setSection('postulantes');
        //obtengo los datos en un array y los paso a la variable a enviar a la vista

        $this->datos['usuario'] = array("legajo"=>"154397", "nombre"=>"Cristian Aguillón");

        //seteo datos especificos de las vistas
        //$this->datos['vista']=[];
    }

    public function index()
    {
        /** VISTA  **/
        /** Parametros WEB */
        $this->layout->setTitle('Bolsa de Trabajo: Inicio');
        $this->layout->setKeywords('Bolsa de Trabajo, Empleo, Inserción Laboral, Pasantías');
        $this->layout->setDescription('Sistema Virtual de Búsqueda de Empleo de la UTN Rosario, Secretaría de Asuntos Universitarios.');

        $this->datos['vista'] = array("dato1" =>"Primer dato","dato2" =>"Segundo dato");

        /** CSS */
        //$this->layout->loadCSS("estilos.css", 0);       
        
        /** JS */
        $this->layout->loadJS("funciones.js");
        $this->layout->loadJS("main.js");
    
      // $this->layout->loadJS("https://ajax.googleapis.com/ajax/libs/dojo/1.13.0/dojo/dojo.js",1);
                
        //cargo la vista correspondiente
        // loadView($view = 'index', param_web = [], $datos = [], $layout = true)
        $this->layout->loadView('postulantes/inicio', $this->datos );
    }

    

    public function panel()
    {   
        self::controlAcceso();
        /** VISTA  **/
        /** Parametros WEB */
        $this->layout->setTitle("Bolsa de Trabajo: Búsquedas");
        $this->layout->loadView('postulantes/panel', $this->datos);
    }



    public function busquedas()
    {   
        self::controlAcceso();
        /** VISTA  **/
        /** Parametros WEB */
        $this->layout->setTitle("Bolsa de Trabajo: Búsquedas");
        $this->layout->loadView('postulantes/busquedas', $this->datos);
    }

    public function postulaciones()
    {
        self::controlAcceso();
        $this->layout->loadView('postulantes/postulaciones',$this->datos);
    }

    public function miCV()
    {
        self::controlAcceso();
        $crear = $this->usuario->registrarse();
        $this->layout->loadView('postulantes/micv', $this->datos);
    }
    
    public function clasificados()
    {
        self::controlAcceso();
        $crear = $this->usuario->registrarse();
        $this->layout->loadView('postulantes/clasificados', $this->datos);
    }

    public function reglamentaciones()
    {
        self::controlAcceso();
        $crear = $this->usuario->registrarse();
        $this->layout->loadView('postulantes/reglamentaciones', $this->datos);
    }






    

    
    /** Metodos para ingresar a Area Usuario sin necesidad de redireccionar
     * ni de cambiar la url a usuarios/login etc.
     * 
     * */
    public function registrarse()
    {
        self::controlAcceso();
        $this->usuario->registrarse(); 
    }

    public function login()
    {
        $this->usuario->login('postulantes');
    }

    function salir()
    {
        $this->usuario->logOut();
        $this->redirect("postulantes/login");
    }

    function controlAcceso()
    {
        if(!isset($_SESSION['USER']) || empty($_SESSION['USER']['USUARIO']))
        {
           
            $this->redirect('postulantes/login');
           exit();
        }
    }
    function recuperarPass()
    {       
        $this->usuario->recuperarPass('postulantes');
    }
    
}