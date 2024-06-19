<?php
    include '../app/includes/config.php';
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;

    $user_info = SessionUser::getInfo();
    $like = FALSE;
    $table = 'eventos';
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //Consulta se o id do evento existe
        if($id !== ''){
            $query = "SELECT * FROM eventos WHERE id = '$id'";
            $result = mysqli_query($con, $query);

            //Se existir, imprime na tela e manipula os dados
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){              
                    $tableData = $row;
                }
                include '../app/includes/conversor_data.php';
                echo '<script>window.location.href = "evento.php?id='.$tableData['id'].'#";</script>';
                
            //Senão, recireciona para a página de Eventos
            }else{
                header('Location: index.php?page=Eventos');
            }
        }else{
            header('Location: index.php?page=Eventos'); 
        }
    }

    //Garante que somente ADM ou o autor do evento vizualize antes de o evento ser publicado
    if($tableData['situacao'] == 'pendente' || $tableData['situacao'] == 'recusado'){
        if($tableData['autor'] == $user_info['id'] || $user_info['nivel'] == 'ADM'){
        }else{
            header('Location: index.php?page=Eventos');
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])){
        $like = TRUE;
        include '../app/includes/curtir.php';
    }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deslike'])){
        $like = FALSE;
        include '../app/includes/curtir.php';
    }

    $horario_inicial = substr($tableData['horario_inicial'], 0, 5);
    $horario_final = substr($tableData['horario_final'], 0, 5);
    
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
    <title>Comunidade Ânima - Eventos</title>
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
<?php include '../src/components/menu_formatted.php'?>
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
                            <?php
                                if($data_inicial_formatada == $data_final_formatada){
                                    echo '<h3>'.$data_inicial_formatada.' | '.$horario_inicial.' às '.$horario_final.'</h3>';
                                    
                                }elseif($meses_formatados != NULL){
                                    echo $meses_formatados." | ".$horario_inicial.' às '.$horario_final;
                                }else{
                                    $dia_inicial = substr($data_inicial_formatada, 0, 2);
                                    echo $dia_inicial.' a  '.$data_final_formatada.' | '.$horario_inicial . ' às ' . $horario_final;
                                }
                            ?>
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
                        <?php
                            if($tableData['restrito'] == TRUE){
                               echo'<div class="event-title">
                                        <i class="bx bxs-lock"></i>
                                        <h2>Restrito</h2>
                                    </div>
                                    <div class="event-age-content">
                                        <h3>Somente membros da Universidade</h3>
                                    </div>';
                            }elseif($tableData['restrito'] == FALSE){
                                echo'<div class="event-title">
                                        <i class="bx bxs-door-open"></i>
                                        <h2>Livre acesso</h2>
                                    </div>
                                    <div class="event-age-content">
                                        <h3>Evento aberto ao público</h3>
                                    </div>';
                            }
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="event-buttons">
            <div class="event-container">
                <form action="#" method="post" id="form-like">
                    <?php
                        if($like == FALSE){
                            echo '<button name="like"><i class="bx bxs-heart"></i>Tenho interesse</button>';
                        } else{
                            echo '<button name="deslike"><i class="bx bxs-heart"></i>Remover interesse</button>';
                        }
                    ?>
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
                    const currentHost = window.location.host;
                    const id = this.getAttribute('data-id');
                    const urlField = document.getElementById('urlField');
                    const url = `http://${currentHost}/Comunidade-Anima/public/evento.php?id=${id}`;
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
</body>
</html>