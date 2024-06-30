<?php
session_start();
$controle = 0;
include_once('../../Models/DbConfig.php');
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    $controle = 1;
    header("Location:../../View/login.php");
} else {
    $email = $_SESSION['email'];
    $controle = 2;
    $sql = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
    $result = $conexao->query($sql);
    while ($user_data = mysqli_fetch_assoc($result)) {
        $image2 = "../../" . $user_data['foto'];
        $id2 = $user_data['id'];
    }
}
?>

<?php
if (!empty($_GET['id'])) {
    $id = $_GET['id'];
    $sqlSelect = "SELECT * FROM anuncios WHERE id=$id";
    $result = $conexao->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $nome = $user_data['nome'];
            $parentesco = $user_data['parentesco'];
            $descricao = $user_data['descricao'];
            $idade = $user_data['idade'];
            $vacinacao = $user_data['vacinacao'];
            $sexo = $user_data['sexo'];
            $saude = $user_data['saude'];
            $cpf = $user_data['cpf'];
            $endereco = $user_data['endereco'];
            $coordenada = $user_data['coordenada'];
            $status = $user_data['status'];
            $sentinelaanuncio = $user_data['sentinelaanuncio'];
            $tipo = $user_data['tipo'];
            $data = $user_data['data'];
            $hora = $user_data['hora'];
        }
    } else {
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../../index.php');
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
    <title>Find Pets - Pet perfil</title>
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
            height: 400px;
            width: 100%;
        }

        #container {
            height: 100%;
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
        <div align="center">
            <form action="pet.php" method="POST">
                <button type="submit" name="delete" id="delete" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-size: 20px;font-family: 'Open Sans', sans-serif;">Deletar anúncio</button>
                <input type="hidden" name="id" value="<?php echo $id; ?>">
            </form>

            <form action="pet.php" method="POST" enctype="multipart/form-data">
                <div align="left" class="form-field">
                    <br>
                    <h1 class="text-center" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Dados do pet</h1>
                    <br>
                    <p>Nome do animal*</p>
                    <input style="font-size: 20px;font-family: 'Open Sans', sans-serif;" type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>
                    <br>
                    <p>Descrição*</p>
                    <textarea type="text" name="descricao" id="descricao" rows="5" cols="50" input required><?php echo $descricao; ?></textarea>
                    <br>
                    <p>Idade*</p>
                    <select name="idade" id="idade" required="required">
                        <option style='color:black;' value="<?php echo $idade; ?>"><?php echo $idade; ?></option>
                        <option style='color:black;' value="- de 1 ano">- de 1 ano</option>
                        <option style='color:black;' value="1 ano">1 ano</option>
                        <option style='color:black;' value="2 anos">2 anos</option>
                        <option style='color:black;' value="3 anos">3 anos</option>
                        <option style='color:black;' value="4 anos">4 anos</option>
                        <option style='color:black;' value="+ de 5 anos">+ de 5 anos</option>
                    </select>
                    <br>
                    <p>Vacinação*</p>
                    <select name="vacinacao" id="vacinacao" required="required">
                        <option style='color:black;' value="<?php echo $vacinacao; ?>"><?php echo $vacinacao; ?></option>
                        <option style='color:black;' value="Completamente vacinado(a)">Completamente vacinado(a)</option>
                        <option style='color:black;' value="Vacinas incompletas">Vacinas incompletas</option>
                        <option style='color:black;' value="Não possuo informações">Não possuo informações</option>
                    </select>
                    <br>
                    <p>Estado de Saúde*</p>
                    <input type="text" name="saude" id="saude" value="<?php echo $saude; ?>" required>
                    <br>
                    <p>Status:*</p>
                    <p>Doando <input type="radio" id="status" name="status" value="Doando" <?php echo ($status == 'Doando') ? 'checked' : ''; ?> required></p>
                    <p>Adotado <input type="radio" id="status" name="status" value="Adotado" <?php echo ($status == 'Adotado') ? 'checked' : ''; ?> required></p>
                    <p>Maus-Tratos <input type="radio" id="status" name="status" value="Maus-Tratos" <?php echo ($status == 'Maus-Tratos') ? 'checked' : ''; ?> required></p>
                    <p>Resgatado <input type="radio" id="status" name="status" value="Resgatado" <?php echo ($status == 'Resgatado') ? 'checked' : ''; ?> required></p>
                    <p>Abandonado <input type="radio" id="status" name="status" value="Abandonado" <?php echo ($status == 'Abandonado') ? 'checked' : ''; ?> required></p>
                    <p>Perdido <input type="radio" id="status" name="status" value="Perdido" <?php echo ($status == 'Perdido') ? 'checked' : ''; ?> required></p>
                    <p>Encontrado <input type="radio" id="status" name="status" value="Encontrado" <?php echo ($status == 'Encontrado') ? 'checked' : ''; ?> required></p>
                    <br>
                    <p>Verificação</p>
                    <input type="text" name="sentinelaanuncio" id="sentinelaanuncio" value="<?php echo $sentinelaanuncio; ?>" readonly required>
                    <p>Grau de parentesco com o Pet</p>
                    <input type="text" name="parentesco" id="parentesco" value="<?php echo $parentesco; ?>" readonly required>
                    <br>
                    <p>Endereço</p>
                    <input type="text" name="endereco" id="endereco" value="<?php echo $endereco; ?>" readonly required>
                    <br>
                    <p>Data</p>
                    <input type="text" name="data" id="data" value="<?php echo $data; ?>" readonly required>
                    <br>
                    <p>Hora</p>
                    <input type="text" name="hora" id="hora" value="<?php echo $hora; ?>" readonly required>
                    <br>
                    <p>Geolocalização</p>
                    <input type="text" name="coordenada" id="coordenada" value="<?php echo $coordenada; ?>" readonly required>
                    <br>
                    <p>CPF</p>
                    <input type="text" name="cpf" id="cpf" value="<?php echo $cpf; ?>" readonly required>
                    <br>
                    <p>Sexo</p>
                    <input type="text" name="sexo" id="sexo" value="<?php echo $sexo; ?>" readonly required>
                    <br>
                    
                    <p>Tipo</p>
                    <input type="text" name="tipo" id="tipo" value="<?php echo $tipo; ?>" readonly required>
                    <br>
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <button type="submit" name="update" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-size: 20px;font-family: 'Open Sans', sans-serif;">Atualizar anúncio</button>
                </div>
            </form>


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

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $parentesco = $_POST['parentesco'];
    $descricao = $_POST['descricao'];
    $idade = $_POST['idade'];
    $vacinacao = $_POST['vacinacao'];
    $sexo = $_POST['sexo'];
    $saude = $_POST['saude'];
    $status = $_POST['status'];
    $sentinelaanuncio = $_POST['sentinelaanuncio'];
    $tipo = $_POST['tipo'];
    $endereco = $_POST['endereco'];
    $coordenada = $_POST['coordenada'];

    $sqlInsert = "UPDATE anuncios SET nome='$nome',sentinelaanuncio='$sentinelaanuncio',descricao='$descricao',parentesco='$parentesco',idade='$idade',vacinacao='$vacinacao',sexo='$sexo',saude='$saude',endereco='$endereco',coordenada='$coordenada',status='$status',tipo='$tipo' WHERE id=$id";
    $result = $conexao->query($sqlInsert);
}
header('Location:../../index.php');

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    $sqlSelect = "SELECT * FROM anuncios WHERE id=$id";
    $result = $conexao->query($sqlSelect);

    if ($result->num_rows > 0) {
        $sqlDelete = "DELETE FROM anuncios WHERE id=$id;";
        $resultDelete = $conexao->query($sqlDelete);
    }
    $sqlOrdem = "ALTER TABLE anuncios AUTO_INCREMENT = 0;";
    $resultOrdem = $conexao->query($sqlOrdem);
}
header('Location:../../index.php');

?>
