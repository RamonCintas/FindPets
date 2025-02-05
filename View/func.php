<?php
session_start();
$controle = 0;
include_once('../Models/DbConfig.php');
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
    <title>Find Pets - Funcionalidades</title>
    <style>
        #perfil {
            border-radius: 50%;
            width: 38px;
            height: 38px;
        }

        body {
            background-color: #daeefe;
        }

        .body1 {
            background-image: url("../../Assets/Imagens/Site/Imgs/pet4.jpg");
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            height: 200px;
            width: 100%;
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
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/func.php">Funcionalidades</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                                <?php
                                }
                                if ($controle == 2) {
                                ?>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/func.php">Funcionalidades</a>
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
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/func.php">Funcionalidades</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/login.php">Entrar</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/add.php">Cadastre-se</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                    <?php
                    }
                    if ($controle == 2) {
                    ?>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/func.php">Funcionalidades</a>
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
        <div align="center">
            <div class="body1">
            </div>
            <h3 class="w3-text-black w3-padding-16"><img src="../../Assets/Imagens/Site/Imgs/mundo.png" style="height:35px;width:35px"> &nbsp;&nbsp;Funcionalidades</h3>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Cadastro de usuário / anúncio</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Edição de usuário / anúncio</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Exclusão de usuário / anúncio</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Login de usuário</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Responsivo para mobile</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Gerador de PDF</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Geolocalização em tempo real</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Envio de e-mail para recuperação de senha</div>
            <br>

            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Anúncio conectado com a API do WhatsApp</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Acessível na Língua brasileira de sinais (libras)</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Validações de CPF, CEP e Data de nascimento</div>
            <br>

            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Upload / capturar imagem com rastreio de geolocalização</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">Filtros de pesquisa em SQL para o banco de dados MySQL</div>
            <br>
            <h3 class="w3-text-black w3-padding-16"><img src="../../Assets/Imagens/Site/Imgs/ampliacao.png" style="height:35px;width:35px;"> &nbsp;&nbsp;Mais detalhes</h3>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">{ HTML | CSS | JavaScript | PHP | SQL }</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">{ Site hospedado }</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">{ CRUD }<br>(Create, Read, Update, Delete)</div>
            <br>
            <div class="w3-round-xlarge w3-blue" style="height:50%;width:100%">{ MVC }<br>(Model, View, Controller)</div>
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
                            <a class="font-normal hover:text-secondary" href="../../index.php">Pesquisar animais</a>
                        </li>
                    </ul>
                    <ul align="center" class="mt-5">
                        <li class="font-bold">FIND PETS</li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../View/sobre.php">Sobre o projeto</a>
                        </li>
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../View/func.php">Funcionalidades</a>
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
                        <li class="mt-1">
                            <a class="font-normal hover:text-secondary" href="../../View/func.php">Funcionalidades</a>
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
