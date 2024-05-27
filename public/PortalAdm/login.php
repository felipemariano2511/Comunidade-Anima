<?php
    include "../../app/includes/config.php";
    include "../../app/Session/Adm.php";
    use \App\Session\Adm as SessionAdm;



    if($_SERVER['REQUEST_METHOD'] == 'POST'  && isset($_POST['entrar'])){
        $usuario = $_POST['username'];
        $password = md5($_POST['password']);

        $query = "SELECT * FROM administrador WHERE usuario = '$usuario'";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) == 0) {
            echo '<script>alert("Usuario ou senha incorretos!");</script>';
        } else{
            foreach($result as $tableData){
                if ($tableData['senha'] == $password){
                    SessionAdm::login($usuario);
                    SessionAdm::setDados($tableData['usuario'], $tableData['nome'], $tableData['email']);
                    header("Location: index.php");
                } else{
                    echo '<script>alert("Usuario ou senha incorretos!");</script>';
                }
            }
        }
    }



?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
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

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            text-align: center;
            width: 300px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .input-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .input-group label {
            display: block;
            margin-bottom: 5px;
            color: #666;
        }

        .input-group input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="login.php" method="post">
            <div class="input-group">
                <label for="username">Usuário</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Senha</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="entrar">Entrar</button>
        </form>
    </div>
</body>
</html>

