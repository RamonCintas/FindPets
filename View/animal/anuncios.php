<?php
include_once('../../Models/DbConfig.php');
if (!empty($_GET['status'])) {
    $status2 = $_GET['status'];
    $sql = "SELECT * FROM anuncios WHERE status LIKE '%$status2%' AND status != 'naoverificado' ORDER BY data DESC";
} elseif (isset($_GET['Pesquisar'])) {
    $tipo = ($_GET['tipo']);
    $sexo = ($_GET['sexo']);
    $endereco = ($_GET['endereco']);
    $idade = ($_GET['idade']);
    $vacinacao = ($_GET['vacinacao']);
    $status = ($_GET['status']);
    $descricao = ($_GET['descricao']);
    $tempo = $_GET['tempo'];

    $baseSql = "SELECT * FROM anuncios WHERE status != 'naoverificado' AND tipo LIKE '%$tipo%' AND sexo LIKE '%$sexo%' AND endereco LIKE '%$endereco%' AND idade LIKE '%$idade%' AND vacinacao LIKE '%$vacinacao%' AND status LIKE '%$status%' AND descricao LIKE '%$descricao%'";

    if ($tempo == "data") {
        $sql = "$baseSql ORDER BY data DESC";
    } elseif ($tempo == "id") {
        $sql = "$baseSql ORDER BY id ASC";
    } else {
        $sql = "$baseSql ORDER BY data DESC";
    }
} else {
    $sql = "SELECT * FROM anuncios WHERE status != 'naoverificado' ORDER BY data DESC";
}

$result = $conexao->query($sql);

?>

<?php
session_start();
$controle = 0;
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
        $image2 = "../../" . $perfil['foto'];
        $id2 = $perfil['id'];
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="../../Assets/Imagens/Site/Imgs/icone-pagina.png">
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilo-w3.css">
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilo-grid.css">
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilos-pessoal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <title>Find Pets - Anúncios</title>
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

        input::placeholder {
            color: black;
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
                            <a href="../../index.php">
                                <img class="h-8 w-auto lg:block lg:h-14" id="logo" src="../../Assets/Imagens/Site/Imgs/Logo1.png">
                            </a>
                        </div>
                        <div class="hidden sm:block sm:ml-6" id="menu">
                            <div class="flex lg:space-x-4">
                                <?php
                                if ($controle == 1) {
                                ?>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                                <?php
                                }
                                if ($controle == 2) {
                                ?>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/perfil.php">Meu perfil</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/add.php">Cadastrar animal</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/meuspets.php">Meus anúncios</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
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
                                <a href="../../View/login.php" class="font-bold hover:text-secondary">Entrar &nbsp;&nbsp;</a>
                                <a href="../../View/add.php" class="primary-button hidden md:inline-block hover:text-secondary" style="background-color: #0091ff;">Cadastre-se</a>
                            <?php
                            }
                            if ($controle == 2) {
                            ?>
                                <a href="../../View/user/perfil.php"><img class="h-8 w-auto lg:block lg:h-14" id="perfil" src="<?php echo $image2; ?>"></a>
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
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/login.php">Entrar</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/add.php">Cadastre-se</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                    <?php
                    }
                    if ($controle == 2) {
                    ?>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/perfil.php">Meu perfil</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/add.php">Cadastrar animal</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/meuspets.php">Meus anúncios</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <main role="main" class="flex-grow container max-w-7xl mx-auto px-2 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <form action="anuncios.php#" method="GET" class="form-field flex-1">
            <h1>
                <center>Filtre a sua pesquisa com as características abaixo</center>
            </h1>
            <div class="flex flex-col md:gap-2 sm:flex-row">
                <select class="form-field flex-1" type="text" name="tipo" id="tipo">
                    <option value="">Todos os tipos</option>
                    <option value="Cachorro">Cachorro</option>
                    <option value="Gato">Gato</option>
                </select>
                <select class="form-field flex-1" type="text" name="sexo" id="sexo">
                    <option value="">Todos os sexos</option>
                    <option value="Macho">Macho</option>
                    <option value="Fêmea">Fêmea</option>
                </select>
                <select class="form-field flex-1" name="idade" id="idade">
                    <option value="">Todas as idades</option>
                    <option value="- de 1 ano">- de 1 ano</option>
                    <option value="1 ano">1 ano</option>
                    <option value="2 anos">2 anos</option>
                    <option value="3 anos">3 anos</option>
                    <option value="4 anos">4 anos</option>
                    <option value="+ de 5 anos">+ de 5 anos</option>
                </select>
                <select class="form-field flex-1" name="vacinacao" id="vacinacao">
                    <option value="">Vacinação</option>
                    <option value="Completamente vacinado(a)">Completamente vacinado(a)</option>
                    <option value="Vacinas incompletas">Vacinas incompletas</option>
                    <option value="Não possuo informações">Não possuo informações</option>
                </select>
            </div>
            <div class="flex flex-col md:gap-2 sm:flex-row">
                <select class="form-field flex-1" name="status" id="status">
                    <option value="">Todos os status</option>
                    <option value="Doando">Doando</option>
                    <option value="Adotado">Adotado</option>
                    <option value="Abandonado">Abandonado</option>
                    <option value="Perdido">Perdido</option>
                    <option value="Maus-Tratos">Maus-Tratos</option>
                    <option value="Resgatado">Resgatado</option>
                </select>
                <select class="form-field flex-1" name="tempo" id="tempo">
                    <option value="">Ordenar por postagens</option>
                    <option value="data">Mais recentes</option>
                    <option value="id">Mais antigas</option>
                </select>
            </div>
            <div class="flex flex-col md:gap-2 sm:flex-row">
                <input class="form-field flex-1" type="text" name="endereco" placeholder="Todos as regiões" id="endereco" />
                <input class="form-field flex-1" type="text" name="descricao" placeholder="Pesquisa avançada" id="descricao" />
            </div>
            <br>
            <button name="Pesquisar" type="submit" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-size: 20px;font-family: 'Open Sans', sans-serif;"><img src="../../Assets/Imagens/Site/Imgs/esquerda.png" style="height:40px;width:40px"> &nbsp;&nbsp;&nbsp;&nbsp; Buscar &nbsp;&nbsp;&nbsp;&nbsp; <img src="../../Assets/Imagens/Site/Imgs/direita.png" style="height:40px;width:40px"></button>
        </form>
        <br>
        <?php
        if (mysqli_num_rows($result) < 1) {
        ?>
            <p align="center">Desculpe mais não temos nenhum animal cadastrado com essas características</p>
            <p align="center">Veja abaixo os animais que temos cadastrados</p>
            <br>
        <?php
            $sql = "SELECT * FROM anuncios WHERE status != 'naoverificado' ORDER BY data DESC";
            $result = $conexao->query($sql);
        }
        ?>
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
                                if ($status == "Doando") {
                                ?>
                                    <span style="background-color:blue;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Doando</span>
                                <?php
                                }
                                if ($status == "Adotado") {
                                ?>
                                    <span style="background-color:orange;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Adotado</span>
                                <?php
                                }
                                if ($status == "Abandonado") {
                                ?>
                                    <span style="background-color:purple;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Abandonado</span>
                                <?php
                                }
                                if ($status == "Encontrado") {
                                ?>
                                    <span style="background-color:green;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Encontrado</span>
                                <?php
                                }
                                if ($status == "Perdido") {
                                ?>
                                    <span style="background-color:yellow;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-black font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Perdido</span>
                                <?php
                                }
                                if ($status == "Maus-Tratos") {
                                ?>
                                    <span style="background-color:red;" class="absolute bottom-0 inset-x-0 bg-secondary text-center uppercase text-white font-bold py-2 bg-opacity-90 shadow text-sm sm:text-lg">Maus-Tratos</span>
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
                            <a class="font-normal hover:text-secondary" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">FIND PETS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../index.php#sobre">Sobre o projeto</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">PERFIL</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="/../../View/login.php">Login</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="/../../View/add.php">Cadastre-se</a>
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
                            <a class="font-normal hover:text-secondary" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">FIND PETS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../index.php#sobre">Sobre o projeto</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">ANIMAL</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../View/animal/add.php">Cadastrar animal</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">ANÚNCIOS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../View/user/meuspets.php">Meus anúncios</a>
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
                            <a class="font-normal hover:text-secondary" href="/../../View/user/perfil.php">Meu perfil</a>
                        </li>
                    </ul>
                <?php
                }
                ?>
            </div>
            <div class="flex flex-col mt-10 text-center items-center">
                <div><img loading="lazy" src="../../Assets/Imagens/Site/Imgs/Logo1.png" height="150px" width="150px"></div>
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
