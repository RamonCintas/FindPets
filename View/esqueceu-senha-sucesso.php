<?php
if (!empty($_POST['email'])) {
    include_once('../Models/DbConfig.php');
    $email = $_POST['email'];
    $sqlSelect = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
    $result = $conexao->query($sqlSelect);
    if ($result->num_rows > 0) {
        while ($user_data = mysqli_fetch_assoc($result)) {
            $controle = "E-mail informado encontrado";
            $botao = "Enviar e-mail";
            $endereco = "https://formsubmit.co/findpets.global@gmail.com";
            $endereco2 = "https://find-pets.infinityfreeapp.com/View/login.php";
            $nome = $user_data['nome'];
            $senha = $user_data['senha'];
            $email = $user_data['email'];
        }
    } else {
        $controle = "E-mail informado não encontrado";
        $botao = "Voltar";
        $endereco = "https://find-pets.infinityfreeapp.com/View/esqueceu-senha.php";
        $endereco2 = "";
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
    <title>Find Pets - Esqueceu senha</title>
    <style>
        body {
            background-color: #daeefe;
        }

        .elementExample {
            width: 200px;
            line-height: 50px;
            position: relative;
        }

        .elementExample_first {
            top: 75px;
        }

        #quadrado {
            position: relative;
            overflow: hidden;
            width: 95%;
            height: 70px;
        }

        #quadrado span {
            position: absolute;
        }

        #quadrado span:nth-child(1) {
            height: 3px;
            width: 200px;
            top: 0px;
            left: -200px;
            background: linear-gradient(to right, rgba(0, 0, 0, 0), #f6e58d);
            animation: span1 2s linear infinite;
            animation-delay: 1s;
        }

        @keyframes span1 {
            0% {
                left: -200px;
            }

            100% {
                left: 200px;
            }
        }

        #quadrado span:nth-child(2) {
            height: 70px;
            width: 3px;
            top: -70px;
            right: 0px;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), #f6e58d);
            animation: span2 2s linear infinite;
            animation-delay: 2s;
        }

        @keyframes span2 {
            0% {
                top: -70px;
            }

            100% {
                top: 70px;
            }
        }

        #quadrado span:nth-child(3) {
            height: 3px;
            width: 200px;
            right: -200px;
            bottom: 0px;
            background: linear-gradient(to left, rgba(0, 0, 0, 0), #f6e58d);
            animation: span3 2s linear infinite;
            animation-delay: 3s;
        }

        @keyframes span3 {
            0% {
                right: -200px;
            }

            100% {
                right: 200px;
            }
        }

        #quadrado span:nth-child(4) {
            height: 70px;
            width: 5px;
            bottom: -70px;
            left: 0px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0), #f6e58d);
            animation: span4 2s linear infinite;
            animation-delay: 4s;
        }

        @keyframes span4 {
            0% {
                bottom: -70px;
            }

            100% {
                bottom: 70px;
            }
        }

        #quadrado:hover span {
            animation-play-state: paused;
        }
    </style>
</head>

<body>
    <div>
        <div class="flex justify-center">
            <div class="w-full min-h-screen flex justify-end">
                <div class="fixed inset-0 bg-gray-400 hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat rounded-l-lg" style="background-image: url('../../Assets/Imagens/Site/Imgs/estrelas.gif');">
                    <div class="fixed inset-0 bg-gray-400 hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat rounded-l-lg" style="background-image: url('../../Assets/Imagens/Site/Imgs/pet6.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;opacity: 0.5;">
                    </div>
                </div>
                <div class="w-full flex flex-col justify-center p-2 lg:w-1/2 lg:p-10 rounded-lg lg:rounded-l-none">
                    <div class="text-2xl text-center mt-5">
                        <a href="../../index.php">
                            <img class="mx-auto" src="../../Assets/Imagens/Site/Imgs/Logo1.png" style="width: 250px;height: 250px;">
                        </a>
                        <h1 class="text-center" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Recuperar senha</h1>
                    </div>
                    <form action="<?php echo $endereco; ?>" class="bg-white p-10 mt-10 rounded-lg shadow mx-auto w-full max-w-md" method="POST">
                        <input type="hidden" name="_next" value="<?php echo $endereco2; ?>" />
                        <input type="hidden" name="_captcha" value="false" />
                        <input type="hidden" name="_template" value="table">
                        <input type="hidden" name="Assunto:" value="Recuperar senha" />
                        <input type="hidden" name="_cc" value="<?php echo $email; ?>">
                        <input type="hidden" name="Nome:" value="<?php echo $nome; ?>" />
                        <input type="hidden" name="E-mail:" value="<?php echo $email; ?>" />
                        <input type="hidden" name="Senha:" value="<?php echo $senha; ?>" />
                        <div class="form-field" align="center">
                            <h1><?php echo $controle; ?></h1>
                        </div>
                        <div align="center">
                            <div class="elementExample elementExample_first">
                                <input type="submit" style="font-weight: bold; color: white;font-size: 20px;font-family: 'Open Sans', sans-serif;" value="<?php echo $botao; ?>" id="submit">
                            </div>
                            <div class="elementExample elementExample_last">
                                <button id="quadrado">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </button>
                            </div>
                            <br>
                            <br>

                            <div class="divider"></div>
                            <div class="flex flex-col text-center">
                                <br>
                                <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="login.php" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Já tem conta?</a>
                                <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="add.php" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Crie sua conta?</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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