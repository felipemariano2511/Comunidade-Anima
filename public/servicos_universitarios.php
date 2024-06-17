<?php
    include '../app/includes/config.php';
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;
    
    $like = FALSE;
    $table = 'servicos_universitarios';

    $uri = $_SERVER['REQUEST_URI'];

    if ($uri == "/Comunidade-Anima/public/servicos_universitarios.php" || $uri == "/Comunidade-Anima/public/servicos_universitarios.php?") {
        header("Location: index.php?page=Home");
        exit;
    };

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        //Consulta se o id do evento existe
        if($id !== ''){
            $query = "SELECT * FROM servicos_universitarios WHERE id = '$id'";
            $result = mysqli_query($con, $query);

            //Se existir, imprime na tela
            if(mysqli_num_rows($result) > 0){
                while ($row = mysqli_fetch_assoc($result)){              
                    $tableData = $row;
                }
                echo '<script>window.location.href = "servicos_universitarios.php?id='.$tableData['id'].'#";</script>';
            //Senão, recireciona para a página de Eventos
            }else{
                header('Location: index.php?page=Home');
            }
        }else{
            header('Location: index.php?page=Home'); 
        }
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['like'])){
        $like = TRUE;
        include '../app/includes/curtir.php';
    }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deslike'])){
        $like = FALSE;
        include '../app/includes/curtir.php';
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/servicos_universitarios.css">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Serviços Universitários</title>
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
        </div>
        <div class="event-buttons">
            <div class="event-container">
                <form action="#" method="post" id="form-like">
                    <?php
                        if($like == FALSE){
                            echo '<button name="like"><i class="bx bxs-heart"></i>Like</button>';
                        } else{
                            echo '<button name="deslike"><i class="bx bxs-heart"></i>Deslike</button>';
                        }
                    ?>
                </form>
                <div class="contatos">
                    <h1>Contatos</h1>
                </div>
                <div class="other-btn">
                    <a href="">
                        <i class="bi bi-envelope-at">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at" viewBox="0 0 16 16">
                                <path d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2zm3.708 6.208L1 11.105V5.383zM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2z"/>
                                <path d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648m-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z"/>
                            </svg>
                        </i>
                    </a>
                    <a href=""> 
                        <i class="bi bi-whatsapp"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                            </svg>
                        </i>
                    </a>
                    <a href="#" class="share-link"><i class='bx bxs-share-alt' data-id="<?php echo $tableData['id'];?>"></i></a>
                </div>
            </div>
        </div>
        <div class="event-description">
            <div class="event-container">
                <h1>Informações</h1>
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
                    const currentHost = window.location.host;
                    event.preventDefault(); // Impedir a ação padrão da tag <a>
                    const id = this.getAttribute('data-id');
                    const urlField = document.getElementById('urlField');
                    const url = `http://${currentHost}/Comunidade-Anima/public/servicos_universitarios.php?id=${id}`;
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
</body>
</html>
