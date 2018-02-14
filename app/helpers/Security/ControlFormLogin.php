<?php    /** FORMULARIO DE REGISTRO */
namespace Security;
    
/**
 * PROPIEDAS Y METODOS PARA CONTROLAR LO QUE VIENE DESDE EL FORMULARIO LOGIN
 * NOTA: 
 *      usuario será del tipo EMAIL, pero para los postulantes 
 *      se permitirá solo poner la primera parte del correo institucional
 *      por lo cual usuario se filtrará como string.
 *      Luego se verificará si es una cuenta de correo @frro.utn.edu.ar
 * 
 */
class ControlFormLogin extends Validator
{
    // Reglas de Validacion Postulantes
    public $rules_p = array( 
                            "usuario" =>array( "type"=>"emailfrro", "lenght"=>array(3,20), "required"=>true, "validate"=>true),
                            "password"=>array( "type"=>"string", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "ingresar"=>array( "type"=>"string", "lenght"=>array(NULL,NULL), "required"=>true, "validate"=>false)
                            );

    // Reglas de Validacion Empresas    
    
    public $rules_e = array( 
                            "usuario" =>array( "type"=>"email", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "password"=>array( "type"=>"string", "lenght"=>array(3,50), "required"=>true, "validate"=>true),
                            "ingresar"=>array( "type"=>"string", "lenght"=>array(NULL,NULL), "required"=>true, "validate"=>false)
                            );
    
    public $form_result;                            

    public function filterLogin($section)
    {
        // 1º Sanitizar
        if($section=='postulantes' || $section='adminsau')
        {
            $args = array(
                'usuario'   => FILTER_SANITIZE_STRING,
                'password'    => FILTER_SANITIZE_STRING,
                'ingresar'      => FILTER_SANITIZE_STRING,
            );
            $form_sanit=filter_input_array(INPUT_POST, $args, $add_empty = true);
            $form_validate = parent::filterValidate($form_sanit, $this->rules_p);

        }elseif($section=='empresas')
        {
            $args = array(
                        'usuario'   => FILTER_SANITIZE_EMAIL,
                        'password'    => FILTER_SANITIZE_STRING,
                        'ingresar'      => FILTER_SANITIZE_STRING,
                      );
            $form_sanit=filter_input_array(INPUT_POST, $args, $add_empty = true); 
            $form_validate = parent::filterValidate($form_sanit, $this->rules_e);
        }
        
        return $form_validate;  
    }

    public function resultControl($section)
    {
        $filtrado = self::filterLogin($section);
        //si pasa la validacion de los datos 
        if($filtrado["form"]==true)
        {   
            $this->form_result =  $filtrado;
        }
        else
        {
            /**
             *  De este formulario solamente se informará de los siguiente errores:
             *  - error general login de usuario/contraseña no validos
             */
            $msg['form_login']= msg_errors('form_gral', 1);

            if( $filtrado['campos']['usuario']['valid']==false)
            {
                if($filtrado['campos']['usuario']['c_r']==false)
                {
                    $msg ['usuario']= msg_errors('usuario',3);
                    $msg['form_login']= msg_errors('form_gral', 1);
                }
                else
                {
                    $msg ['form_login'] = msg_errors('form_login', 1);
                }
            }
            
            if( $filtrado['campos']['password']['valid']==false)
            {
               if($filtrado['campos']['password']['c_r']==false)
                {
                    $msg['password'] =  msg_errors('password',3);
                    $msg['form_login']= msg_errors('form_gral', 1);
                }
                else
                {
                    $msg ['form_login'] = msg_errors('form_login', 1);
                }
            }

            $this->form_result  = array('datos'=>$filtrado['campos'], 'error'=>$msg);
           
        }
        return $this->form_result;   
    }


}