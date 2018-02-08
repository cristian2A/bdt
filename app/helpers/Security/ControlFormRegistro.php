<?php    /** FORMULARIO DE REGISTRO */
namespace Security;
    
class ControlFormRegistro extends Security
{
    // Reglas de Validacion
    public $rules_v = array( 
                            "usuario" =>array( "type"=>"string", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "email" =>array("type"=>"email" , "lenght"=>array(7,50), "required"=>true, "validate"=>true),
                            "password"=>array( "type"=>"pass", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "repassword"=>array( "type"=>"pass", "lenght"=>array(3,50),"required"=>true, "validate"=>true),
                            "registro"=>array( "type"=>"string", "lenght"=>array(NULL,NULL), "required"=>true, "validate"=>false),
                            "alta"=>array( "type"=>"bool", "lenght"=>array(NULL,NULL), "required"=>true, "validate"=>false),
                            );

    public $form_result;                            




    public function filterRegistro()
    {
        // 1º Sanitizar
        $args = array(
                        'usuario'   => FILTER_SANITIZE_STRING,
                        'email'     => FILTER_SANITIZE_EMAIL,
                        'password'    => FILTER_SANITIZE_STRING,
                        'repassword'  => FILTER_SANITIZE_STRING,
                        'registro'  => FILTER_SANITIZE_STRING,
                        'alta'      => FILTER_SANITIZE_STRING,
                      );
        $form_sanit=filter_input_array(INPUT_POST, $args, $add_empty = true); 
        
        $form_validate = parent::filterValidate($form_sanit, $this->rules_v);
        
        return $form_validate;  
    }

    public function resultControl()
    {
        $filtrado = self::filterRegistro();
        //si pasa la validacion de los datos 
        if($filtrado["form"]==true)
        {   
            // faltaría verificar que pass y repass coinciden
            $p = $filtrado['campos']['password']['value'];
            $rp = $filtrado['campos']['repassword']['value'];
            if($p!=$rp)
            {
                $error_repass = array('repassword'=>msg_errors("repassord", 0));
                $this->form_result = array(
                                            'datos'=>$filtrado['campos'],
                                            'error'=>$error_repass);
            }
            else
            {
                $this->form_result =  $filtrado;
            }            
        }
        else
        {
            // añado los mensajes de error a
            $msg = parent::mensajesError($filtrado["campos"]);
            $this->form_result  = array('datos'=>$filtrado['campos'], 'error'=>$msg);
        }
        return $this->form_result;
    }
}