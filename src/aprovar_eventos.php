<?php
    include '../app/includes/config.php';
    use App\Session\User as SessionUser;

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
    }
    if($user_info['nivel'] != "ADM"){
        header("Location: index.php");
    }

    $query = "SELECT * FROM eventos WHERE situacao = 'pendente'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $tableData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tableData[] = $row;
        }
    } else {
        $tableData = "";
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['aprovar'])){
        $id = $_POST['aprovar'];

        $query = "UPDATE eventos SET situacao = 'aprovado' WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        echo '<script>window.location.href="portal_adm.php?page=AprovarEventos"</script>';

    }elseif($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['recusar'])){
        $id = $_POST['recusar'];

        $query = "UPDATE eventos SET situacao = 'recusado', justificativa = 'Seu evento foi recusado por não estra coerente' WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        echo '<script>window.location.href="portal_adm.php?page=AprovarEventos"</script>';

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
    <link rel="stylesheet" href="../src/styles/aprovar_eventos.css">
</head>

<body>
    <section class="home">
        <div class="home-title">
            <h1>Aprovar Eventos</h1>
            <p>Portal para analisar eventos pendentes</p>
        </div>
        <div class="cards-container">
            <div class="row row-cols-1 row-cols-md-3 g-5">
                <?php
                    if (is_array($tableData) && !empty($tableData)) {
                        foreach ($tableData as $dados) {
                            echo '
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="'.$dados['arquivo'].'" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <h5 class="card-title">'.$dados['titulo'].'</h5>
                                            <p class="card-text">'.$dados['descricao_inicial'].'</p>
                                        </div>
                                        <a href="evento.php?id='.$dados['id'].'">Acesse Aqui!</a>
                                        <br>
                                        <form action="" method="post">
                                            <div class="card-buttons">
                                                <div class="buttons-container">
                                                    <button class="aprovar" name="aprovar" value="'.$dados['id'].'">Aprovar</button>
                                                    <button class="recusar" name="recusar" value="'.$dados['id'].'">Recusar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>';

                        }
                    
                    }else{
                        echo '<h2>Nenhum evento aguardando aprovação!</h2>';
                    }
                ?>
            </div>
        </div>
    </section>
</body>