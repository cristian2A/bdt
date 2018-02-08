<?php
use Core\Controller as Controller;


class UsuariosController extends Controller
{
    public $usuario = '';
    public $email  = "";
    public $estado = FALSE;
    public $form_validation;

    public $section='';

    public function __construct()
    {

       // $this->validation = new Security;

        /** Instanciar llamar Modelo */
        $this->model = $this->loadModel('UsuariosModel');

        // Seteo el layout a usar 
        // En este metodo se instancia la clase Layout
        $this->layout = parent::setLayout('postulantes');

    }

    public function index()
    {
       // Metodo por defecto
       echo "<h1>HOLA MUNDO USUARIO</h1>";
    }
    

    /**
     *  Metodo para setear la Seccion: 
     * 
     * POSTULANTES / EMPRESAS / SAU
     * 
     */
    public function setSection($section)
    {
        $this->section = $section;
    }


    /**  Login
     *   Recibe datos de logueo:
     *   Usuario / Email
     *   Password
     *   $seccion define si es postulante o empresa
     */
    public function login()
    {
        //incorporo la seccion a los datos a enviar a la vista
        // En el manejador de vistas existe por defecto una variable "$seccion=postulantes".
        $result['seccion'] = $this->section;

        if(isset($_POST['ingresar']))
        {
            require_once '../app/helpers/Security/ControlFormLogin.php';
            $this->form_validation = new Security\ControlFormLogin();
            $result = $this->form_validation->resultControl($this->section);
            
            $user = $result['campos']['usuario']['value'];
            $pass = $result['campos']['password']['value'];

            if(isset($result['error']))
            {
                self::formLogin($result);
            }
            if(!isset($result['error']))
            {

                $login = $this->model->checkLogin($user, $pass);
                if($login==true)
                {
                    $this->redirect($this->section.'/panel');
                    exit();

                }else{
                    // Es necesario cargar el error de usuario/password incorrectos
                    $result['form'] = false;
                    $error_credenciales= msg_errors('usuario', 0);
                    $form_result = array(
                        'datos'=>$result['campos'],
                        'error'=>$error_credenciales);
                         
                    self::formLogin($form_result);
                }
                
            }
        }else{
            //Si no fue enviado el formulario
            $data = array('seccion'=>$this->section);
            self::formLogin($data);
        }
    }
    public function formLogin($datos=array())
    {   
        $this->layout->loadView('usuarios/'.$this->section.'/login', $datos );
    }





    public function recuperarPass()
    {
        if(isset($_POST['recuperar']))
        {
        
            require_once '../app/helpers/Security/ControlFormRecuPass.php';
            $this->form_validation = new Security\ControlFormRecuPass();
            $result = $this->form_validation->resultControl();
       
            $result['seccion'] = $this->section;
            if(isset($result['error']))
            {
                self::formLogin($result);

            }
            if(!isset($result['error']))
            {
                $user = $result['campos']['usuario']['value'];
                $pass = $result['campos']['password']['value'];
                $login = $this->model->checkLogin($user, $pass);
                if($login==true)
                {
                    $this->redirect($this->section);
                    exit();

                }else{
                    // Es necesario cargar el error de usuario/password incorrectos
                    $result['form'] = false;
                    $error_credenciales= msg_errors('usuario', 0);
                    $form_result = array(
                        'datos'=>$result['campos'],
                        'error'=>$error_credenciales);
                         
                    self::formLogin($form_result);
                }
                
            }
        }else{
            //Si no fue enviado el formulario
            $data = array('seccion'=>$this->section);
            self::formLogin($data);
        }
    }
















    /**
     * Recibira datos POST
     *
     * Ejemplo de la respuesta de la validacion
     *  array {["form"]=> bool(false) 
     *         ["campos"]=> array{ ["usuario"]=> array{ ["value"]=> string(8) "cristian"
     *                                                  ["valid"]=> bool(true) }
     *                              ["email"]=> array{  ["value"]=> string(18) "cristian.aguillonm"
     *                                                  ["valid"]=> bool(false)
     *                                                  ['cod'] =>int(2)
     *                                                  ["c_t"]=> bool(false)
     *                                                  ["c_l"]=> bool(true)
     *                                                  ["c_r"]=> bool(true) }}}
     *
     */           
    public function registrarse()
    {   
        if( isset($_POST['alta']) && $_POST['alta']== TRUE )
        {
            require_once '../app/helpers/Security/ControlFormRegistro.php';
            $this->form_validation = new Security\ControlFormRegistro();
           // var_dump($this->form_validation);
            $result = $this->form_validation->resultControl();

            if(isset($result['error']))
            {
                self::formRegistro($result);
            }
            else{
                echo "Ahora a guardar los datos";
            }

        }else{
            self::formRegistro();
        }
        $_POST['alta']=false;

    }



    public function formRegistro($datos=array())
    {   
        $this->layout->loadView('usuarios/registro', $datos, true );
    }


    public function listarUsuarios()
    {
        $usuarios = $this->model->listarUsuarios();
    }




    public function logOut()
    {
        session_unset();
        session_destroy(); 
        session_start();
        session_regenerate_id(true);
    }

    /** Metodo que determina si el usuario está conectado o no */
    public function estado()
    {
        //Control de login
        if(isset($_SESSION['USUARIO']))
        {
            return true;            
        }else
        {
            return false;
        }
    }


    /*
    public function security()
    {
        header("Expires: Tue, 01 Jul 2001 06:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");

        $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
        $_SESSION['SKey'] = uniqid(mt_rand(), true);
        $_SESSION['IPaddress'] = self::getRealIP();
        $_SESSION['LastActivity'] = $_SERVER['REQUEST_TIME'];

    }

    function getRealIP()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
        return $_SERVER['HTTP_CLIENT_IP'];
        
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
        
        return $_SERVER['REMOTE_ADDR'];
    }
    */




   

}
?>