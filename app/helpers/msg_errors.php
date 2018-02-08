<?php


function msg_errors($name, $nro)
{

/** Formularios de Usuario
 * array de errores por cada campo correspondiente al formulario
 * Ej: FORM Registro:
 * usuario | email| password | repassword | 
 * Los campos ocultos de los cuales no informaremos de errores
 * El indice indica el tipo de control.
 * [1] => Control1 => control de tipo
 * [2] => Control2 => control de longitud/cant de caracteres (min-max)
 * [3] => Control3 => control de campo requerido
 * Obs.: Otros indice a indicar tipo de control manuales
 */
    $error['general'][0] = "El usuario y/o contraseña no son válidos"; // para Login
    $error['usuario'][1] = "El usuario no es válido"; //solo para registro
    $error['usuario'][2] = "El usuario debe contener al menos 5 caracteres";
    $error['usuario'][3] = "Por favor ingrese su usuario";

    $error['email'][1] = "Debe ingresar un email válido";

    $error['password'][1] = "La contraseña debe contener letras minuscula, mayusculas y números";
    $error['password'][2] = "La contraseña debe contener al menos 6 caracteres";
    $error['password'][3] = "Por favor ingrese su contraseña";
    $error['repassword'][1] = "La contraseña debe contener letras minuscula, mayusculas y números";
    $error['repassord'][0] = "No coinciden las contraseñas ingresadas";

    
    return $error[$name][$nro];
}
?>