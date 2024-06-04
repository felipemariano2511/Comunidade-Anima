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
    <title>Login via Microsoft</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background-color: #fff;
            padding: 20px 40px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .login-button {
            background-color: #0078d4;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
        }
        .login-button:hover {
            background-color: #005a9e;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login via Microsoft</h1>
        <a href="<?php echo htmlspecialchars($authorization_url); ?>" class="login-button">
            Login with Microsoft
        </a>
        <a href="PortalAdm/index.php">É um Adminstrador? Acesse o Portal do Administrador clicando aqui!</a>
    </div>
</body>
</html>
