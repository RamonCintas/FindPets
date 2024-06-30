<?php
if (isset($_POST['Cadastrar'])) {
    include_once '../Controller/Controller.php';
    $cadastrarusuarioController = new Controller();
    $cadastrarusuarioController->cadastrarusuario();
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
    <title>Find Pets - Cadastro de usuário</title>
    <script>
        function buscaCep() {
            let cep = document.getElementById('cep').value;
            if (cep !== "") {
                let url = "https://brasilapi.com.br/api/cep/v1/" + cep;
                let req = new XMLHttpRequest();
                req.open("GET", url);
                req.send();
                req.onload = function() {
                    if (req.status === 200) {
                        let endereco = JSON.parse(req.response);
                        document.getElementById("rua").value = endereco.street;
                        document.getElementById("bairro").value = endereco.neighborhood;
                        document.getElementById("cidade").value = endereco.city;
                        document.getElementById("estado").value = endereco.state;
                    } else if (req.status === 404) {
                        alert("CEP inválido");
                    } else {
                        alert("Erro ao fazer a requisição do CEP");
                    }
                }
            }
        }
        window.onload = function() {
            let cep = document.getElementById("cep");
            cep.addEventListener("blur", buscaCep);
        }

        function is_cpf(c) {
            if ((c = c.replace(/[^\d]/g, "")).length != 11)
                return false
            if (c == "00000000000")
                return false;
            if (c == "11111111111")
                return false;
            if (c == "22222222222")
                return false;
            if (c == "33333333333")
                return false;
            if (c == "44444444444")
                return false;
            if (c == "55555555555")
                return false;
            if (c == "66666666666")
                return false;
            if (c == "77777777777")
                return false;
            if (c == "88888888888")
                return false;
            if (c == "99999999999")
                return false;
            var r;
            var s = 0;
            for (i = 1; i <= 9; i++)
                s = s + parseInt(c[i - 1]) * (11 - i);
            r = (s * 10) % 11;
            if ((r == 10) || (r == 11))
                r = 0;
            if (r != parseInt(c[9]))
                return false;
            s = 0;
            for (i = 1; i <= 10; i++)
                s = s + parseInt(c[i - 1]) * (12 - i);
            r = (s * 10) % 11;
            if ((r == 10) || (r == 11))
                r = 0;
            if (r != parseInt(c[10]))
                return false;
            return true;
        }

        function fMasc(objeto, mascara) {
            obj = objeto
            masc = mascara
            setTimeout("fMascEx()", 1)
        }

        function fMascEx() {
            obj.value = masc(obj.value)
        }

        function mCPF(cpf) {
            cpf = cpf.replace(/\D/g, "")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2")
            cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2")
            return cpf
        }
        cpfCheck = function(el) {
            document.getElementById('cpfResponse').innerHTML = is_cpf(el.value) ? '<span style="color:green">válido</span>' : '<span style="color:red">inválido</span>';
            is_cpf(el.value) ? validarCPF.setAttribute("value", '1') : validarCPF.setAttribute("value", '0');
            if (el.value == '') document.getElementById('cpfResponse').innerHTML = '';
        }

        function mascaraData(val) {
            var pass = val.value;
            var expr = /[0123456789]/;
            for (i = 0; i < pass.length; i++) {
                var lchar = val.value.charAt(i);
                var nchar = val.value.charAt(i + 1);
                if (i == 0) {
                    if ((lchar.search(expr) != 0) || (lchar > 3)) {
                        val.value = "";
                    }
                } else if (i == 1) {
                    if (lchar.search(expr) != 0) {
                        var tst1 = val.value.substring(0, (i));
                        val.value = tst1;
                        continue;
                    }
                    if ((nchar != '/') && (nchar != '')) {
                        var tst1 = val.value.substring(0, (i) + 1);
                        if (nchar.search(expr) != 0)
                            var tst2 = val.value.substring(i + 2, pass.length);
                        else
                            var tst2 = val.value.substring(i + 1, pass.length);
                        val.value = tst1 + '/' + tst2;
                    }
                } else if (i == 4) {
                    if (lchar.search(expr) != 0) {
                        var tst1 = val.value.substring(0, (i));
                        val.value = tst1;
                        continue;
                    }
                    if ((nchar != '/') && (nchar != '')) {
                        var tst1 = val.value.substring(0, (i) + 1);
                        if (nchar.search(expr) != 0)
                            var tst2 = val.value.substring(i + 2, pass.length);
                        else
                            var tst2 = val.value.substring(i + 1, pass.length);
                        val.value = tst1 + '/' + tst2;
                    }
                }
                if (i >= 6) {
                    if (lchar.search(expr) != 0) {
                        var tst1 = val.value.substring(0, (i));
                        val.value = tst1;
                    }
                }
            }
            if (pass.length > 10)
                val.value = val.value.substring(0, 10);
            return true;
        }

        function validadata() {
            var data = document.getElementById("datanasc").value;
            data.length;
            if (data != "" && data.length == 10) {
                data = data.replace(/\//g, "-");
                var data_array = data.split("-");
                if (data_array[0].length != 4) {
                    data = data_array[2] + "-" + data_array[1] + "-" + data_array[0];
                }
                var hoje = new Date();
                var nasc = new Date(data);
                var idade = hoje.getFullYear() - nasc.getFullYear();
                var m = hoje.getMonth() - nasc.getMonth();
                if (m < 0 || (m === 0 && hoje.getDate() < nasc.getDate())) idade--;
                if (idade < 18) {
                    document.getElementById('dataResponse1').innerHTML = '<span style="color:red">inválido</span>';
                    document.getElementById('dataResponse2').innerHTML = '<span style="color:red">Pessoas menores de 18 não podem se cadastrar.</span>';
                    validardata.setAttribute("value", '0');
                    return false;
                }
                if (idade >= 18 && idade <= 100) {
                    document.getElementById('dataResponse1').innerHTML = '<span style="color:green">válido</span>';
                    document.getElementById('dataResponse2').innerHTML = '<span style="color:green">Maior de 18, pode se cadastrar.</span>';
                    validardata.setAttribute("value", '1');
                    const datainput = document.getElementById("datanasc");
                    datainput.setAttribute("readonly", true);
                    return true;
                }
                if (idade > 100) {
                    document.getElementById('dataResponse1').innerHTML = '<span style="color:red">inválido</span>';
                    document.getElementById('dataResponse2').innerHTML = '<span style="color:red">Pessoas maiores de 100 não podem se cadastrar.</span>';
                    validardata.setAttribute("value", '0');
                    return false;
                }
            }
            data.addEventListener('input', validadata);
        }

        function validarSenha() {
            let senha = document.getElementById('senha').value;
            let senhaC = document.getElementById('senhaC').value;
            let validasenha = document.getElementById('validasenha');
            let senhaMsg = document.getElementById('senhas');
            
            const senhaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;

            if (!senhaRegex.test(senha)) {
                senhaMsg.innerHTML = '<span style="color:red">A senha deve ter pelo menos 12 caracteres, incluindo letras maiúsculas, minúsculas, números e caracteres especiais.</span>';
                validasenha.value = '2';
                return false;
            }
            
            if (senha !== senhaC) {
                senhaMsg.innerHTML = '<span style="color:red">Senhas diferentes!</span>';
                validasenha.value = '0';
                return false;
            } else {
                senhaMsg.innerHTML = '<span style="color:green">Senha confirmada</span>';
                validasenha.value = '1';
                return true;
            }
        }

        document.addEventListener('DOMContentLoaded', (event) => {
            document.getElementById('senhaC').addEventListener('input', validarSenha);
            document.getElementById('senha').addEventListener('input', validarSenha);
        });

        function validarEmail() {
            let email = document.getElementById('email');
            let emailC = document.getElementById('emailC');
            if (email.value != emailC.value) {
                document.getElementById('emails').innerHTML = '<span style="color:red">E-mails diferentes!</span>';
                validaemail.setAttribute("value", '0');
                return false;
            } else {
                document.getElementById('emails').innerHTML = '<span style="color:green">Email confirmado</span>';
                validaemail.setAttribute("value", '1');
                return true;
            }
            emailC.addEventListener('input', validarEmail);
        }
    </script>
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
                    <div class="fixed inset-0 bg-gray-400 hidden lg:block lg:w-1/2 bg-cover bg-center bg-no-repeat rounded-l-lg" style="background-image: url('../../Assets/Imagens/Site/Imgs/pet5.jpg'); background-repeat: no-repeat; background-size: cover; background-position: center;opacity: 0.5;">
                    </div>
                </div>
                <div class="w-full flex flex-col justify-center p-2 lg:w-1/2 lg:p-10 rounded-lg lg:rounded-l-none">
                    <div class="text-2xl text-center mt-5">
                        <a href="../../index.php">
                            <img class="mx-auto" src="../../Assets/Imagens/Site/Imgs/Logo1.png" style="width: 250px;height: 250px;">
                        </a>
                        <h1 class="text-center" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Novo usuário? Adicione suas informações</h1>
                        <p style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Use o formulário abaixo</p>
                    </div>
                    <form action="add.php" method="POST" enctype="multipart/form-data" class="bg-white p-10 mt-10 rounded-lg shadow mx-auto w-full max-w-md">
                        <div class="form-field">
                            <p>Nome completo</p>
                            <input type="text" name="nome" id="nome" required>
                            <p>Senha</p>
                            <input type="password" name="senha" id="senha" onkeyup="validarSenha()" required>
                            <br>
                            <p>Confirmação senha</p>
                            <input type="password" name="senhaC" id="senhaC" onkeyup="validarSenha()" required>
                            <span id="senhas"></span>
                            <input type="hidden" name="validasenha" id="validasenha" value="0" required>
                            <br>
                            <p>E-mail</p>
                            <input type="text" name="email" id="email" onkeyup="return validarEmail()" required>
                            <br>
                            <p>Confirmação de E-mail</p>
                            <input type="text" name="emailC" id="emailC" onkeyup="return validarEmail()" required>
                            <span id="emails"></span>
                            <input type="hidden" name="validaemail" id="validaemail" required>
                            <br>
                            <p>WhatsApp</p>
                            <input type="text" name="telefonec" id="telefonec" required>
                            <br>
                            <p>CPF</p>
                            <p><input id="cpf" name="cpf" type="text" onkeyup="cpfCheck(this)" maxlength="14" onkeydown="javascript: fMasc( this, mCPF );" required> <span id="cpfResponse"></span></p>
                            <br>
                            <input type="hidden" name="validarCPF" id="validarCPF" required>
                            <p>Data de Nascimento</p>
                            <p><input type="text" name="datanasc" id="datanasc" maxlength="10" onkeydown="mascaraData(this)" onkeyup='return validadata()' required> <span id="dataResponse1"></span></p>
                            <span id="dataResponse2"></span>
                            <br>
                            <input type="hidden" name="validardata" id="validardata" required>
                            <p>Sexo:</p>
                            <p>Feminino <input type="radio" id="feminino" name="sexo" value="feminino" required></p>
                            <p>Masculino <input type="radio" id="masculino" name="sexo" value="masculino" required></p>
                            <br>
                            <p>CEP</p>
                            <input type="text" name="cep" id="cep" required>
                            <br>
                            <p>Rua</p>
                            <input type="text" name="rua" id="rua" readonly required>
                            <br>
                            <p>Número</p>
                            <input type="text" name="numero" id="numero" required>
                            <br>
                            <p>Bairro</p>
                            <input type="text" name="bairro" id="bairro" readonly required>
                            <br>
                            <p>Cidade</p>
                            <input type="text" name="cidade" id="cidade" readonly required>
                            <br>
                            <p>Estado</p>
                            <input type="text" name="estado" id="estado" readonly required>
                            <br>
                            <p>Imagem de perfil</p>
                            <input type="file" name="foto" value="<?php echo $foto; ?>" id="foto" required>
                        </div>
                        <br>
                        <small>Apenas imagem do tipo: JPG, JPEG, PNG, WEBP, AVIF e tamanho: 2MB</br></small>
                        <small>(AVISO) Se aparecer a seguinte mensagem:</small>
                        <small>"Devido a insuficiência de memória não foi possível concluir a operação anterior"</small>
                        <br><br>
                        <small>Feche todos os aplicativos do celular que estão em segundo plano para poder escolher a imagem de perfil</small>
                        <br><br>
                        <small>Seu e-mail e número serão exibidos publicamente para que os interessados possam entrar em contato através deles.</small>.
                        <div align="center">

                            <div class="elementExample elementExample_first">
                                <input type="submit" name="Cadastrar" style="font-size: 20px;font-family: 'Open Sans', sans-serif;font-weight: bold; color: white;" value="Cadastrar" id="submit">
                            </div>
                            <div class="elementExample elementExample_last">
                                <button id="quadrado" name="Cadastrar">
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
                                <a class="text-black hover:text-secondary block px-3 py-2 rounded-xl-md text-base font-medium" href="esqueceu-senha.php" style="font-size: 20px;font-family: 'Open Sans', sans-serif;">Esqueceu sua senha?</a>
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
