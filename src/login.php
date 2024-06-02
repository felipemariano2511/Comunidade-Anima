<?php
session_start();

// Defina as variáveis de configuração
$client_id = 'a67a5d11-bddf-48cf-bc64-dbd5f96470e5';
$redirect_uri = 'http://localhost/Comunidade-Anima/app/APIs/Login_Microsoft/callback.php';
$scope = 'openid User.Read';

// Gera um valor único para o state
$_SESSION['oauth2state'] = bin2hex(random_bytes(16));

// Construa a URL de login
$authorization_url = 'https://login.microsoftonline.com/common/oauth2/v2.0/authorize?' . http_build_query([
    'client_id' => $client_id,
    'response_type' => 'code',
    'redirect_uri' => $redirect_uri,
    'scope' => $scope,
    'response_mode' => 'query',
    'state' => $_SESSION['oauth2state'],
]);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade Ânima - Login</title>
    <link rel="shortcut icon" href="../imgs/dev/login.png" type="image/x-icon">
    <link rel="stylesheet" href="../public/styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f2b509d698.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

</body>

</html>