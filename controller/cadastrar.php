<?php

    include '../models/modelos.php';
    $voos = new Voo();

    if(!empty($_POST['origem']) and !empty($_POST['destino']) and !empty($_POST['data']) and !empty($_POST['total_passageiros'])){
        $voos->novoVoo($_POST['origem'], $_POST['destino'], $_POST['data'], $_POST['hora'], $_POST['total_passageiros']);
    } 
    
    header('Location: ../views/pages/admin.php');
    exit();

?>

