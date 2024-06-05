<?php
    
    include '../app/Session/User.php';
    
    $uri = $_SERVER['REQUEST_URI'];

    if ($uri == "/Comunidade-Anima/public/" || $uri == "/Comunidade-Anima/public/index.php") {
        header("Location: index.php?page=Home");
        exit;
    };
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
    
</head>
<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu.php"; ?>
</body>
</html>
