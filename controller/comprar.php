<?php

    include '../models/modelos.php';
    $passagem = new Passagem();

    session_start();

    if( !empty($_GET['id']) and !empty($_SESSION['id']) ) {
        $passagem->novaPassagem($_SESSION['id'],$_GET['id']);
    } 

    header('Location: ../index.php?pg=usuario');
    exit();

?>