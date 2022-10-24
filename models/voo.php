<?php

include 'bd.php';
$bd = connect();

class Voo {
    private $origem;
    private $destino;
    private $data;
    private $hora;
    private $atual_passageiros;
    private $total_passageiros;

    //contrutor: recebe todos os dados do controller e faz a inserção
    public function __construct($origem, $destino, $data, $hora, $total_passageiros) {
        $valores = array(
            'origem'=>  $origem,
            'destino'=> $destino,
            'data'=>    $data,
            'hora'=>    $hora, 
            'atual_passageiros'=> 0,
            'total_passageiros'=> $total_passageiros
        );
        try {
            $query = "INSERT INTO voos (origem, destino, data, hora, atual_passageiros, total_passageiros) VALUES (:origem, :destino, :data, :hora, :atual_passageiros, :total_passageiros)";
            $res = $bd->prepare($query);
            $res->execute($valores);
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

    //metodo 1: pegar quantidade de voos
    public function getQuantidade() {
        try {
            $query = "SELECT COUNT(id) FROM voos";
            $res = $bd->prepare($query);
            $res->execute();
            $row = $res->fetch();
            return $row['count'];
        } catch (PDOException $er){
            return 0;
        }
    }

    //metodo 2: pegar todos os voos
    public function getTodos(){
        try {
            $query = "SELECT * FROM voos";
            $res = $bd->prepare($query);
            $res->execute();
            return $res->fetch();
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo 3: pegar um unico voo
    public function getUm($id){
        try {
            $query = "SELECT * FROM voos WHERE id= ". $id;
            $res = $bd->prepare($query);
            $res->execute();
            return $res->fetch();
        } catch (PDOException $er){
            return $er->getMessage();
        }
    }

    //metodo 3: deletar um voo
    public function deletar($id){
        try {
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
            $query = "UPDATE voos SET origem = :origem, destino = :destino, data = :data, hora = :hora, total_passageiros = :total_passageiros WHERE id = :id";
            $res = $bd->prepare($query);
            $res->execute($valores);
        } catch (PDOException $er){
            echo 'Erro: '.$er->getMessage();
        }
    }

}


?>