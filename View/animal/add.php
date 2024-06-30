<?php

if (!empty($_GET['status'])) {
    $statusselecionado = $_GET['status'];
}

date_default_timezone_set('America/Sao_Paulo');

session_start();
include_once('../../Models/DbConfig.php');
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['senha']) == true)) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header("Location:../../View/login.php");
} else {
    $email = $_SESSION['email'];
    $sql = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
    $result = $conexao->query($sql);
    while ($user_data = mysqli_fetch_assoc($result)) {
        $image = "../../" . $user_data['foto'];
        $id = $user_data['id'];
        $cpf = $user_data['cpf'];
        $cidade = $user_data['cidade'];
        $estado = $user_data['estado'];

        $data = date('d/m/y');
        $hora = date('H:i:s');
    }
}

?>

<?php

if (isset($_POST['Cadastrar'])) {
    $target_dir = "../../Assets/Imagens/Anuncios/Uploads/";
    $target_file = $target_dir . uniqid() . basename($_FILES["foto"]["name"]);
    
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["foto"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
            echo "The file ". htmlspecialchars( basename( $_FILES["foto"]["name"])). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    $cpf = ($_POST['cpf']);
    $endereco = $_POST['endereco'];
    $coordenada = $_POST['coordenada'];
    $status = ($_POST['status']);
    $parentesco = ($_POST['parentesco']);
    $descricao = ($_POST['descricao']);
    $nome = ($_POST['nome']);
    $idade = ($_POST['idade']);
    $vacinacao = ($_POST['vacinacao']);
    $sexo = ($_POST['sexo']);
    $saude = ($_POST['saude']);
    $tipo = ($_POST['tipo']);
    $data = ($_POST['data']);
    $hora = ($_POST['hora']);
    $imagem = ($target_file);

    $sql1 = "INSERT INTO anuncios(cpf, endereco, coordenada, status, parentesco, descricao, nome, idade, vacinacao, sexo, saude, tipo, data, hora, imagem) VALUES('$cpf','$endereco','$coordenada','$status','$parentesco','$descricao','$nome','$idade','$vacinacao','$sexo','$saude','$tipo','$data','$hora','$imagem')";
    $result1 = $conexao->query($sql1);
    header("Location:../../View/animal/anuncios.php");
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
    <title>Find Pets - Cadastrar animal</title>
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
    <div>
        <div class="flex justify-center">
            <div class="w-full min-h-screen flex justify-end">
                <div class="fixed inset-0 bg-gray-400 hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat rounded-l-lg" style="background-image: url('../../Assets/Imagens/Site/Imgs/estrelas.gif');">
                    <div class="fixed inset-0 bg-gray-400 hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat rounded-l-lg" style="background-image: url('../../Assets/Imagens/Site/Imgs/pet3.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;opacity: 0.5;">
                    </div>
                </div>
                <div class="w-full flex flex-col justify-center p-2 lg:w-1/2 lg:p-10 rounded-lg lg:rounded-l-none">
                    <div class="text-2xl text-center mt-5">
                        <a href="../../index.php">
                            <img class="mx-auto" src="../../Assets/Imagens/Site/Imgs/Logo1.png" style="width: 250px;height: 250px;">
                        </a>
                        <h1 class="text-center">Cadastro do pet</h1>
                        <p>Seu e-mail, endereço e whatsapp irão aparecer no anúncio do pet</p>
                    </div>
                    <form action="add.php" method="POST" enctype="multipart/form-data" class="bg-white p-10 mt-10 rounded-lg shadow mx-auto w-full max-w-md">
                        <br>
                        <a class="block relative">
                            <?php
                            if ($statusselecionado == "Doando") {
                            ?>
                                <span style="background-color:#daeefe;color:black;" class="absolute bottom-0 inset-x-0 py-2 uppercase">
                                    <center>Doando</center>
                                </span>
                            <?php
                            }
                            if ($statusselecionado == "Abandonado") {
                            ?>
                                <span style="background-color:#daeefe;color:black;" class="absolute bottom-0 inset-x-0 py-2 uppercase">
                                    <center>Abandonado</center>
                                </span>
                            <?php
                            }
                            if ($statusselecionado == "Perdido") {
                            ?>
                                <span style="background-color:#daeefe;color:black;" class="absolute bottom-0 inset-x-0 py-2 uppercase">
                                    <center>Perdido</center>
                                </span>
                            <?php
                            }
                            if ($statusselecionado == "Maus-Tratos") {
                            ?>
                                <span style="background-color:#daeefe;color:black;" class="absolute bottom-0 inset-x-0 py-2 uppercase">
                                    <center>Maus-Tratos</center>
                                </span>
                            <?php
                            }
                            if ($statusselecionado == "") {
                            ?>
                                <span style="background-color:#daeefe;color:black;" class="absolute bottom-0 inset-x-0 py-2 uppercase">
                                    <center>Dados do animal</center>
                                </span>
                            <?php
                            }
                            ?>
                        </a>

                        <div class="form-field">
                            <p>Nome do animal</p>
                            <input type="text" name="nome" id="nome" required>
                        </div>

                        <div class="form-field">
                            <p>Descrição</p>
                            <textarea type="text" name="descricao" id="descricao" rows="4" cols="54" input required></textarea>
                        </div>

                        <div class="form-field">
                            <p>Estado de Saúde</p>
                            <input type="text" name="saude" id="saude" required>
                        </div>

                        <div class="form-field">
                            <select name="idade" id="idade" required>
                                <option style='color:black;' value="">Idade</option>
                                <option style='color:black;' value="- de 1 ano">- de 1 ano</option>
                                <option style='color:black;' value="1 ano">1 ano</option>
                                <option style='color:black;' value="2 anos">2 anos</option>
                                <option style='color:black;' value="3 anos">3 anos</option>
                                <option style='color:black;' value="4 anos">4 anos</option>
                                <option style='color:black;' value="+ de 5 anos">+ de 5 anos</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <select name="vacinacao" id="vacinacao" required>
                                <option style='color:black;' value="">Vacinação</option>
                                <option style='color:black;' value="Completamente vacinado(a)">Completamente vacinado(a)</option>
                                <option style='color:black;' value="Vacinas incompletas">Vacinas incompletas </option>
                                <option style='color:black;' value="Não possuo informações">Não possuo informações </option>
                            </select>
                        </div>

                        <div class="form-field">
                            <select name="parentesco" id="parentesco" required>
                                <option style='color:black;' value="">Grau de parentesco</option>
                                <option style='color:black;' value="Dono(a) do animal">Dono(a) </option>
                                <option style='color:black;' value="Animal resgatado">Responsável Temporário do Pet </option>
                                <option style='color:black;' value="Alguém que se importa com o Pet">Alguém que se importa com o Pet</option>
                            </select>
                        </div>



                        <div class="container">
                            <br>
                            <div class="divleft">
                                <div>
                                    <label for="Macho">Macho <input type="radio" id="sexo" name="sexo" value="Macho" required></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="Femea">Fêmea <input type="radio" id="sexo" name="sexo" value="Fêmea" required></label>
                                </div>
                            </div>
                            <br>
                            <div class="divright">
                                <div>
                                    <label for="Cachorro">Cachorro <input type="radio" id="tipo" name="tipo" value="Cachorro" required></label>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <label for="Gato">Gato <input type="radio" id="tipo" name="tipo" value="Gato" required></label>
                                </div>

                            </div>
                        </div>

                        <?php
                        if ($statusselecionado == "") {
                        ?>
                            <div class="form-field">
                                <p>Status:</p>
                                <p>Doando <input type="radio" id="status" name="status" value="Doando" <?php echo ($status == 'Doando') ? 'checked' : ''; ?> required></p>
                                <p>Abandonado <input type="radio" id="status" name="status" value="Abandonado" <?php echo ($status == 'Abandonado') ? 'checked' : ''; ?> required></p>
                                <p>Perdido <input type="radio" id="status" name="status" value="Perdido" <?php echo ($status == 'Perdido') ? 'checked' : ''; ?> required></p>
                                <p>Maus-Tratos <input type="radio" id="status" name="status" value="Maus-Tratos" <?php echo ($status == 'Maus-Tratos') ? 'checked' : ''; ?> required></p>
                            </div>
                        <?php
                        }
                        ?>
                        <div class="form-field">
                            <p>Imagem do animal</p>
                            <input type="file" name="foto" id="foto" required>
                        </div>

                        <div class="form-field">
                            <p>Ative e permita o acesso a localição do dispositivo e aperte o botão abaixo</p>
                            <br>
                            <input type="text" style="font-size: 20px;font-family: 'Open Sans', sans-serif; text-align:center;" onclick="getLocation()" value="Buscar local atual" id="submit" readonly>
                            <br>
                            <p>Localização do cadastro do animal</p>
                            <input type="text" name="coordenada" id="coordenada" required>
                        </div>
                        <script>
                            var inputNome = document.querySelector("coordenada");
                            coordenada.addEventListener("textInput", function(e) {
                                var keyCode = (e.keyCode ? e.keyCode : e.which);

                                if (keyCode < 255) {
                                    e.preventDefault();
                                }
                            });

                            var x = document.getElementById("coordenada");

                            function getLocation() {
                                if (navigator.geolocation) {
                                    navigator.geolocation.getCurrentPosition(showPosition, showError);
                                } else {
                                    x.innerHTML = "Seu browser não suporta Geolocalização.";
                                }
                            }

                            function showPosition(position) {
                                x.innerHTML = "Latitude: " + position.coords.latitude + "<br>Longitude: " + position.coords.longitude;
                                document.getElementById("coordenada").value = x.innerHTML = position.coords.latitude + ", " + position.coords.longitude;
                                const localinput = document.getElementById("coordenada");
                                localinput.setAttribute("readonly", true);
                            }

                            function showError(error) {
                                switch (error.code) {
                                    case error.PERMISSION_DENIED:
                                        x.innerHTML = "Usuário rejeitou a solicitação de Geolocalização."
                                        break;
                                    case error.POSITION_UNAVAILABLE:
                                        x.innerHTML = "Localização indisponível."
                                        break;
                                    case error.TIMEOUT:
                                        x.innerHTML = "A requisição expirou."
                                        break;
                                    case error.UNKNOWN_ERROR:
                                        x.innerHTML = "Algum erro desconhecido aconteceu."
                                        break;
                                }
                            }
                        </script>
                        <?php
                        if ($statusselecionado != "") {
                        ?>
                            <input type="hidden" name="status" id="status" value="<?php echo $statusselecionado; ?>" required>
                        <?php
                        }
                        ?>
                        <input type="hidden" name="data" id="data" value="<?php echo $data; ?>" required>
                        <input type="hidden" name="hora" id="hora" value="<?php echo $hora; ?>" required>
                        <input type="hidden" name="endereco" id="endereco" value="<?php echo $cidade . ", " . $estado; ?>" required>
                        <input type="hidden" name="cpf" id="cpf" value="<?php echo $cpf; ?>" required>

                        <div align="center">
                            <div class="elementExample elementExample_first">
                                <input type="submit" name="Cadastrar" style="font-weight: bold; color: white;" value="Cadastrar" id="submit">
                            </div>
                            <div class="elementExample elementExample_last">
                                <button id="quadrado" name="Cadastrar" value="Enviar">
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
                                <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="anuncios.php">Ver pets já cadastrados</a>
                                <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="../../View/user/meuspets.php">Ver seus pets cadastrados</a>
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