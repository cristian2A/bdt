<?php    /** FORMULARIO DE REGISTRO */
namespace Security;
    
class ControlFormRecuPass extends Validator
{
    // Reglas de Validacion
    public $rules_v = array( 
                            "usuario" =>array( "type"=>"string", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "password"=>array( "type"=>"string", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "ingresar"=>array( "type"=>"string", "lenght"=>array(NULL,NULL), "required"=>true, "validate"=>false),
                            );

    public $form_result;                            




    public function filterLogin()
    {
        // 1º Sanitizar
        $args = array(
                        'usuario'   => FILTER_SANITIZE_STRING,
                        'password'    => FILTER_SANITIZE_STRING,
                        'ingresar'      => FILTER_SANITIZE_STRING,
                      );
        $form_sanit=filter_input_array(INPUT_POST, $args, $add_empty = true); 
        
        $form_validate = parent::filterValidate($form_sanit, $this->rules_v);
        
        return $form_validate;  
    }

    public function resultControl()
    {
        $filtrado = self::filterLogin();
        //si pasa la validacion de los datos 
        if($filtrado["form"]==true)
        {   
            $this->form_result =  $filtrado;
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