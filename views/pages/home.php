<?php
    if(!isset($_SESSION['id']) or empty($_SESSION['id'])){
        header('Location: index.php');
        exit;
    } 
?>

<main>
    <section class="hero" id="hero">
        <div class="conteudo">
            <h1>Faça a viagem dos seus sonhos</h1>
            <p>Confira nossas ofertas abaixo ou clique no botão para selecionar seu destino e boa viagem!</p>
            <h5 class="botao azul">
                <a href="#consultar">
                    Consultar agora
                </a>
            </h5>
        </div>
    </section>

    <div class="divisor"></div>

    <section class="ofertas" id="ofertas">
        <h2>Ofertas</h2>

        <div class="conteudo">

            <?php
                $lista = $voos->getTodos();
                $total = $voos->getQuantidade();
                for($i=0; $i < 6 and $i < $total; $i++) {
                    $row = $lista[$i];
                    echo '
                    <div class="card">
                        <div>
                            <p>
                                <i class="bi bi-calendar-event"></i>
                                '.$row['data'].' - '.$row['hora'].'
                            </p>
                            <p>
                                <i class="bi bi-people-fill"></i>
                                '.$row['atual_passageiros'].'/'.$row['total_passageiros'].'
                            </p>
                        </div>
                        <div>
                            <p>'.$row['origem'].'</p>
                            <svg xmlns="http://www.w3.org/2000/svg" height="48" width="48"><path d="M6.05 42v-3h36v3ZM9.2 31.6l-5.15-8.75 2.15-.4 3.5 3.1L21 22.5 12.45 8.15l2.9-.85L29.6 20.15l10.8-2.9q1.35-.4 2.45.475t1.1 2.325q0 .95-.575 1.7t-1.475 1Z"/></svg>
                            <p>'.$row['destino'].'</p>
                        </div>
                        <div>
                            <a href="./controller/comprar.php?id='.$row['id'].'" class="botao azul">
                                Comprar
                                <i class="bi bi-arrow-right-short"></i>
                            </a>
                        </div>
                    </div>
                    '; 
                }
            ?>

        </div>
    </section>

    <section class="consultar" id="consultar">
        <h2>Consultar</h2>
        <div class="conteudo">
            <form action="./index.php" method="get">
                <input type="hidden" name="pg" value="resultados">
                <div>
                    <p>Origem</p>
                    <input class="input branco" list="origens" name="origem">

                    <datalist id="origens">
                        <?php
                            $lista = $voos->getOrigens();
                            for($i=0; $i < count($lista); $i++) {
                                $row = $lista[$i];
                                echo '
                                    <option value="'.$row['origem'].'">
                                ';
                            }
                        ?>
                    </datalist>
                </div>
                <div>
                    <p>Destino</p>
                    <input class="input branco" list="destinos" name="destino">

                    <datalist id="destinos">
                        <?php
                            $lista = $voos->getDestinos();
                            for($i=0; $i < count($lista); $i++) {
                                $row = $lista[$i];
                                echo '
                                    <option value="'.$row['origem'].'">
                                ';
                            }
                        ?>
                    </datalist>
                </div>
                <button id="buscar-botao" class="botao azul"> <!-- adicionar funcao com js para enviar o form -->
                    Buscar
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </section>

    <section class="todas" id="todas">
        <h2>Todas as passagens</h2>
        <div class="conteudo">
            <table>
                <tr>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Data e Hora</th>
                    <th>Assentos</th>
                </tr>

                <?php
                    $lista = $voos->getTodos();
                    for($i=0; $i < 6 and $i < $total; $i++) {
                        $row = $lista[$i];
                        echo '
                        <tr>
                            <td>'.$row['origem'].'</td>
                            <td>'.$row['destino'].'</td>
                            <td>'.$row['data'].' - '.$row['hora'].'</td>
                            <td>'.$row['atual_passageiros'].'/'.$row['total_passageiros'].'</td>
                            <td>
                                <a class="botao preto" href="./controller/comprar.php?id='.$row['id'].'">
                                    <i class="bi bi-cart-fill"></i>
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