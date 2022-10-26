<?php
    if(!isset($_SESSION['id']) or empty($_SESSION['id'])){
        header('Location: index.php');
        exit;
    } 
?>

<main>
    
    <div class="ofertas">
        <h2> Minhas passagens </h2>
        <div class="conteudo">

            <?php
                $lista = $passagens->getPassagens($_SESSION['id']);

                if (count($lista) == 0){
                    echo '<h4>Você não possui nenhuma passagem ainda</h4>';
                } else {
                    for($i=0; $i < count($lista); $i++) {
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
                                        <p>
                                            Poltrona '.$row['poltrona'].'
                                        </p>
                                    </div>
                                </div>
                        ';
                    }
                }

                
            ?>

        </div>
    </div>



</main>