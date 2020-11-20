<?php

    $current = (isset($_GET['pag']) ? $_GET['pag'] : 'home');
    $folder = './';
       
    if (substr_count($current, "/") > 0){
        $current = explode("/", $current);
        $control = (file_exists("{$folder}/".$current[0].".php" ) ? $current[0] : "not-found");
        $action = $current[ 1 ];
        $id = (isset( $current[ 2 ] ) ? $current[ 2 ] : 0 );
    } else {
        $control = (file_exists("{$folder}/".$current.".php") ? $current : "not-found");
        $action = "";
        $id = 0;
    }