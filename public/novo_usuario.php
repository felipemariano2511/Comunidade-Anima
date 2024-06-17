<?php
include "../app/includes/config.php";
include '../app/Session/User.php';

use App\Session\User as SessionUser;

if (SessionUser::isLogged()) {
    $user_info = SessionUser::getInfo();
} else {
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
    $titulo = $_POST['titulo'];
    $data_inicial = $_POST['data_inicial'];
    $data_final = $_POST['data_final'];
    $horario_inicial = $_POST['horario_inicial'];
    $horario_final = $_POST['horario_final'];
    $endereco = $_POST['endereco'];
    $descricao_inicial = $_POST['descricao_inicial'];
    $descricao_completa = $_POST['descricao_completa'];
    $arquivo = $_FILES['arquivo'];
    $restrito = isset($_POST['switch_status']) && $_POST['switch_status'] == '1' ? FALSE : TRUE;
    $autor = $user_info['id'];

    if ($arquivo['error'] === 0) {
        $endereco_arquivo = '../imgs/posts/' . $arquivo['name'];
        move_uploaded_file($arquivo['tmp_name'], $endereco_arquivo);

        $query = "INSERT INTO eventos(titulo, data_inicial, horario_inicial, data_final, horario_final, endereco, descricao_inicial, descricao_completa, arquivo, situacao, restrito, autor)
                  VALUES ('$titulo', '$data_inicial', '$horario_inicial', '$data_final', '$horario_final', '$endereco', '$descricao_inicial', '$descricao_completa', '$endereco_arquivo', 'ativo', '$restrito', '$autor')";
        $result = mysqli_query($con, $query);

        if ($result) {
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
    <link rel="stylesheet" href="../src/styles/novo_usuario.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Novo Usuário</title>
</head>

<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu_formatted.php"; ?>

    <section class="home">
        <div class="text">
            <h1>Novo Usuário</h1>
        </div>
        <div class="form-container">
            <form action="#" method="post" enctype="multipart/form-data">

                <div class="input-box">
                    <input type="text" id="nome" name="nome" required>
                    <label for="nome" class="placeholder1" required>Nome</label>
                </div>

                <div class="input-box">
                    <input type="text" id="email" name="email" required>
                    <label for="email" class="placeholder1" required>E-mail</label>
                </div>
            
                <div class="input-box">
                    <input type="password" id="senha" name="senha" required>
                    <label for="senha" class="placeholder1" required>Senha</label>
                </div>

                <div class="radio-container">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="USR" checked>
                        <label class="form-check-label" for="inlineRadio1">Usuário</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="ADM">
                        <label class="form-check-label" for="inlineRadio2">Administrador</label>
                    </div>
                </div>
                
                <div class="input-box">
                    <label for="imagem" class="custom-file-upload">
                        Escolher Imagem
                    </label>
                    <input type="file" id="imagem" name="arquivo" class="file-btn">
                </div>

                <div class="row">
                    <div class="input-box">
                        <input type="submit" value="Cadastrar Usuário" name="cadastrar" class="submit-btn">
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>