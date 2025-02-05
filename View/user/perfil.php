<?php
session_start();
$controle = 0;
include_once('../../Models/DbConfig.php');


$specifiedEmail = 'ramoncg.oficial2018@gmail.com';

if (isset($_SESSION['email']) && $_SESSION['email'] === $specifiedEmail) {
    $email = $_SESSION['email'];
    $controle = 3;
    $sql = "SELECT * FROM usuarios WHERE email = ?";
    
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($user_data = $result->fetch_assoc()) {
        $image2 = "../../" . $user_data['foto'];
        $id2 = $user_data['id'];
    }
} else {
    if (!isset($_SESSION['email']) || !isset($_SESSION['senha'])) {
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        $controle = 1;
        header("Location: ../../View/login.php");
    } else {
        $email = $_SESSION['email'];
        $controle = 2;
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($user_data = $result->fetch_assoc()) {
            $image2 = "../../" . $user_data['foto'];
            $id2 = $user_data['id'];
        }
    }
}

?>



<?php
$sqlSelect = "SELECT * FROM usuarios WHERE id=$id2";
$result = $conexao->query($sqlSelect);
if ($result->num_rows > 0) {
    while ($user_data = mysqli_fetch_assoc($result)) {
        $nome = $user_data['nome'];
        $senha = $user_data['senha'];
        $email = $user_data['email'];
        $telefonec = $user_data['telefonec'];
        $sexo = $user_data['sexo'];
        $datanasc = $user_data['datanasc'];
        $cpf = $user_data['cpf'];
        $cep = $user_data['cep'];
        $rua = $user_data['rua'];
        $numero = $user_data['numero'];
        $bairro = $user_data['bairro'];
        $cidade = $user_data['cidade'];
        $estado = $user_data['estado'];
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
    <title>Find Pets - Perfil</title>
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
                                if ($controle == 3) {
                                ?>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/perfil.php">Meu perfil</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/add.php">Cadastrar animal</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/meuspets.php">Meus anúncios</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                                    <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/sentinelapets.php">Verificar pets</a>
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
                            if ($controle == 2 || $controle == 3) {
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
                    if ($controle == 3) {
                    ?>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/perfil.php">Meu perfil</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/add.php">Cadastrar animal</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/meuspets.php">Meus anúncios</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/animal/anuncios.php">Pesquisar animais</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../index.php#sobre">Sobre o projeto</a>
                        <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/sentinelapets.php">Verificar pets</a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </nav>
    </header>

    <main role="main" class="flex-grow container max-w-7xl mx-auto px-2 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <div align="left">
            <form action="../../index.php" method="POST">
                <button type="submit" name="sair" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff; font-size: 20px;font-family: 'Open Sans', sans-serif;">Sair da conta</button>
            </form>

            <form action="perfil.php" method="POST" enctype="multipart/form-data">
                <div class="form-field">
                    <br>
                    <h1 class="text-center" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Dados da conta</h1>
                    <br>
                    <p>Nome completo*</p>
                    <input type="text" name="nome" id="nome" value="<?php echo $nome; ?>" required>
                    <br>
                    <p>Senha*</p>
                    <input type="password" name="senha" id="senha" value="<?php echo $senha; ?>" required>
                    <br>
                    <p>WhatsApp*</p>
                    <input type="text" name="telefonec" id="telefonec" value="<?php echo $telefonec; ?>" required>
                    <br>
                    <p>Sexo:*</p>
                    <p>Feminino <input type="radio" id="feminino" name="sexo" value="feminino" <?php echo ($sexo == 'feminino') ? 'checked' : ''; ?> required></p>
                    <p>Masculino <input type="radio" id="masculino" name="sexo" value="masculino" <?php echo ($sexo == 'masculino') ? 'checked' : ''; ?> required></p>
                    <br>
                    <p>E-mail</p>
                    <input type="text" name="email" id="email" value="<?php echo $email; ?>" readonly required>
                    <br>
                    <p>CPF</p>
                    <input id="cpf" name="cpf" type="text" value="<?php echo $cpf; ?>" readonly required>
                    <br>
                    <p>Data de Nascimento</p>
                    <input type="text" name="datanasc" id="datanasc" value="<?php echo $datanasc; ?>" readonly required>
                    <br>
                    <p>CEP</p>
                    <input type="text" name="cep" id="cep" value="<?php echo $cep; ?>" readonly required>
                    <br>
                    <p>Rua</p>
                    <input type="text" name="rua" id="rua" value="<?php echo $rua; ?>" readonly required>
                    <br>
                    <p>Número</p>
                    <input type="text" name="numero" id="numero" value="<?php echo $numero; ?>" readonly required>
                    <br>
                    <p>Bairro</p>
                    <input type="text" name="bairro" id="bairro" value="<?php echo $bairro; ?>" readonly required>
                    <br>
                    <p>Cidade</p>
                    <input type="text" name="cidade" id="cidade" value="<?php echo $cidade; ?>" readonly required>
                    <br>
                    <p>Estado</p>
                    <input type="text" name="estado" id="estado" value="<?php echo $estado; ?>" readonly required>
                    <br><br>
                    <input type="hidden" name="id" value="<?php echo $id2; ?>">
                    <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                    <button type="submit" name="update" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-size: 20px;font-family: 'Open Sans', sans-serif;">Atualizar conta</button>
                </div>
            </form>

            <form action="../../index.php" method="POST">
                <br><br>
                <input type="hidden" name="id" value="<?php echo $id2; ?>">
                <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                <button type="submit" name="delete" id="delete" class="primary-button w-full hover:text-secondary" style="background-color: #0091ff;font-size: 20px;font-family: 'Open Sans', sans-serif;">Deletar conta</button>
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
                if ($controle == 3) {
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
                    <ul align="center" class="mt-5">
                        <li class="font-bold">Administração</li>
                        <li class="mt-1">
                            <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/sentinelapets.php">Verificar pets</a>
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
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefonec = $_POST['telefonec'];
    $sexo = $_POST['sexo'];
    $datanasc = $_POST['datanasc'];
    $cpf = $_POST['cpf'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $sqlInsert = "UPDATE usuarios 
        SET nome='$nome',senha='$senha',email='$email',telefonec='$telefonec',sexo='$sexo',datanasc='$datanasc',cpf='$cpf',cep='$cep',rua='$rua',numero='$numero',bairro='$bairro',cidade='$cidade',estado='$estado' WHERE id=$id";
    $result = $conexao->query($sqlInsert);
    header('Location:../../index.php');
}
?>
