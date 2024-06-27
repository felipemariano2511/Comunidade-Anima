<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style-pattern.css">
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/perfil.css">
    <title>Eventos</title>
</head>

<body>
    <?php include '../src/components/menu.php';?>;
    <form action="" method="post">
        <section class="home">
            <div class="home-title">
                <h1>Minhas Informações</h1>
                <p>Confira os dados do seu perfil</p>
            </div>
            <div class="login">
                <div class="login-container">
                    <div class="profile-img">
                        <img src="../imgs/card/marciaoshowdebola.jpg" alt="">
                        <input type="file" name="foto_perfil" id="fileInput">
                        <label for="fileInput" class="custom-file-upload">Alterar Foto</label>
                    </div>
                    <div class="profile-info">
                        <h1>Meus Dados</h1>
                        <input type="email" name="email" id="" placeholder="Email">
                        <input type="text" name="" id="" placeholder="Nome">
                        <input type="password" name="" id="" placeholder="Senha">
                        <input type="submit" value="Salvar" name="salvar" class="botao">
                    </div>
                </div>
            </div>
        </section>
    </form>
</body>