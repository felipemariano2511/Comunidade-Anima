<?php
    include "../app/includes/config.php";
    include "../app/Session/User.php";
    include "../app/Session/Adm.php";
    use \App\Session\User as SessionUser;
    use \App\Session\Adm as SessionAdm;

    if(!SessionUser::isLogged() || !SessionAdm::isLogged()){
        header('Location: login.php');
    }

    $info_user = SessionUser::getInfo();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cadastrar'])){
        $titulo = $_POST['titulo'];
        $data = $_POST['data'];
        $horario = $_POST['horario'];
        $endereco = $_POST['endereco'];
        $descricao = $_POST['descricao'];
        $arquivos = $_FILES['arquivo'];
        $autor = $info_user['ra'];
        $arquivo = $_FILES['arquivo'];

        move_uploaded_file($arquivo['tmp_name'], '../imgs/posts/' . $arquivo['name']);

        $endereco_arquivo = '../imgs/anuncio/' . $arquivo['name'];

        $query = "INSERT INTO eventos(titulo, data_evento, horario, endereco, descricao, arquivo,situacao_post,autor)
                 VALUES ('$titulo', '$data', '$horario', '$endereco', '$descricao', '$endereco_arquivo', 'ativo', '$autor')";
                 
        $result = mysqli_query($con, $query);
        
        if($result){
            echo "Cadastro realizado com sucesso!";
        } else{
            echo "Falha no cadastro!";
        }
    }


?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Novo Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cadastro de Novo Evento</h2>
        <form action="publicar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="data">Data:</label>
                <input type="date" id="data" name="data" required>
            </div>
            <div class="form-group">
                <label for="horario">Horário:</label>
                <input type="time" id="horario" name="horario" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="arquivo">
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar Evento" name="cadastrar">
            </div>
        </form>
    </div>
</body>
</html>
