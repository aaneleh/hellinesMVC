<?php

    include '../models/modelos.php';
    $voos = new Voo();

    if( isset($_GET['id']) and !empty($_GET['id']) ){
        $voos->deletar($_GET['id']);
    } 
    
    header('Location: ../views/pages/admin.php');
    exit();

?>

