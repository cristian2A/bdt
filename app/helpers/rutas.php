<?php

    function url_base()
    {
        $url_base = $_SERVER['REQUEST_SCHEME']."://".$_SERVER["SERVER_NAME"].":8080"."/mvc/public/";
        return $url_base;
    }

?>