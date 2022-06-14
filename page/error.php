<?php 
    $titre = "Erreur !!!";

    ob_start();

    echo $error;

    $content = ob_get_clean();

    require "layout/default.php";
