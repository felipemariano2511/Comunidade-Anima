<?php
    use App\Session\User as SessionUser;

    $user_info = SessionUser::getInfo();

    if($user_info['nivel'] == 'ADM'){   
        $query = "SELECT * FROM usuario";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $tableData[] = $row;
            }
        }else{
            $tableData = null;
        }
    }else{
        header('Location: index.php');
    }
    //Deletar usuario baseado no id
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete'])){
        $id = $_POST['delete'];

        $query = "DELETE FROM usuario WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        if($result){
            echo '<script>alert("O usuário foi deletado com sucesso!")</script>';
            header('Location: '.$_SERVER['REQUEST_URI']);
            exit();
        }
        
    }



?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/gerenciar_usuarios.css">
    <title>Comunidade Ânima - Gerenciar usuários</title>
</head>
    <section class="home">
        <div class="home-title">
            <h1>Gerenciar Usuários</h1>
            <p>CRUD para usuarios</p>
        </div>
        <div class="container">
            <h1>Administração de Usuários</h1>
            <a href="novo_usuario.php" id="addUserBtn">Adicionar Usuário<i class='bx bx-plus'></i></a>
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Nome</th>
                        <th>Senha</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        foreach($tableData as $data){
                            echo '  <tr>  
                                        <td>'.$data['id'].'</td>
                                        <td>'.$data['email'].'</td>
                                        <td>'.$data['nome'].'</td>
                                        <td>************************</td>
                                        <td class="actions">
                                            <form method="POST">
                                                <button class="icon-button editBtn" name="edit"><i class="bx bx-edit"></i></button>
                                                <button class="icon-button deleteBtn" value="'.$data['id'].'" name="delete"><i class="bx bx-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
