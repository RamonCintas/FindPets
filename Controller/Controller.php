<?php
class Controller 
{ 
    public function logar() 
    {
        include_once('../Models/DbConfig.php');
        session_start();
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM usuarios WHERE email = '$email' and senha = '$senha'";
        $result = $conexao->query($sql);
        if (mysqli_num_rows($result) < 1) {
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            $mensagem = "Dados inválidos / Usuário não encontrado";
            echo "<script language='javascript'>";
            echo "alert('".$mensagem."');";
            echo "</script>";
        } else {
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            header('Location: ../../index.php');
        }
    }

    public function cadastrarusuario(){
        if (isset($_POST['Cadastrar'])) {
            $validaemail = $_POST['validaemail'];
            $validasenha = $_POST['validasenha'];
            $validardata = $_POST['validardata'];
            $validarCPF = $_POST['validarCPF'];
            if($validaemail == '1') {
                if($validasenha == '1') {
                    if($validardata == '1') {
                        if($validarCPF == '1') {
                            include_once('../Models/DbConfig.php');
                            $email = $_POST['email'];
                            $sql = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
                            $result = $conexao->query($sql);
                            if (mysqli_num_rows($result) < 1) {
                                $cpf = $_POST['cpf'];
                                $sql2 = "SELECT * FROM usuarios WHERE cpf LIKE '%$cpf%'";
                                $result2 = $conexao->query($sql2);
                                if (mysqli_num_rows($result2) < 1) {
                                    $target_dir = "../Assets/Imagens/Perfis/Uploads/";
                                    $target_file = $target_dir . uniqid() . basename($_FILES["foto"]["name"]);
                                    $uploadOk = 1;
                                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                    if (isset($_POST["submit"])) {
                                        $check = getimagesize($_FILES["foto"]["tmp_name"]);
                                        if ($check !== false) {
                                            echo "File is an image - " . $check["mime"] . ".";
                                            $uploadOk = 1;
                                        } else {
                                            echo "File is not an image.";
                                            $uploadOk = 0;
                                        }
                                    }
                                    if (file_exists($target_file)) {
                                        $mensagem = "Desculpe o nome da sua imagem já existe";
                                        echo "<script language='javascript'>";
                                        echo "alert('".$mensagem."');";
                                        echo "</script>";
                                        $uploadOk = 0;
                                    }
                                    if ($_FILES["fileToUpload"]["size"] > 2000) {
                                        $mensagem = "Desculpe sua imagem é maior que 2mb";
                                        echo "<script language='javascript'>";
                                        echo "alert('".$mensagem."');";
                                        echo "</script>";
                                        $uploadOk = 0;
                                    }
                                    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "webp" && $imageFileType != "avif") {
                                        $mensagem = "Desculpe apenas imagem do tipo: JPG, JPEG, PNG, WEBP, AVIF";
                                        echo "<script language='javascript'>";
                                        echo "alert('".$mensagem."');";
                                        echo "</script>";
                                        $uploadOk = 0;
                                    }
                                    if ($uploadOk == 0) {
                                        $mensagem = "Desculpe sua imagem não foi enviada";
                                        echo "<script language='javascript'>";
                                        echo "alert('".$mensagem."');";
                                        echo "</script>";
                                        echo "Sorry, your file was not uploaded.";
                                    } else {
                                        if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                                            echo "The file " . htmlspecialchars(basename($_FILES["foto"]["name"])) . " has been uploaded.";
                                            $nome = ($_POST['nome']);
                                            $email = ($_POST['email']);
                                            $senha = ($_POST['senha']);
                                            $telefonec = ($_POST['telefonec']);
                                            $sexo = ($_POST['sexo']);
                                            $datanasc = ($_POST['datanasc']);
                                            $cep = ($_POST['cep']);
                                            $rua = ($_POST['rua']);
                                            $numero = ($_POST['numero']);
                                            $bairro = ($_POST['bairro']);
                                            $cidade = ($_POST['cidade']);
                                            $estado = ($_POST['estado']);
                                            $cpf = ($_POST['cpf']);
                                            $foto = ($target_file);
                                            $sql1 = ("INSERT INTO usuarios(nome,email,senha,telefonec,sexo,datanasc,cep,rua,numero,bairro,cidade,estado,cpf,foto) VALUES('$nome','$email','$senha','$telefonec','$sexo','$datanasc','$cep','$rua','$numero','$bairro','$cidade','$estado','$cpf','$foto')");
                                            $result1 = $conexao->query($sql1);
                                            header("Location:../../View/login.php");
                                        } else {
                                            echo "Sorry, there was an error uploading your file.";
                                        }
                                    }
                                } else {
                                    $mensagem = "cpf já está em uso";
                                    echo "<script language='javascript'>";
                                    echo "alert('".$mensagem."');";
                                    echo "</script>";
                                }
                            } else {
                                $mensagem = "Email já está em uso";
                                echo "<script language='javascript'>";
                                echo "alert('".$mensagem."');";
                                echo "</script>";
                            }
                        } else {
                            $mensagem4 = "CPF inválido!";
                            echo "<script language='javascript'>";
                            echo "alert('".$mensagem4."');";
                            echo "</script>";
                        }
                    } else {
                        $mensagem3 = "Pessoas menores de 18 e maiores de 100 não podem se cadastrar!";
                        echo "<script language='javascript'>";
                        echo "alert('".$mensagem3."');";
                        echo "</script>";
                    }
                } else {
                    $mensagem2 = "Senhas diferentes!";
                    echo "<script language='javascript'>";
                    echo "alert('".$mensagem2."');";
                    echo "</script>";
                    if($validasenha == '2') {
                        $mensagem2 = "Senha fraca! A senha deve ter pelo menos 12 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.";
                        echo "<script language='javascript'>";
                        echo "alert('".$mensagem2."');";
                        echo "</script>";
                    }
                }
            } else {
                $mensagem1 = "E-mails diferentes!";
                echo "<script language='javascript'>";
                echo "alert('".$mensagem1."');";
                echo "</script>";
            } 
        }
    }
}
?>
