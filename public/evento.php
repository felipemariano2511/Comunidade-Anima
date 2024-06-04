<?php
    include '../app/includes/config.php';
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //Consulta se o id do evento existe
        if($id !== ''){
            $query = "SELECT * FROM eventos WHERE id = '$id'";
            $result = mysqli_query($con, $query);

            //Se existir, imprime na tela
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){              
                    $tableData = $row;
                }
                echo '<script>window.location.href = "evento.php?id='.$tableData['id'].'#";</script>';
            //Senão, recireciona para a página de Eventos
            }else{
                header('Location: index.php?page=Eventos');
            }
        }else{
            header('Location: index.php?page=Eventos'); 
        }
    }
    
    $encodedAddress = urlencode($tableData['endereco']);
    // Concatena o endereço codificado na URL do Google Maps
    $googleMapsLink = "https://www.google.com/maps/search/?api=1&query={$encodedAddress}";

    //Concatena para o formato da URL do Google Agenda
    $dataInicio = $tableData['data_inicial'];
    $horaInicio = $tableData['horario_inicial'];
    $dataFim = $tableData['data_final'];
    $horaFim = $tableData['horario_final'];

    $dataHoraInicio = date('Ymd\THis', strtotime("$dataInicio $horaInicio"));
    $dataHoraFim = date('Ymd\THis', strtotime("$dataFim $horaFim"));
   // $dataFimFormatada = date('Ymd\THis', strtotime($dataFim));

    // Montar o link
    $link_google_agenda = "https://www.google.com/calendar/render?action=TEMPLATE";
    $link_google_agenda .= "&text=" . urlencode($tableData['titulo']);
    $link_google_agenda .= "&dates=" . $dataHoraInicio . "/" . $dataHoraFim;
    $link_google_agenda .= "&location=" . urlencode($tableData['endereco']);
    $link_google_agenda .= "&details=" . urlencode($tableData['descricao_inicial']);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/evento.css">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Eventos</title>
</head>
<script>
        function openInGoogleMaps() {
            const address = "<?php echo $tableData['endereco'] ;?>".value;
            if (address) {
                const url = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`;
                window.open(url, '_blank');
            } else {
                alert("Por favor, insira um endereço válido.");
            }
        }
    </script>

<body>
<nav class="sidebar close">
        <header>
        <div class="image-text">
                <a href="<?php if(!SessionUser::isLogged()){echo 'login.php';}?>">
                    <span class="image">
                        <img src="../imgs/usuario/user-1.webp" alt="">
                    </span>
                </a>
                <div class="text logo-text">
                    <span class="name"><?php
                                            if(SessionUser::isLogged()){
                                                $user_info = SessionUser::getInfo();

                                                echo $user_info['firstName'];
                                            }else{
                                                echo '<a href="login.php" class="text nav-text" style="text-decoration: none;">Login</a>';
                                            }
                                        ?>
                    </span>
                    <span class="profession">Ciência da computação</span>
                </div>
        </header>
        <div class="menu-bar">
            <div class="menu">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a class="toggle" style="cursor:pointer;">
                            <i class='bx bx-menu icon' id="menu-icon"></i>
                            <span class="text nav-text">Menu</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Home">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Eventos">
                            <i class='bx bx-calendar-event icon'></i>
                            <span class="text nav-text">Eventos</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Atléticas">
                            <i class='bx bx-trophy icon'></i>
                            <span class="text nav-text">Atléticas</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Comodidades">
                            <i class='bx bx-shape-triangle icon'></i>
                            <span class="text nav-text">Comodidades</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Likes">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>
                    <li class="nav-link">
                        <a href="index.php?page=Suporte">
                            <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Suporte</span>
                        </a>
                    </li>
                </ul>
            </div>
            <?php 
            if(SessionUser::isLogged()){
                echo '<div class="bottom-content">
                        <li class="">
                            <a href="../app/includes/logout.php">
                                <i class="bx bx-log-out icon"></i>
                                <span class="text nav-text">Logout</span>
                            </a>
                        </li>
                     </div>';
            }
            ?>
        </div>
    </nav>
    <section class="home">
        <div class="event-img">
            <img src="<?php echo $tableData['arquivo']?>" class="img-fluid" alt="...">
        </div>
        <div class="event-img-small">
            <img src="<?php echo $tableData['arquivo']?>" class="img-fluid" alt="...">
        </div>
        <div class="event-text">
            <div class="event-name">
                <h1><?php echo $tableData['titulo']?></h1>
            </div>
            <div class="event-info-container">
                <div class="event-info">
                    <div class="event-data">
                        <div class="event-title">
                            <i class='bx bxs-stopwatch'></i>
                            <h2>Data e Horário</h2>
                        </div>
                        <div class="event-data-content">
                            <h3><?php echo $tableData['data_inicial']?></h3>
                            <h3><?php echo $tableData['horario_inicial']?></h3>
                        </div>
                    </div>
                    <div class="event-adress">
                        <div class="event-title">
                            <i class='bx bxs-map'></i>
                            <h2>Endereço e Local</h2>
                        </div>
                        <div class="event-adress-content">
                            <h3><?php echo $tableData['endereco']?></h3>
                        </div>
                    </div>
                    <div class="event-age">
                        <div class="event-title">
                            <i class='bx bxs-error-circle'></i>
                            <h2>Faixa Etária</h2>
                        </div>
                        <div class="event-age-content">
                            <h3>Proibido menores de 18</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="event-buttons">
            <div class="event-container">
                <form action="#" method="post" id="form-like">
                    <button type="submit"><i class='bx bxs-heart'></i>Tenho interesse</button>
                </form>
                <div class="other-btn">
                    <a href="<?php echo $googleMapsLink?>"><i class='bx bxs-map-pin'></i></a>
                    <a href="<?php echo $link_google_agenda;?>"><i class='bx bx-calendar-exclamation'></i></a>
                    <a href="#" class="share-link"><i class='bx bxs-share-alt' data-id="<?php echo $tableData['id'];?>"></i></a>
                </div>
            </div>
        </div>
        <div class="event-description">
            <div class="event-container">
                <h1>Descrição do evento</h1>
                <p><?php echo $tableData['descricao_completa']?></p>
            </div>
        </div>
        <!-- Campo de texto oculto para copiar a URL -->
    <textarea id="urlField" style="display:none;"></textarea>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareIcons = document.querySelectorAll('.share-link i');

            shareIcons.forEach(icon => {
                icon.addEventListener('click', function(event) {
                    event.preventDefault(); // Impedir a ação padrão da tag <a>
                    const id = this.getAttribute('data-id');
                    const urlField = document.getElementById('urlField');
                    const url = `http://localhost/Comunidade-Anima/public/evento.php?id=${id}`;
                    urlField.value = url;
                    urlField.style.display = 'block';
                    urlField.select();
                    urlField.setSelectionRange(0, 99999); // Para dispositivos móveis

                    try {
                        const successful = document.execCommand('copy');
                        const msg = successful ? 'URL copiada com sucesso!' : 'Falha ao copiar a URL';
                        alert(msg);
                    } catch (err) {
                        console.error('Erro ao copiar a URL: ', err);
                    }

                    urlField.style.display = 'none';
                });
            });
        });
    </script>
    </section>
    

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.heart-icon').forEach(function(icon) {
                icon.addEventListener('click', function() {
                    this.classList.toggle('bx-heart');
                    this.classList.toggle('bxs-heart');
                    this.classList.toggle('liked');
                });
            });
        });
    </script>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");

        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })

        searchBtn.addEventListener("click", () => {
            sidebar.classList.remove("close");
        })

        modeSwitch.addEventListener("click", () => {
            body.classList.toggle("dark");

            if (body.classList.contains("dark")) {
                modeText.innerText = "Light mode";
            } else {
                modeText.innerText = "Dark mode";

            }
        });
    </script>
</body>
</html>