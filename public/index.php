<?php
    include "../app/Session/User.php";
    use App\Session\User as SessionUser;

    // Verifique se o usuário está logado e redirecione se necessário
    if (SessionUser::isLogged()){
        $info_user = SessionUser::getInfo();
    } 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="../src/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
</head>
<body>
    <?php include "../src/components/menu.php"; ?>
</body>
</html>
