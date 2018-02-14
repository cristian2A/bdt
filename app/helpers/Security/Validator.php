<?php
namespace Security;
/**
 * Clase para Sanitizar y Validar Formularios Usuarios
 * 
 * 
 * Reglas de Validacion (propiedad)
 * Propiedad especifica a cada formulario, con formato común
 * que será utilizada en el metodo de Validación filterValidate
 *  reglas = array( "field" => { "type"=>tipo ,
 *                               "lenght"=>array long(min, max),
 *                               "required"=> true/false ,
 *                               "validate"= true/false
 *                              });
 * 
 * Descripcion:
 *  [Field] - Obligatorio
 *      Campo del formulario a validar
 *      Puede ser un array para casos de select multiples o checkbox. 
 * 
 *  [Types] - Obligatorio:
 *      string: acepta cadena de texto y numeros y caracteres especiales, sin etiquetas html
 *      email : solo acepta cadena formato email
 *      txt   : solo texto
 *      num   : string numérico     
 *      int   : enteros
 *      float : decimales     
 *      bool  : booleano: true/false - 1/0
 *   Se deberan forzaran los tipos en caso de ser necesario
 *  
 * [Lenght] - Opcional
 *  array (min=>"valor minimo", max=> "valor maximo")
 *      Para NO definir un minimo el valor deberá ser NULL;
 *      Para NO definir un maximo el valor deberá ser NULL o '';
 *  En caso de no estar definido no se aplicara el filtro
 * 
 * [Required] - Opcional
 *  hace referencia a si el campo será obligatoriamente requerido
 *  Valores: TRUE para requerido / FALSE para no requerido
 *  En caso de no estar definido se toma como FALSE
 * 
 * [Validate] - Opcional
 *  Opcion para no validar campos innecesarios.
 *  Si no está definido se toma como TRUE y se valida        
 */

class Validator
{
    
    private $rules_validation=array();
    private $form_data = array();
    public  $form_sanit =array();
    public  $form_valid =array();
    public  $fields_valid =array();
    private $control_tipo;
    private $control_length;
    private $control_required;
    private $result=array();
    private $num_fields;


    public function filterValidate($form_sanit, $rules_val)
    {
        //recibe los datos sanitizados.
        $this->form_data = $form_sanit;
        // recibe las reglas especificas de validacion.       
        $this->rules_validation= $rules_val;
        
        // Inicio contador de casos No Validos para luego informar al constructor
        $count_false = 0;

        //Recorre todos los campos validandolos de acuerdo a las reglas establecidas
        foreach ($this->form_data as $field => $value)
        {
            //No validar campos con validacion=false
            if( $this->rules_validation[$field]['validate']==false)
            {
               //descuento del total los campos que no se validan
               $this->num_fields = $this->num_fields -1;
            }
            else
            {
                // obtener las reglas de validacion
                $this->rules_validation[$field];
                // verificar campo requerido
                $this->control_required = $this->rules_validation[$field]["required"]; 
                // verificar tipo de campo 
                $this->control_type = $this->rules_validation[$field]["type"];
                // verificar longitud de la cadena
                $this->control_lenght = $this->rules_validation[$field]["lenght"];
                //Si el campo trae datos en array
                if(is_array($value))
                {
                    foreach ($value as $key => $subvalue)
                    {
                        $result_validation = self::controlValidation($field, $subvalue);
                        $this->fields_valid[$field][$key]= array("value"=>$value, $result_validation);
                    }  
                }
                elseif(is_string($value))
                {    
                    $result_validation = self::controlValidation($field, $value);
                    if($result_validation['valid']==false){ $count_false++;}

                    $this->fields_valid[$field] = $result_validation;
                }
            }
        }
        // Tenemos validado el formulario campo por campo
        // Ahora necesitamos enviar además un mensaje global del formulario: Validado o NoValidado
        if($count_false > 0){ $form_valid=false; } else { $form_valid= true; }
        
        $result =array("form"=>$form_valid , "campos"=> $this->fields_valid);
        return $result;
    }


    public function controlValidation($field, $value)
    {
        // Elimino los posibles espacios en blanco al inicio y al final de la cadena
        $value = trim($value); 
        //dentro de cada tipo valida tambien los otros requisitos
        if($this->control_type=="string")
        {
            $control1 = is_string($value);
            $control2 = self::filterMinMax($value,$this->control_lenght);
            $control3 = self::required($value, $this->control_required);
        }
        elseif($this->control_type=="email")
        {
            //completo el email frro en caso de ser necesario:
            $control1 = self::email($value);
            $control2 = self::filterMinMax($value,$this->control_lenght);
            $control3 = self::required($value, $this->control_required);
        }
        elseif($this->control_type=="emailfrro")
        {
            //completo el email frro en caso de ser necesario:
            $control1 = self::emailfrro($value);
            $control2 = self::filterMinMax($value,$this->control_lenght);
            $control3 = self::required($value, $this->control_required);
        }
        elseif($this->control_type=="pass")
        {
            //completo el email frro en caso de ser necesario:
            $control1 = self::pass($value);
            $control2 = self::filterMinMax($value,$this->control_lenght);
            $control3 = self::required($value, $this->control_required);
        }


        if($control1==true && $control2==true && $control3==true)
        {
            $result = array("value" => $value ,"valid"=> true);
        }else
        {
            if($control1==false){$cod = 1;}
            if($control2==false){$cod = 2;}
            if($control3==false){$cod = 3;}
            
            $result= array("value" => $value , "valid"=>false, "cod"=>$cod ,"c_t"=>$control1,"c_l"=> $control2, "c_r"=>$control3 );

        }
        return $result;
    }


    /** Metodo para verificar datos dentro de un intervalo */
    public function filterMinMax($value, $minmax)
    {
        $min = $minmax[0];
        $max = $minmax[1];
        $len = strlen($value);
        // Con ambos extremos
        if($minmax[0]!=NULL && $minmax[1]!=NULL)
        {
            if($len > $minmax[0] && $len < $minmax[1])
            {
                $control = true;
            }else{
                $control = false;
            }
        }
        // Solo con minimo
        elseif($minmax[0]!=NULL && $minmax[1]!=NULL)
        {   
            if( $len >= $minmax[0])
            {
                $control = true;
            }else{
                $control = false;
            }
        }
        //Solo con maximo
        elseif($minmax[1]!=NULL && $minmax[0]==NULL)
        {
            if( $len <= $minmax[1])
            {
                $control = true;
            }else{
                $control = false;
            }
        }
        //si ambos son nulos, doy por valida la comparacion
        else{ $control= true;}

        return $control;
    }


    private function required($value,$isrequired)
    {
        if($isrequired==true)
        {
            if(!isset($value) || empty($value) || is_null($value))
            {  $control = false;}
            else{ $control = true;}
        }
        //si no es requerido le doy el ok
        if($isrequired==false){ $control = true;}
        
        return $control;
    }

    private  function email ($value)
    { 
        if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $value))
        { return true; 
        } else { return false; } 
    }
    
    private  function emailfrro ($value)
    { 
        if( preg_match('/^[kvsqo][0-9]{3,6}[@frro.utn.edu.ar]*$/', $value) || 
            preg_match('/^[a-zA-Z]{3,}[@frro.utn.edu.ar]*$/', $value))
        {
            return true; 
        }
        else
        {
            return false;
        }         
    }

    private  function pass($value)
    { 
        /**
         * La contraseña debe tener al entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula. Puede tener otros símbolos.
         * ^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$
         */
        if (preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/', $value))
        { return true; 
        } else { return false; } 
    }


    public function mensajesError($campos, $cod='', $form='')
    {
        if(is_array($campos))
        {
            foreach($campos as $campo=>$value)
            {
                if($value['valid']==false)
                {
                    $cod = $value['cod'];
                    //llamar al helper error_msj()
                    $msg = msg_errors($campo, $cod); 
                    $campos_error[$campo] = $msg;
                }
            }
        }
        elseif(is_string($campos))
        {
            $campo = $campos;
            $msg = msg_errors($campo, $cod);
            $campos_error[$campo] = $msg;
        }
        return $campos_error;
    }

} 