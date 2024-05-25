<?php
    include "../app/Session/User.php";
    use \App\Session\User as SessionUser;

    if (!SessionUser::isLogged()){
        header('Location: login.php');
    }
    $info_user = SessionUser::getInfo();

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logout-button'])){
        SessionUser::logout();
    }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
        }
        h1 {
            color: #333;
        }
        p {
            color: #666;
        }
        .logout-button {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007BFF;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .logout-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($info_user['nome']); ?>!</h1>
        <p>Estamos felizes em tê-lo conosco.</p>
        <p>Seu email: <?php echo htmlspecialchars($info_user['email']); ?></p>
        <form action="" method="post">
            <button class="logout-button" name="logout-button">Logout</button>
        </form>
        
    </div>
</body>
</html>
