<?php
    session_start();
    include 'models/modelos.php';

    $usuario = new Usuario();
    $voos = new Voo();
    $passagens = new Passagem();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./views/css/style.css">
    <script src="./views/js/script.js" defer></script>
    <title>Hellines</title>
</head>
<body> 
    
    <header class="header">
        <div class="conteudo">
            <div class="logo">
                <h4>
                    <a href="./">
                        <i class="bi bi-airplane-fill"></i>
                        Hellines
                    </a>
                </h4>
            </div>
            <div class="links_desktop">
                <p>
                    <a href="#ofertas">Ofertas</a>
                </p>
                <p>
                    <a href="#consultar">Consultar</a>
                </p>
                <p>
                    <a href="#todas">Todas as Passagens</a>
                </p>
            </div>
            <div class="conta">
                <p>
                    <a href="./controller/sair.php">Sair</a>
                </p>
                <p>
                    <a href="./index.php?pg=usuario">
                    <?php
                        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
                            echo '<p class="botao branco">'.$usuario->getNome($_SESSION['id']).'</p>';
                        }
                    ?>
                        <i class="bi bi-person-circle"></i>
                    </a>
                </p>
            </div>

            <div class="icone_menu" id="icone_menu">
                <i class="bi bi-list"></i>
            </div>
            <div class="sidebar hidden" id="sidebar">
                <ul>
                    <li class="icone_fechar" id="icone_fechar"><i class="bi bi-arrow-right"></i></li>
                    <li>Ofertas <i class="bi bi-stopwatch-fill"></i></li>
                    <li>Consultar <i class="bi bi-search"></i></li>
                    <li>Listagem <i class="bi bi-ticket-fill"></i></li>
                    <li class="sidebar-conta">
                        <i class="bi bi-person-circle"></i>
                        <?php
                            if(isset($_SESSION['id']) and !empty($_SESSION['id'])){
                                echo '<p class="botao branco">'.$usuario->getNome($_SESSION['id']).'</p>';
                            }
                        ?>
                        <p>
                    <a href="./controller/sair.php">Sair</a>
                </p>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <?php
        if(isset($_SESSION['id']) and !empty($_SESSION['id'])){

            if(isset($_GET['pg']) and !empty($_GET['pg'])){
                require_once('./views/pages/'.$_GET['pg'].'.php');
    
            } else {
                require_once('./views/pages/home.php');
            }

        } else {
            header('Location: ./views/pages/login.php');
            exit();
        }
    ?>

    <footer class="rodape">
        <div class="conteudo">
            <div>
                <p class="logo">
                    <i class="bi bi-airplane-fill"></i>
                    Hellines
                </p>
                <p>
                    <a href="twitter.com/">
                        <i class="bi bi-twitter"></i>
                        @hellines
                    </a>
                </p>
                <p>
                    <a href="instagram.com/">
                        <i class="bi bi-instagram"></i>
                        @hellines
                    </a>
                </p>
            </div>

            <div>
                <p>
                    <a href="#ofertas">Ofertas</a>
                </p>
                <p>
                    <a href="#consultar">Consultar</a>
                </p>
                <p>
                    <a href="#todas">Todas as Passagens</a>
                </p>
            </div>

            <div>
                <a  class="botao branco" href="./views/pages/admin.php">Administração</a>
            </div>
        </div>

        <p><i class="bi bi-c-circle-fill"></i> Copyright Helena Gonçalves, 2022</p>
    </footer>

</body>
</html>