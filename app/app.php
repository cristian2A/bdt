<?php
/** Errores */
//error_reporting(E_ALL); //mostrar todo: Desarrollo
//ini_set('display_errors', 0); //NO mostrar Ninguno : Produccion

    /** Aquí se cargaran los archivos necesarios para el funcionamiento del app */
    require_once 'config/config.php';
    require_once 'helpers/funciones.php';
    require_once 'helpers/Security/Validator.php';
    require_once 'helpers/msg_errors.php';

    require_once 'core/App.php';
    require_once 'core/DBManager.php';
    require_once 'core/Model.php';
    require_once 'core/Layout.php';
    require_once 'core/Controller.php';
    
    require_once 'controllers/UsuariosController.php';
    
    //set_error_handler("errores");
?>