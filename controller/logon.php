<?php

    include '../models/modelos.php';
    $usuario = new Usuario();

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $admin = $_POST['admin'];

    //recebe se é admin por um hidden input
    if(!empty($email) and !empty($senha)){

        $login = $usuario->novoUsuario($nome, $email, $senha, $admin);
        if($login >= 0){
            session_start();
            $_SESSION['id'] = $login;
        }
    } 
    
    header('Location: ../index.php');
    exit();

?>

