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

    //Direcionar para o whatsapp do responsável
    $telefone = '+55'.$tableData['telefone'];
    $whatsapp_formatado = preg_replace('/\D/', '', $telefone);
    $url_whatsapp = "https://wa.me/$whatsapp_formatado?text=";

    //Direciona para o email do responsável
    $email_formatado = urlencode($tableData['email']);
    $url_email = "mailto:$email_formatado?subject=&body=";
    
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
                    <a href="<?php  echo $url_email?>"><i class='bx bx-envelope' ></i></a>
                    <a href="<?php echo $url_whatsapp?>"><i class='bx bxl-whatsapp'></i></a>
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
