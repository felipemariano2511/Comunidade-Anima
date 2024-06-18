<?php
    use \App\Session\User as SessionUser;

    $query = "SELECT * FROM usuario WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    
    if(mysqli_num_rows($result) > 0){
        foreach($result as $tableData){
        }
        $nome = $tableData['nome'];
        $first_name = explode(" ", $nome);

        SessionUser::setDados($first_name[0], $tableData['id'], $tableData['email'], $tableData['nome'], $tableData['nivel'], $tableData['imagem']);
    }
    
?>