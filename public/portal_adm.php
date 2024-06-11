<?php
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
        if($user_info['nivel'] == "USR" || $user_info['nivel'] == "ADM"){
        }
    }else{
        header("Location index.php");
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Portal Adm</title>
    
</head>
<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu_formatted.php"; ?>

    <section class="home">
        <div class="text">
            <h1>Portal do Administrador</h1>
        </div>
    </section>
</body>
</html>