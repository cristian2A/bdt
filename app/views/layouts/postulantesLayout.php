<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $this->getTitle();?></title>
    <base href="<?= BASE_URL;?>">
    <meta name="keywords" content="<?php echo $this->getKeywords();?>"/>
    <meta name="Description" content="<?php echo $this->getDescription();?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link type="image/x-icon" href="img/layout/iso.ico" rel="icon"/>
    <link type="image/x-icon" href="img/layout/iso.ico" rel="shortcut icon"/>


    <link rel="stylesheet" type="text/css" media="screen" href="css/estilos.css" />
    <link rel="stylesheet" href="css/icon-font/css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Bad+Script|Oleo+Script|Rosario:700,700italic,400,400italic|Oregano|Roboto:400,700,900,500,400italic' rel='stylesheet' type='text/css'>
    <?php 
        /** Agregar estilos especificos de la vista */
        echo $this->getCSS();
    ?>
</head>
<body>
    <div class="contenedor">
        <nav class="menu_sup">
            <div class="secciones">
                <ul>
                    <li><a href="<?= BASE_LINK;?>postulantes">POSTULANTES</a></li>
                    <li><a href="<?= BASE_LINK;?>empresas">EMPRESAS</a></li>
                    <li><a href="<?= BASE_LINK;?>sau">Contacto SAU</a></li>
                </ul>
            </div>
            
            <div class="usuario">
                <?php if(isset($_SESSION['USER']))
                {
                ?>
                <!-- Menu visible al estar logueado -->  
                <!-- Muestra Identificacion del Usuario --> 
                <span class="conectado">
                    <?php echo $_SESSION['USER']['USUARIO']; ?> 
                </span>
                <!-- Menu de opciones de gestión de usuario -->
                
                <ul class="login">   
                    <li class="toogle"><a href="#"><i class="fa fa-bars fa-2x" aria-hidden="true"></i></a>  
                    <ul class="menu-usuario">
                        <li><a href="#personal"><i class="fa fa-address-book-o" aria-hidden="true"></i>Datos Personales</a></li>
                        <li><a href="#academicos"><i class="fa fa-graduation-cap" aria-hidden="true"></i>Datos Académicos</a></li>
                        <li><a href="#clave"><i class="fa fa-lock"></i>Cambiar Contraseña</a></li>
                        <li><a href="<?= BASE_LINK?>postulantes/salir"><i class="fa fa-sign-out"></i>Salir</a></li>
                    </ul>
                    </li>
                </ul>
                <?php }else{ ?>
                <!-- Boton Link a formulario de Login -->
                <div class="ingresar"><a id="ver-modal" href="<?= BASE_LINK;?>postulantes/login#formLogin"><i class="fa fa-sign-in"></i>INGRESAR</a></div>
                <?php } ?>
            </div>
        </nav>


        <header class="header">
            <div class="h-title">
                <div class="logo">
                    <img  class="logoutn" src="<?= BASE_URL;?>img/layout/arania.png"/>
                </div>
                <div class="title utn">
                    <h2>
                        Facultad Regional Rosario
                    </h2>   
                    <h4 class="subtitle" >Universidad Tecnológica Nacional</h4>                    
                </div>
            </div>
            <div class="h-title">

                <div class="title">
                    <h1>
                        Bolsa de Trabajo
                    </h1>
                    <h4 class="subtitle">Secretaría de Asuntos Universitarios</h4>
                </div>
                <div class="logo">
                    <img class="logo" src="<?= BASE_URL;?>img/layout/bolsa-trabajo.png"/>
                </div>                
            </div>
        </header>
        
        <nav class="menu_app">
            <ul class="menu-ppal">
            <li><a href="<?= BASE_LINK;?>postulantes">
                    <i class="fa fa-home fa-fw" aria-hidden="true"></i><span>Inicio</span></a></li>   
                <li><a href="<?= BASE_LINK;?>postulantes/panel">
                    <i class="fa fa-id-card fa-fw" aria-hidden="true"></i><span>Mi Panel</span></a></li>    
          
                <li><a href="<?= BASE_LINK;?>postulantes/busquedas">
                <i class="fa fa-search-plus fa-fw" aria-hidden="true"></i><span>Búsquedas </span></a></li>
                <li><a href="<?= BASE_LINK;?>postulantes/postulaciones"><i class="fa fa-check-square-o" aria-hidden="true"></i><span>Mis Postulaciones</span></a></li>
                <li><a href="<?= BASE_LINK;?>postulantes/micv"><i class="fa fa-file-text" aria-hidden="true"></i><span>Mi CV</span></a></li>
                <li><a href="<?= BASE_LINK;?>postulantes/clasificados"><i class="fa fa-bullhorn"></i><span>Clasificados</span></a></li>
                <li><a href="<?= BASE_LINK;?>postulantes/reglamentaciones"><i class="fa fa-balance-scale"></i><span>Reglamentación</span></a></li>
            </ul>
        </nav>
        
        <section class="main">
            <?php
                require_once $this->view; 
            ?>
        </section>
        <footer class="footer">
            <h4>Pie de pagina para Postulante</h4>
        </footer>

    <!-- <script src="main.js"></script> -->
    <?php 
        /** Agregar estilos especificos de la vista */
        echo $this->getJS();
    ?>
    </div>
</body>
</html>