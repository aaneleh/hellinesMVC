<?php

include 'bd.php';
$bd = connect();

class Usuario {
    private $nome;
    private $email;
    private $senha;

    //contrutor: recebe todos os dados do controller e faz a inserção
    public function __construct($nome, $email, $senha, $admin) {
        try {
            $query = "INSERT INTO usuarios (nome, email, senha, admin) VALUES ('$nome','$email','$senha', '$admin')";
            $res = $bd->prepare($query);
            $res->execute();

            $query = "SELECT id FROM usuarios WHERE email = '$email'";
            $res = $bd->prepare($query);
            $res->execute();

            $row = $res->fetch();

            session_start();
            $_SESSION['id'] = $row['id'];
            return $row['id'];

        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo 1: login
    //se login() >= 0: loga
    public function login($email, $senha) {
        $valores = array(
            'email'=>$email,
            'senha'=>$senha //já chega com o md5()
        );
        try {
            $query = "SELECT * from usuarios WHERE email = :email AND senha = :senha";
            $res = $bd->prepare($query);
            $res->execute($valores);

            if ($res->rowCount() > 0){
                $row = $res->fetch();
                session_start();
                $_SESSION['id'] = $row['id'];
                return $row['id']; 
            } else {
                return -1;
            }

        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo 2: getNome
    public function getNome($id) {
        try {
            $query = "SELECT nome from usuarios WHERE id = ". $id;
            $res = $bd->prepare($query);
            $res->execute($valores);
            $row = $res->fetch();
            return $row['nome'];

        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

}

?>