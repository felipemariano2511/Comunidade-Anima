<?php

    include "../../includes/config.php";
    use \App\Session\User as SessionUser;

    $email = $user_info['mail'];

    $i = 1;
    while($i <= 2){
    
        $query = "SELECT * FROM usuario WHERE email = '$email'";
        $result = mysqli_query($con, $query);
        
        if(mysqli_num_rows($result) > 0){
            //Caso usuário já exista, irá coletar seus dados
            foreach($result as $tableData){
            }
            SessionUser::setDados($tableData['id'],$tableData['ra'], $tableData['email'], $tableData['nome'], $tableData['imagem_perfil']);
            $i++;
        }else{
            //Irá criar o usuário e armazenar seus dados
            $ra = 223456789;
            $email = $user_info['mail'];
            $nome = $user_info['displayName'];

            $query = "INSERT INTO usuario(ra, email, nome) VALUES ('$ra', '$email', '$nome')";
            $result = mysqli_query($con, $query);

            $i++;
        }
    }
?>