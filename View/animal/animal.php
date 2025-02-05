
<?php
include_once('../../Models/DbConfig.php');
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
            $tipo = $user_data['tipo'];
            $data = $user_data['data'];
            $hora = $user_data['hora'];
            $imagem = $user_data['imagem'];
        }
    } else {
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../../index.php');
}
?>

<?php

$sqlc = "SELECT * FROM usuarios WHERE cpf LIKE '%$cpf%'";
$resultc = $conexao->query($sqlc);
while ($user_data3 = mysqli_fetch_assoc($resultc)) {
    $nome2 = $user_data3['nome'];
    $email2 = $user_data3['email'];
    $telefonec2 = $user_data3['telefonec'];
}
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <link rel="icon" type="image/png" href="../../Assets/Imagens/Site/Imgs/icone-pagina.png">
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilo-w3.css">
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilo-grid.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="stylesheet" type="text/css" href="../../Assets/Css/estilos-pessoal.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@500&family=Roboto:ital,wght@1,900&display=swap" rel="stylesheet">
    <title>Find Pets - Anúncio Animal</title>
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

        #map {
            height: 400px;
            width: 100%;
        }

        textarea {
            resize: none;
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

    <main id="main" role="main" class="flex-grow container max-w-7xl mx-auto px-2 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        <div align="center">
            <div id="imagens">
                <a class="block relative">
                    <img class="w-full animation" src="<?php echo $imagem; ?>">
                    <br>
                    <br>
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
            </div>
        </div>
        <br>

        <form>
            <p><b>Nome do animal:</b> <?php echo $nome; ?> </p>
            <hr>
            <p><b>Idade:</b> <?php echo $idade; ?></p>
            <hr>
            <p><b>Vacinação:</b> <?php echo $vacinacao; ?></p>
            <hr>
            <p><b>Estado de Saúde:</b> <?php echo $saude; ?></p>
            <hr>
            <p><b>Local:</b> <?php echo $endereco; ?></p>
            <hr>
            <p><b>Data:</b> <?php echo $data; ?></p>
            <hr>
            <p><b>Hora:</b> <?php echo $hora; ?></p>
            <hr>
            <p><b>Sexo:</b> <?php echo $sexo; ?></p>
            <hr>
            <p><b>Tipo:</b> <?php echo $tipo; ?></p>
            <hr>
            <br>
            <div align="justify">
                <p><b>Descrição:</b><br></p><br>
                <?php echo $descricao; ?>
                <hr>
            </div>
        </form>
        <?php
        if ($status == "Doando") {
        ?>
            <br>
            <h3>Quer adotar ou conhece alguém que queira?. Compartilhe o PDF com os seus contatos do WhatsApp &nbsp;<button onclick="myFunction()"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/compartilhar.png" style="height:35px;width:35px"></button></h3>
            <br>
            <h4>Para adotar esse pet ou saber mais sobre ele(a), entre em contato com o protetor: <b><?php echo $nome2; ?></b></h4>
            <br>
            <a class="text-black hover:text-secondary" href="mailto:<?php echo $email2; ?>"><img src="../../Assets/Imagens/Site/Imgs/gmail.png" style="height:35px;width:35px"><?php echo $email2; ?></a>
            <br><br>
            <a class="text-black hover:text-secondary" href="https://api.whatsapp.com/send?phone=55<?php echo $telefonec2; ?>&amp;text=Olá! <?php echo $nome2; ?> Vi o/a <?php echo $nome; ?> no site Find Pets e gostaria de saber mais informações!" class="primary-link open-modal"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/zap.png" style="height:35px;width:35px"><?php echo $telefonec2; ?></a>
            <br><br>
        <?php
        }
        if ($status == "Abandonado") {
        ?>
            <br>
            <h3>Quer ajudar a procurar?. Compartilhe o PDF com os seus contatos do WhatsApp &nbsp;<button onclick="myFunction()"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/compartilhar.png" style="height:35px;width:35px"></button></h3>
            <br>
            <h4>Para ajudar a procurar esse pet ou saber mais sobre ele(a), entre em contato com o protetor: <b><?php echo $nome2; ?></b></h4>
            <br>
            <a class="text-black hover:text-secondary" href="mailto:<?php echo $email2; ?>"><img src="../../Assets/Imagens/Site/Imgs/gmail.png" style="height:35px;width:35px"><?php echo $email2; ?></a>
            <br><br>
            <a class="text-black hover:text-secondary" href="https://api.whatsapp.com/send?phone=55<?php echo $telefonec2; ?>&amp;text=Olá! <?php echo $nome2; ?> Vi o/a <?php echo $nome; ?> no site Find Pets e gostaria de saber mais informações!" class="primary-link open-modal"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/zap.png" style="height:35px;width:35px"><?php echo $telefonec2; ?></a>
            <br><br>

        <?php
        }
        if ($status == "Perdido") {
        ?>
            <br>
            <h3>Você conhece esse pet ou conhece alguém que possa saber?. Compartilhe o PDF com os seus contatos do WhatsApp &nbsp;<button onclick="myFunction()"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/compartilhar.png" style="height:35px;width:35px"></button></h3>
            <br>
            <h4>Para ajudar o pet a encontrar a casa ou saber mais sobre quem o avistou, entre em contato com: <b><?php echo $nome2; ?></b></h4>
            <br>
            <a class="text-black hover:text-secondary" href="mailto:<?php echo $email2; ?>"><img src="../../Assets/Imagens/Site/Imgs/gmail.png" style="height:35px;width:35px"><?php echo $email2; ?></a>
            <br><br>
            <a class="text-black hover:text-secondary" href="https://api.whatsapp.com/send?phone=55<?php echo $telefonec2; ?>&amp;text=Olá! <?php echo $nome2; ?> Vi o/a <?php echo $nome; ?> no site Find Pets e gostaria de saber mais informações!" class="primary-link open-modal"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/zap.png" style="height:35px;width:35px"><?php echo $telefonec2; ?></a>
            <br><br>

        <?php
        }
        if ($status == "Maus-Tratos") {
        ?>
            <br>
            <h3>Você quer ajudar a resgatar esse pet?.</h3>
            <p>Entre em contato com A Delegacia Eletrônica de Proteção dos Animais que deve ser acionada para comunicação de maus-tratos, inclusive contra animais domésticos.<br><br>
                A delegacia foi criada em 2013 e atende 24 horas por dia, inclusive aos finais de semana.<br><br>
                Conforme a Lei nº 9.605/1998, maus-tratos contra animais domésticos, nativos ou exóticos caracterizam crime e podem render pena de detenção de três meses a um ano, além de pagamento de multa.<br>
                Para fazer uma denúncia entre em contato pelos telefones: 181 ou (11) 3338-0155 / 1380 ou <br>
                <a href="https://www.webdenuncia.org.br/depa" title='Ir para o site da DEPA Delegacia Eletrônica de Proteção dos Animais'>Clique aqui para ir para o site da (DEPA) Delegacia Eletrônica de Proteção dos Animais</a>
            </p>
            <br>
            <h4>Para ajudar o pet a ser resgatado compartilhe o PDF com os seus contatos do WhatsApp &nbsp;<button onclick="myFunction()"><img class="w-5" src="../../Assets/Imagens/Site/Imgs/compartilhar.png" style="height:35px;width:35px"></button></h4>
            <br><br>
        <?php
        }
        ?>
        
            <h4><b>Site:</b> <a href="https://find-pets.infinityfreeapp.com/View/animal/anuncios.php">https://find-pets.infinityfreeapp.com</a></h4>
            </main>

            <main role="main" class="flex-grow container max-w-7xl mx-auto px-2 py-4 sm:px-6 sm:py-6 lg:px-8 lg:py-8">
        
            <p>Coordenadas do cadastro em Geolocalização:<br><?php echo $coordenada; ?></p>
            <br>
            <p>Ative a localição do dispositivo e atualize a página para verificar a sua distância do cadastro do animal</p>
            <p id="mensagem">Clique no botão para receber sua localização em Latitude e Longitude:</p>
            <button onclick="getLocation()">Obter geolocalização</button>

            <br>

            <div id="map" style="height: 600px;"></div>
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
            <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"></script>
            <script src="https://unpkg.com/@mapbox/polyline@1.1.1/index.js"></script>

            <script>
                var x = document.getElementById("mensagem");
                var userLat, userLng;
                var animalLatLng = [<?php echo $coordenada; ?>];

                function getLocation() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(showPosition, showError);
                    } else {
                        x.innerHTML = "O seu navegador não suporta Geolocalização.";
                    }
                }

                function showPosition(position) {
                    userLat = position.coords.latitude;
                    userLng = position.coords.longitude;
                    x.innerHTML = "Latitude: " + userLat + "<br>Longitude: " + userLng;
                    calculateRoute(userLat, userLng, animalLatLng[0], animalLatLng[1]);
                }

                function showError(error) {
                    alert("Erro ao obter localização: " + error.message);
                }

                var map = L.map('map').fitWorld();

                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    minZoom: 1,
                    maxZoom: 19,
                    attribution: ''
                }).addTo(map);

                map.locate({
                    setView: true,
                    maxZoom: 16
                });

                function onLocationFound(e) {
                    var radius = e.accuracy;
                    userLat = e.latlng.lat;
                    userLng = e.latlng.lng;
                    
                    L.marker(e.latlng).addTo(map).bindPopup("Sua localização").openPopup();
                    L.circle(e.latlng, radius).addTo(map);

                    calculateRoute(userLat, userLng, animalLatLng[0], animalLatLng[1]);
                }

                map.on('locationfound', onLocationFound);

                function onLocationError(e) {
                    alert("Ative a localização do dispositivo e/ou recarregue a página");
                }

                map.on('locationerror', onLocationError);

                var LeafIcon = L.Icon.extend({
                    options: {
                        iconSize: [50, 100],
                        iconAnchor: [22, 94],
                        popupAnchor: [-3, -76]
                    }
                });

                var greenIcon = new LeafIcon({
                    iconUrl: '../../Assets/Imagens/Site/Imgs/animal-mapa.png'
                });

                L.marker(animalLatLng, { icon: greenIcon }).addTo(map).bindPopup("Localização do cadastro do animal");

                var circle = L.circle(animalLatLng, {
                    color: 'darkred',
                    fillColor: 'lightblue',
                    fillOpacity: 0.5,
                    radius: 25
                }).addTo(map);

                function calculateRoute(startLat, startLng, endLat, endLng) {
                    var apiKey = '...';
                    var url = `https://api.openrouteservice.org/v2/directions/driving-car?api_key=${apiKey}&start=${startLng},${startLat}&end=${endLng},${endLat}`;
                    
                    fetch(url)
                        .then(response => response.json())
                        .then(data => {
                            var route = data.features[0].geometry.coordinates;
                            var distance = data.features[0].properties.segments[0].distance / 1000; 
                            
                            
                            var distanceMessage = document.getElementById("distance-message");
                            if (!distanceMessage) {
                                distanceMessage = document.createElement("div");
                                distanceMessage.id = "distance-message";
                                x.appendChild(distanceMessage);
                            }
                            distanceMessage.innerHTML = "Distância até o animal: " + distance.toFixed(2) + " km";
                            
                            var latlngs = route.map(coord => [coord[1], coord[0]]);

                            L.polyline(latlngs, { color: 'blue' }).addTo(map);
                            map.fitBounds(L.polyline(latlngs).getBounds());
                        })
                        .catch(error => {
                            console.error('Erro ao calcular rota:', error);
                        });
                }

                getLocation();
            </script>




        </main>

    <footer class="w3-container w3-center w3-margin-top" style="background-color:white; color:black;">
        <div class="flex flex-col mt-10 text-center items-center">
            <div><img loading="lazy" src="../../Assets/Imagens/Site/Imgs/Logo1.png" height="150px" width="150px"></div>
            <div class="font-bold">Todos os direitos reservados.</div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>

    <script>
        async function myFunction() {
            if (window.ReactNativeWebView) {
                var element = document.getElementById('main'); 
                
                var opt = {
                    margin: 1,
                    filename: 'Find Pets - Anúncio Animal.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 0.98
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'letter',
                        orientation: 'portrait'
                    }
                };

                const pdfBlob = await html2pdf().from(element).set(opt).outputPdf('blob');
                const reader = new FileReader();

                reader.onloadend = function() {
                    const pdfBase64 = reader.result.split(',')[1];
                    window.ReactNativeWebView.postMessage(pdfBase64);
                };

                reader.readAsDataURL(pdfBlob);
            } else {
                window.print(); 
            }
        }
    </script>





</body>
    

</html>
