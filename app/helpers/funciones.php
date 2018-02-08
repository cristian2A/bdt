<?php

function errores($error,$mensaje,$fichero,$linea) {
    echo "<b>: : ERROR :: </b><br>" ;
    echo "Sentimos comunicarle que se ha producido un error";
    echo "Tipo de error: $error: $mensaje en $fichero en la línea
    $linea";
    }

    function url_base()
    {
        $url_base = $_SERVER['REQUEST_SCHEME']."://".$_SERVER["SERVER_NAME"].":8080"."/mvc/public/";
        return $url_base;
    }
?>