<?php
    include '../app/includes/config.php';
    include '../app/Session/User.php';

    use App\Session\User as SessionUser;

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
    }else{
        //header("Location: index.php");
    }
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if($id != ''){
        if($user_info['id'] == $id || $user_info['nivel'] == "ADM"){
            $query = "SELECT * FROM usuario WHERE id = '$id'";
            $result = mysqli_query($con, $query);
            
            $tableData = mysqli_fetch_assoc($result);
        }else{
            //header('Location: index.php');
        }
    }else{
        //header('Location: index.php');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['salvar'])) {
        $email = $_POST['email'];
        $nome = $_POST['nome'];
        $senha = md5($_POST['senha']);
        $imagem = $_FILES['foto_perfil'];

        if($imagem['tmp_name'] == ''){
            $endereco_imagem = $tableData['imagem'];
        }

        if($imagem['error'] === 0) {
            $endereco_imagem = '../imgs/usuario/' . $imagem['name'];
            move_uploaded_file($imagem['tmp_name'], $endereco_imagem);
        }

        if($senha == "d41d8cd98f00b204e9800998ecf8427e"){
            $query = "UPDATE usuario SET email = '$email', nome = '$nome', imagem = '$endereco_imagem' WHERE id = $id";
        }else{
            $query = "UPDATE usuario SET email = '$email', nome = '$nome', senha = '$senha', imagem = '$endereco_imagem' WHERE id = $id";
        }
        $result = mysqli_query($con, $query);
        include '../app/includes/get_dados_usuario.php'; 
        header("Location:".$_SERVER['REQUEST_URI']);

    }
    

?><!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/perfil.css">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Perfil</title>
</head>

<body>
    <header class="header-main">
        <div class="container-header">
            <a href="index.php?page=Home">
                <img src="../imgs/dev/logo-anima-1024-white.png" alt="" width="100px">
            </a>
        </div>
    </header>
    <?php include '../src/components/menu.php';?>
    <form action="" method="post" enctype="multipart/form-data">
        <section class="home">
            <div class="home-title">
                <h1>Minhas Informações</h1>
                <p>Confira os dados do seu perfil</p>
            </div>
            <div class="login">
                <div class="login-container">
                    <div class="profile-img">
                        <img src="<?php if($tableData['imagem'] != NULL){echo $tableData['imagem'];}else{echo '../imgs/usuario/user-1.webp';} ?>" alt="Foto de perfil">

                        <input type="file" name="foto_perfil" id="fileInput">
                        <label for="fileInput" class="custom-file-upload">Alterar Foto</label>
                    </div>
                    <div class="profile-info">
                        <h1>Meus Dados</h1>
                        <input type="email" name="email" id="" value="<?php echo $tableData['email']; ?>">

                        <input type="text" name="nome" id="" value="<?php  echo $tableData['nome']; ?>">

                        <input type="password" name="senha" id="" placeholder="Senha">
                        <input type="submit" value="Salvar" name="salvar" class="botao">
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>