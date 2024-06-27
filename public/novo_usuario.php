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
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = md5($_POST['senha']);
    $nivel = $_POST['inlineRadioOptions'];
    $imagem = "../imgs/usuario/user-1.webp";

    $query = "INSERT INTO usuario(email, senha, nome, nivel, imagem)
                VALUES ('$email', '$senha', '$nome', '$nivel', '$imagem')";
    $result = mysqli_query($con, $query);

    if ($result) {
        echo '<script>alert("Usuário cadastrado com sucesso!")</script>';
    } else {
        echo '<script>alert("Falha no cadastro!")</script>';
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
    <?php include "../src/components/menu.php"; ?>

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