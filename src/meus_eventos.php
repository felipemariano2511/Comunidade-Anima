<?php
    include '../app/includes/config.php';
    use App\Session\User as SessionUser;

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
        $id = $user_info['id'];
    }

    $query = "SELECT * FROM eventos WHERE autor = '$id'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $tableData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tableData[] = $row;
        }
    } else {
        $tableData = "";
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
    <title>Comunidade - Ânima - Meus Eventos</title>
</head>

<body>
    <section class="home">
        <div class="home-title">
            <h1>Meus Eventos</h1>
            <p>Portal para analisar o status dos seus Eventos</p>
        </div>
        <div class="cards-container">
            <div class="row row-cols-1 row-cols-md-3 g-5">
                <?php
                    if (is_array($tableData) && !empty($tableData)) {
                        foreach ($tableData as $dados) {
                            echo '    
                                    <div class="col">
                                        <div class="card h-100">
                                            <a href="evento.php?id='.$dados['id'].'"><img src="'.$dados['arquivo'].'" class="card-img-top" alt="..."></a>
                                            <div class="card-body">
                                                <h5 class="card-title">'.$dados['titulo'].'</h5>
                                                <p class="card-text">'.$dados['descricao_inicial'].'</p>
                                            </div>
                                            <div class="card-footer">
                                                <div class="status">
                                                    <small class="text-body-secondary">Situação:</small>';
                                                if($dados['situacao'] == 'ativo'){
                                                    echo '<a class="aprovado">Aprovado</a>';
                                                }elseif($dados['situacao'] == 'pendente'){
                                                    echo '<a class="pendente">Pendente</a>';
                                                }else{
                                                    echo '<a class="recusado">Recusado</a>';
                                                }
                                                echo '  
                                                </div>
                                                <div class="adm-text">
                                                    <small class="text-body-secondary">Esclarecimento:</small>
                                                    <span>'.$dados['justificativa'].'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>'
                                ;
                        }
                    }else{
                        echo "<h3>Você não possui eventos cadastrados!</h3>";
                    }
                ?>
            </div>
        </div>
    </section>
</body>
