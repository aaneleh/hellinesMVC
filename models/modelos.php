<?php

include 'bd.php';

class Usuario {

    public function novoUsuario($nome, $email, $senha, $admin) {
        try {
            $query = "INSERT INTO usuarios (nome, email, senha, admin) VALUES ('$nome','$email','$senha', '$admin')";
            $bd = connect();
            $res = $bd->prepare($query);
            $res->execute();

            $query = "SELECT id FROM usuarios WHERE email = '$email'";
            $res = $bd->prepare($query);
            $res->execute();

            $row = $res->fetch();
            
            return $row['id'];
            
        } catch (PDOException $er){
            return -1;
        }
    }

    //metodo 1: login; se login() >= 0: loga
    public function login($email, $senha) {
        $valores = array(
            'email'=>$email,
            'senha'=>$senha //já chega com o md5()
        );
        try {
            $query = "SELECT * from usuarios WHERE email = :email AND senha = :senha";
            $bd = connect();
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
            return -1;
        }
    }

    //metodo 2: getNome
    public function getNome($id) {
        try {
            $query = "SELECT nome from usuarios WHERE id = ". $id;
            $bd = connect();
            $res = $bd->prepare($query);
            $res->execute();
            $row = $res->fetch();
            return $row['nome'];

        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    public function ehAdmin($id){
        try {
            $query = "SELECT admin from usuarios WHERE id = ". $id;
            $bd = connect();
            $res = $bd->prepare($query);
            $res->execute();
            $row = $res->fetch();
            return $row['admin'];
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }
}

class Voo {

    //recebe todos os dados do controller e faz a inserção
    public function novoVoo($origem, $destino, $data, $hora, $total_passageiros) {
        $valores = array(
            'origem'=>  $origem,
            'destino'=> $destino,
            'data'=>    $data,
            'hora'=>    $hora, 
            'atual_passageiros'=> 0,
            'total_passageiros'=> $total_passageiros
        );
        try {
            $bd = connect();
            $query = "INSERT INTO voos (origem, destino, data, hora, atual_passageiros, total_passageiros) VALUES (:origem, :destino, :data, :hora, :atual_passageiros, :total_passageiros)";
            $res = $bd->prepare($query);
            $res->execute($valores);
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

    //metodo: pegar quantidade de voos
    public function getQuantidade() {
        try {
            $bd = connect();
            $query = "SELECT COUNT(id) FROM voos";
            $res = $bd->prepare($query);
            $res->execute();
            $row = $res->fetch();
            return $row['0'];
        } catch (PDOException $er){
            return 0;
        }
    }

    //metodo: pegar todos os voos
    public function getTodos(){
        try {
            $bd = connect();
            $query = "SELECT * FROM voos ORDER BY atual_passageiros AND data AND hora";
            $res = $bd->prepare($query);
            $res->execute();

            $lista = array();
            while($row = $res->fetch()){
                array_push($lista, $row);
            }

            return $lista;
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }
    
    //metodo: paga um voo por id
    public function getUm($id){
        try {
            $bd = connect();
            $query = "SELECT * FROM voos WHERE id= ".$id;
            $res = $bd->prepare($query);
            $res->execute();
            return $res->fetch();
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo: pegar todas as origens
    public function getOrigens(){
        try {
            $bd = connect();
            $query = "SELECT origem FROM voos GROUP BY origem";
            $res = $bd->prepare($query);
            $res->execute();
            $lista = array();
            while($row = $res->fetch()){
                array_push($lista, $row);
            }
            return $lista;
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo: pegar todos os destinos
    public function getDestinos(){
        try {
            $bd = connect();
            $query = "SELECT destino FROM voos GROUP BY destino";
            $res = $bd->prepare($query);
            $res->execute();
            $lista = array();
            while($row = $res->fetch()){
                array_push($lista, $row);
            }
            return $lista;
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo: pegar voos que contenham tal origem e destino
    public function consultar($origem, $destino) {
        try {
            $bd = connect();
            $query = "SELECT * FROM voos WHERE origem LIKE '%".$origem."%' AND destino LIKE '%".$destino."%'";
            $res = $bd->prepare($query);
            $res->execute();
            $lista = array();
            while($row = $res->fetch()){
                array_push($lista, $row);
            }
            return $lista;
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

    //metodo 3: deletar um voo
    public function deletar($id){
        try {
            $bd = connect();
            $query = "DELETE FROM voos WHERE id=".$id;
            $res = $bd->prepare($query);
            $res->execute();
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

    //metodo 4: editar um voo
    public function editar($id, $origem, $destino, $data, $hora, $total_passageiros){
        $valores = array(
            'id'=> $id,
            'origem'=>  $origem,
            'destino'=> $destino,
            'data'=>    $data,
            'hora'=>    $hora, 
            'total_passageiros'=> $total_passageiros
        );
        try {
            $bd = connect();
            $query = "UPDATE voos SET origem = :origem, destino = :destino, data = :data, hora = :hora, total_passageiros = :total_passageiros WHERE id = :id";
            $res = $bd->prepare($query);
            $res->execute($valores);
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

}

class Passagem {

    public function novaPassagem($id_usuario, $id_voo) {
        try {
            //pegar numero atual de passageiros e o maximo
            $query = "SELECT atual_passageiros, total_passageiros FROM voos WHERE id=".$id_voo;
            $bd = connect();
            $res = $bd->prepare($query);
            $res->execute();
            $row= $res->fetch();
            $atual = $row['atual_passageiros'];
            $total = $row['total_passageiros'];
            //se atual < maximo
            if($atual < $total) {
                $atual++;
                //update voo com tal id para atual + 1
                $query = 'UPDATE voos SET atual_passageiros='.$atual.' WHERE id='.$id_voo;
                $res = $bd->prepare($query);
                $res->execute();
                //insere em passageiros ambos ids
                $query = 'INSERT INTO passageiros (id_voo, id_usuario, poltrona) VALUES ('.$id_voo.','.$id_usuario.','.$atual.')';
                $res = $bd->prepare($query);
                $res->execute();
            }
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

    //metodo 1: pega todas passagens de um usuario
    public function getPassagens($id) {
        try {
            $query = "SELECT voos.*, passageiros.poltrona FROM passageiros INNER JOIN voos ON id_voo = voos.id WHERE id_usuario = " . $id;
            $bd = connect();
            $res = $bd->prepare($query);
            $res->execute();
            $lista = array();
            while($row = $res->fetch()){
                array_push($lista, $row);
            }
            return $lista;

        } catch (PDOException $er){
            return $er->getMessage();
        }
    }
    
}

?>