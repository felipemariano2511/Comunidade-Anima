<?php
include "../app/includes/config.php";
include '../app/Session/User.php';
use App\Session\User as SessionUser;

if(SessionUser::isLogged()){
    $user_info = SessionUser::getInfo();
} else {
    header("Location: index.php");
    exit();
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])){
    $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];
    $horario_inicial = $_POST['horario_inicial'];
    $horario_final = $_POST['horario_final'];
    $endereco = mysqli_real_escape_string($con, $_POST['endereco']);
    $descricao_inicial = mysqli_real_escape_string($con, $_POST['descricao_inicial']);
    $descricao_completa = mysqli_real_escape_string($con, $_POST['descricao_completa']);
    $arquivo = $_FILES['arquivo'];
    $restrito = $_POST['inlineRadioOptions'] == '1' ? TRUE : FALSE;
    $autor = $user_info['id'];

    if($arquivo['error'] === 0) {
        $endereco_arquivo = '../imgs/posts/' . $arquivo['name'];
        move_uploaded_file($arquivo['tmp_name'], $endereco_arquivo);

        $query = "INSERT INTO eventos(titulo, data_inicial, horario_inicial, data_final, horario_final, endereco, descricao_inicial, descricao_completa, arquivo, situacao, justificativa, restrito, autor)
                  VALUES ('$titulo', '$data_inicial', '$horario_inicial', '$data_final', '$horario_final', '$endereco', '$descricao_inicial', '$descricao_completa', '$endereco_arquivo', 'pendente', 'Seu evento ainda não foi publicado, espere a aprovação do administrador!', '$restrito', '$autor')";
        $result = mysqli_query($con, $query);

        if($result){
            echo '<script>alert("Cadastrado com sucesso, aguarde aprovação!")</script>';
        } else {
            echo '<script>alert("Falha no cadastro!")</script>';
        }
    } else {
        echo '<script>alert("Erro ao fazer upload do arquivo. Por favor, tente novamente!")</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/formularios.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Novo Evento</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js/script.js" referrerpolicy="origin"></script>

    <script>
        initializeTinyMCE();
    </script>
</head>

<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu.php"; ?>

    <section class="home">
        <div class="text">
            <h1>Novo Evento</h1>
        </div>
        <div class="form-container">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="input-box">
                    <input type="text" id="titulo" name="titulo" maxlength="50" required>
                    <label for="titulo" class="placeholder1" required>Título</label>
                </div>

                <div class="input-box">
                    <input type="text" id="descricao_inicial" name="descricao_inicial" maxlength="70" required>
                    <label for="descricao_inicial" class="placeholder1" required>Descrição Inicial</label>
                </div>

                <div class="column">
                    <div class="input-box">
                        <input type="text" id="endereco" name="endereco" maxlength="100" required>
                        <label for="endereco" class="placeholder1">Endereço</label>
                    </div>
                    <button type="button" class="map-btn" onclick="openInGoogleMaps()">Verificar endereço</button>
                </div>
                
                <div class="radio-container">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="true"checked >
                        <label class="form-check-label" for="inlineRadio1">Restrito</label>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="false">
                        <label class="form-check-label" for="inlineRadio2">Aberto ao Público</label>
                    </div>
                </div>

                <div class="input-box">
                    <label for="imagem" class="custom-file-upload">
                        Escolher imagem
                    </label>
                    <input type="file" id="imagem" name="arquivo" class="file-btn" onchange="previewImage(event)" >
                </div>
                <img id="preview" src="#" alt="Preview da imagem" style="max-width: 100%; display: none;">

                <div class="column">
                    <div class="input-box">
                        <label for="data_inicial">Data Inicial</label>
                        <input type="date" id="data_inicial" name="data_inicial" required>
                        <label for="horario_inicial">Horário Inicial</label>
                        <input type="time" id="horario_inicial" name="horario_inicial" required>
                    </div>
                    <div class="input-box">
                        <label for="data_final">Data Final</label>
                        <input type="date" id="data_final" name="data_final" required>
                        <label for="horario_final">Horário Final</label>
                        <input type="time" id="horario_final" name="horario_final" required>
                    </div>
                </div>

                <div class="input-box">
                    <label for="descricao_completa">Descrição</label>
                    <textarea id="descricao_completa" name="descricao_completa"></textarea>
                </div>
                
                <div class="row">
                    <div class="input-box">
                        <input type="submit" value="Cadastrar Evento" name="cadastrar" class="submit-btn">
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>