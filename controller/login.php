<?php

    include '../models/modelos.php';
    $usuario = new Usuario();

    $email = $_POST['email'];
    $senha = md5($_POST['senha']);

    if(!empty($email) and !empty($senha)){
        $login  = $usuario->login($email, $senha);
        if($login >= 0){
            session_start();
            $_SESSION['id'] = $login;
        }
    } 
    
    header('Location: ../index.php');
    exit();

?>

