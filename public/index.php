<?php
session_start();
//Cargamos la app
    require_once '../app/app.php';
    unset($_SESSION['user']);
    //Instaciamos la clase controlador
    $start = new Core\App;
?>