<?php
include_once('Models/DbConfig.php');
session_start();
?>
<?php
if (isset($_POST['sair'])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
}
?>
<?php
if (isset($_POST['delete'])) {
    $sucesso = 1;
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    $idperfil = $_POST['id'];
    $cpfanunciante = $_POST['cpf'];
    $sqldelete = "DELETE FROM usuarios WHERE id LIKE '$idperfil'";
    $resultdelete = $conexao->query($sqldelete);
    $sqlOrdem = "ALTER TABLE usuarios AUTO_INCREMENT = 0;";
    $resultOrdem = $conexao->query($sqlOrdem);
}
?>
<?php
if ($sucesso == 1) {
    $sqlDeleteP = "DELETE FROM anuncios WHERE cpf LIKE '$cpfanunciante'";
    $resultDeleteP = $conexao->query($sqlDeleteP);
    $sqlOrdemP = "ALTER TABLE anuncios AUTO_INCREMENT = 0;";
    $resultOrdemP = $conexao->query($sqlOrdemP);
}
?>
<?php
$controle = 0;
$Doando = "Doando";
$Abandonado = "Abandonado";
$Perdido = "Perdido";
$Denunciar = "Maus-Tratos";
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    $controle = 1;
} else {
    $email = $_SESSION['email'];
    $controle = 2;
    $sql2 = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
    $result2 = $conexao->query($sql2);
    while ($perfil = mysqli_fetch_assoc($result2)) {
        $image2 = "" . $perfil['foto'];
        $id2 = $perfil['id'];
    }
}
$sql = "SELECT * FROM anuncios WHERE status LIKE 'Adotado' OR status LIKE 'Encontrado' OR status LIKE 'Resgatado' ORDER BY data DESC;";
$result = $conexao->query($sql);
$sqlcont = "SELECT COUNT(status) FROM anuncios WHERE status='Adotado'";
$resultcont = $conexao->query($sqlcont);
while ($cont = mysqli_fetch_assoc($resultcont)) {
    $contagem1 = $cont['COUNT(status)'];
}
$sqlcont2 = "SELECT COUNT(status) FROM anuncios WHERE status='Encontrado'";
$resultcont2 = $conexao->query($sqlcont2);
while ($cont2 = mysqli_fetch_assoc($resultcont2)) {
    $contagem2 = $cont2['COUNT(status)'];
}
$sqlcont3 = "SELECT COUNT(status) FROM anuncios WHERE status='Resgatado'";
$resultcont3 = $conexao->query($sqlcont3);
while ($cont3 = mysqli_fetch_assoc($resultcont3)) {
    $contagem3 = $cont3['COUNT(status)'];
}
$total = $contagem1 + $contagem2 + $contagem3;

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="Assets/Imagens/Site/Imgs/icone-pagina.png">
    <link rel="stylesheet" type="text/css" href="Assets/Css/estilo-w3.css">
    <link rel="stylesheet" type="text/css" href="Assets/Css/estilo-grid.css">
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilos-pessoal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <title>Find Pets - Início</title>
    <style>
        div#imagens img {
            width: 250px !important;
            height: 250px !important;
        }

        #perfil {
            border-radius: 50%;
            width: 38px;
            height: 38px;
        }

        body {
            background-color: #daeefe;
        }

        .body1 {
            background-image: url("Assets/Imagens/Site/Imgs/pet1.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 250px;
            width: 100%;
        }

        .control {
            position: relative;
            width: 100%;
            height: 400px;
        }

        #container {
            height: 100%;
        }

        #divleft {
            float: left;
            width: 48%;
            margin-right: 2%;
            height: 100%;
            margin-bottom: 5%;
        }

        #divright {
            float: left;
            width: 48%;
            margin-right: 2%;
            height: 100%;
            margin-bottom: 5%;
        }
    </style>
</head>

<body>

    <header class="w3-container" style="background-color:white; color:black;">

        <nav>
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between lg:h-20">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">

                        <label for="menu-toggle" class="inline-flex items-center justify-center p-2 rounded-xl-md text-gray-400 hover:text-white hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                            <span class="sr-only">Abrir menu</span>
                            <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </label>
                    </div>
                    <div class="h-14 flex-1 flex items-center justify-center sm:justify-start">
                        <div class="flex-shrink-0 flex items-center">
                            <a href="index.php">
                                <img class="h-8 w-auto lg:block lg:h-14" id="logo" src="Assets/Imagens/Site/Imgs/Logo1.png">
                            </a>
                        </div>
                        <div class="hidden sm:block sm:ml-6" id="menu">
                            <div class="flex lg:space-x-4">
                                <?php
                                if ($controle == 1) {
                                ?>

                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/animal/anuncios.php">Pesquisar animais</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="index.php#sobre">Sobre o projeto</a>
                                <?php
                                }
                                if ($controle == 2) {
                                ?>

                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/user/perfil.php">Meu perfil</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/animal/add.php">Cadastrar animal</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/user/meuspets.php">Meus anúncios</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/animal/anuncios.php">Pesquisar animais</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="index.php#sobre">Sobre o projeto</a>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto md:ml-6 sm:pr-0">
                        <div class="relative mx-auto text-black-600 lg:inline-block ">
                            <?php
                            if ($controle == 1) {
                            ?>
                                <a href="View/login.php" class="font-bold hover:text-secondary">Entrar &nbsp;&nbsp;</a>
                                <a href="View/add.php" class="primary-button hidden md:inline-block hover:text-secondary" style="background-color: #0091ff;">Cadastre-se</a>
                            <?php
                            }
                            if ($controle == 2) {
                            ?>
                                <a href="View/user/perfil.php"><img class="h-8 w-auto lg:block lg:h-14" id="perfil" src="<?php echo $image2; ?>"></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <input class="hidden  popup-menu" type="checkbox" id="menu-toggle">
            <div style="background-color:white; color:black;" class="hidden fixed bg-primary-dark w-full h-full z-50 top-0 left-0 sm:hidden" id="mobile-menu">
                <label for="menu-toggle" class="flex justify-end p-2 rounded-xl-md text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Fechar menu</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </label>
                <div class="px-2 pt-2 pb-3 space-y-1">
                    <?php
                    if ($controle == 1) {
                    ?>

                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/login.php">Entrar</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/add.php">Cadastre-se</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/animal/anuncios.php">Pesquisar animais</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="index.php#sobre">Sobre o projeto</a>
                    <?php
                    }
                    if ($controle == 2) {
                    ?>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/user/perfil.php">Meu perfil</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/animal/add.php">Cadastrar animal</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/user/meuspets.php">Meus anúncios</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="View/animal/anuncios.php">Pesquisar animais</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="index.php#sobre">Sobre o projeto</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>


    <main role="main" class="flex-grow container max-w-7xl mx-auto px-2 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <div align="center">
            <div class="body1">
            </div>
            <br>
            <div id="container">
                <div id="divleft">
                    <p>Cadastrar animal para:</p>
                    <br>
                    <a href="View/animal/add.php?status=<?php echo $Doando; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff; font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/doar.png" style="height:40px;width:40px">
                            <div class="flex-1">Doar</div>
                        </button></a>
                    <br><br>
                    <a href="View/animal/add.php?status=<?php echo $Denunciar; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/denunciar.png" style="height:40px;width:40px">
                            <div class="flex-1">Denunciar</div>
                        </button></a>
                    <br><br>
                    <a href="View/animal/add.php?status=<?php echo $Perdido; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/Perdido.png" style="height:40px;width:40px">
                            <div class="flex-1">Perdido</div>
                        </button></a>
                    <br><br>
                    <a href="View/animal/add.php?status=<?php echo $Abandonado; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/abandonado.png" style="height:40px;width:40px">
                            <div class="flex-1">Abandonado</div>
                        </button></a>
                </div>
                <div id="divright">
                    <p>Pesquisar animal para:</p>
                    <br>
                    <a href="View/animal/anuncios.php?status=<?php echo $Doando; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/adotar.png" style="height:40px;width:40px">
                            <div class="flex-1">Adotar</div>
                        </button></a>
                    <br><br>
                    <a href="View/animal/anuncios.php?status=<?php echo $Denunciar; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/resgatar.png" style="height:40px;width:40px">
                            <div class="flex-1">Resgatar</div>
                        </button></a>
                    <br><br>
                    <a href="View/animal/anuncios.php?status=<?php echo $Perdido; ?>"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/encontrar.png" style="height:40px;width:40px">
                            <div class="flex-1">Encontrar</div>
                        </button></a>
                    <br><br>
                    <a href="View/animal/anuncios.php"><button type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/Todos.png" style="height:40px;width:40px">
                            <div class="flex-1">Todos</div>
                        </button></a>
                </div>
            </div>
            <br>
            <h3 class="w3-text-black w3-padding-16"><img src="Assets/Imagens/Site/Imgs/pegada.png" style="height:35px;width:35px"> &nbsp;&nbsp; Números</h3>
            <h4 class="w3-text-black"><?php echo $total; ?> Pets ajudados</h4>
            <br>
            <div class="grid gap-3 justify-center grid-rows-none sm:gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                <?php
                while ($anuncio = mysqli_fetch_assoc($result)) {
                    $id = $anuncio['id'];
                    $nome = $anuncio['nome'];
                    $imagem = $anuncio['imagem'];
                    $endereco = $anuncio['endereco'];
                    $status = $anuncio['status'];
                    $data = $anuncio['data'];
                ?>
                    <table>
                        <th>
                            <div id="imagens" class="flex-1 bg-white rounded-lg shadow-md overflow-hidden">
                                <a class="block relative" href="../../View/animal/animal.php?id=<?php echo $id; ?>">
                                    <img class="w-full animation" src="<?php echo $imagem; ?>">
                                    <?php
                                    if ($status == "Adotado") {
                                    ?>
                                        <span style="background-color:orange;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Adotado</span>
                                    <?php
                                    }
                                    if ($status == "Encontrado") {
                                    ?>
                                        <span style="background-color:green;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Encontrado</span>
                                    <?php
                                    }
                                    if ($status == "Resgatado") {
                                    ?>
                                        <span style="background-color:brown;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Resgatado</span>
                                    <?php
                                    }
                                    ?>
                                </a>
                                <div class="p-3 sm:p-6">
                                    <div>
                                        <a class="font-bold hover:text-secondary" href="../../View/animal/animal.php?id=<?php echo $id; ?>"><?php echo $nome; ?></a>
                                    </div>
                                    <div class="text-gray-500 text-sm">
                                        <?php
                                        echo $endereco;
                                        ?>
                                    </div>
                                    <div class="text-gray-500 text-sm">
                                        <?php
                                        echo $data;
                                        ?>
                                    </div>
                                </div>
                        </th>
                    </table>
                <?php
                }
                ?>
            </div>
            <br>
            <h3 id="sobre" class="w3-text-black w3-padding-16"><img src="Assets/Imagens/Site/Imgs/sobre.png" style="height:35px;width:35px"> &nbsp;&nbsp;Sobre</h3>
            <p align="justify">
                O projeto Find Pets é uma iniciativa dedicada a promover o bem-estar dos
                animais de estimação, reduzir o abandono e encontrar lares amorosos para os animais em situação de
                vulnerabilidade. Este projeto visa criar uma plataforma de apoio à adoção responsável de cães e
                gatos, proporcionando benefícios tanto para os animais quanto para os usuários.
            </p>
            <div align="center">
                <div align="justify">
                    <p>
                        Obs.: Somos uma plataforma, não somos ong e não somos abrigo.
                    </p>
                    <p>Clique abaixo para mais detalhes:</p>
                    <p>
                        <a href="View/func.php" title='Ir para a página de funcionalidades do site'>Funcionalidades do site</a>
                    </p>
                </div>
                <br>
                <h3 class="w3-text-black w3-padding-16"><img src="Assets/Imagens/Site/Imgs/objetivo2.png" style="height:35px;width:35px;"> &nbsp;&nbsp;Objetivo</h3>
                <p align="justify">
                    O projeto tem como objetivo principal reduzir o abandono de animais de estimação por meio de
                    estratégias como conscientização sobre a responsabilidade na criação de animais, facilitação da
                    adoção responsável por meio de uma plataforma online. O foco é reduzir o número de animais
                    abandonados e perdidos, promover a adoção responsável e melhorar o bem-estar animal, além de sensibilizar a
                    população sobre o tratamento ético aos animais.
                </p>
                <p align="justify">
                    Obs.: Fazemos a intermediação e não nos responsabilizamos pela entrega dos animais.
                </p>
                <br>
                <h3 class="w3-text-black w3-padding-16"><img src="Assets/Imagens/Site/Imgs/noticia.png" style="height:35px;width:35px;"> &nbsp;&nbsp;Notícia</h3>
                <a href="https://www.youtube.com/watch?v=Jlh_N3lP-8o" title='Ir para o video do youtube'>Clique aqui para ver no youtube</a>
                <iframe width="100%" height="300px" src="https://www.youtube.com/embed/Jlh_N3lP-8o?si=OQLkG617ovNKlKqt" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>

    </main>


    <footer class="w3-container w3-center w3-margin-top" style="background-color:white; color:black;">
        <div class="container max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 py-5">
            <div class="grid gap-1 grid-cols-2 lg:grid-cols-7 text-sm">
                <?php
                if ($controle == 1) {
                ?>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">ADOTE</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="View/animal/anuncios.php">Pesquisar animais</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">FIND PETS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="index.php#sobre">Sobre o projeto</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">PERFIL</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="/View/login.php">Login</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="/View/add.php">Cadastre-se</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">SUPORTE</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="https://maps.app.goo.gl/hPycyzrJBo8YA4ky6">Escritório</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="tel:(11) 4674–25940">Telefone</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="mailto:f292acad@cps.sp.gov.br">Gmail</a>
                        </li>
                    </ul>
                <?php
                }
                ?>
                <?php
                if ($controle == 2) {
                ?>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">ADOTE</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="View/animal/anuncios.php">Pesquisar animais</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">FIND PETS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="index.php#sobre">Sobre o projeto</a>
                        </li>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">ANIMAL</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="View/animal/add.php">Cadastrar animal</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">ANÚNCIOS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="View/user/meuspets.php">Meus anúncios</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">SUPORTE</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="https://maps.app.goo.gl/hPycyzrJBo8YA4ky6">Escritório</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="tel:(11) 4674–25940">Telefone</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="mailto:f292acad@cps.sp.gov.br">Gmail</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">PERFIL</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="/View/user/perfil.php">Meu perfil</a>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </div>
            <div class="flex flex-col mt-10 text-center items-center">
                <div><img loading="lazy" src="Assets/Imagens/Site/Imgs/Logo1.png" height="150px" width="150px"></div>
                <div class="font-bold">Todos os direitos reservados.</div>
            </div>
        </div>

    </footer>

    <div vw class="enabled">
        <div vw-access-button class="active"></div>
        <div vw-plugin-wrapper>
            <div class="vw-plugin-top-wrapper"></div>
        </div>
    </div>
    <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
    <script>
        new window.VLibras.Widget('https://vlibras.gov.br/app');
    </script>
</body>

</html>
