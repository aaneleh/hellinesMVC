<?php
    if(!isset($_SESSION['id']) or empty($_SESSION['id'])){
        header('Location: index.php');
        exit;
    } 
?>

<main>
    <section class="todas" id="todas">
        <h2>Todos os voos</h2>
        <div class="conteudo">
            <table>
                <tr>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Data e Hora</th>
                    <th>Editar</th>
                    <th>Excluir</th>
                </tr>

                <?php
                    $lista = $voos->getTodos();

                    for($i=0; $i < count($lista); $i++) {
                        $row = $lista[$i];
                        echo '
                        <tr>
                            <td>'.$row['origem'].'</td>
                            <td>'.$row['destino'].'</td>
                            <td>'.$row['data'].' - '.$row['hora'].'</td>
                            <td>
                                <a class="botao preto" href="./admin.php?pg=editarvoo&id='.$row['id'].'">
                                    <i class="bi bi-three-dots"></i>
                                </a>
                            </td>
                            <td>
                                <a class="botao preto" href="../../controller/excluir.php?id='.$row['id'].'">
                                    <i class="bi bi-x-lg"></i>
                                </a>
                            </td>
                        </tr>
                        ';
                    }
                ?>
            </table>
        </div>
    </section>
</main>
