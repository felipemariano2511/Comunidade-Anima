<?php
    include '../app/includes/config.php';

    $query = "SELECT * FROM servicos_universitarios WHERE servico = 'Atlética' AND situacao = 'ativo'";
    $result = mysqli_query($con, $query);

    if ($result) {
        $tableData = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $tableData[] = $row;
        }
        
    } else {
        echo "Sem resultados para essa consulta! ";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"><link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/atleticas.css">
    <title>Atléticas</title>
</head>

    <section class="home">
        <div class="home-title">
            <h1>Atléticas</h1>
            <p>Acompanhe nossas atléticas!</p>
        </div>
        <div class="atletica-content">
            <div class="atletica-container">
                <div class="search-bar">
                    <i class='bx bx-search'></i>
                    <input type="search" name="barra-pesquisa" id="" placeholder="Procure por atléticas">
                </div>
                <div class="atletica-title">
                    <h1>Mais Relevantes</h1>
                </div>
                <div class="atletica-card">
                    <a href="">Bugatos</a>
                    <a href="">Intoxicados</a>
                    <a href="">Avalanche</a>
                    <a href="">Católitros</a>
                    <a href="">Jirombinhas</a>
                    <a href="">#SNPFC</a>
                </div>
            </div>
        </div>
        <?php
        if (is_array($tableData) && !empty($tableData)) {
            foreach ($tableData as $dados) {
                if ($dados['situacao'] == "ativo") {
                    echo '
                    <div class="cards-main">
                        <div class="card">
                            <img src="'.$dados['arquivo'].'" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">'.$dados['titulo'].'</h5>
                                <p class="card-text">'.$dados['descricao_inicial'].'</p>
                                <div class="card-buttons">
                                    <a href="servicos_universitarios.php?id='.$dados['id'].'" class="btn btn-primary">Ver detalhes</a>
                                    <div class="like-share">
                                        <i class="bx bx-heart heart-icon"></i>
                                        <i class="bx bx-share bx-flip-horizontal compartilhar" data-id="'.$dados['id'].'"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
                }
            }
        }
    ?>
    </section>

    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle"),
            searchBtn = body.querySelector(".search-box"),
            modeSwitch = body.querySelector(".toggle-switch"),
            modeText = body.querySelector(".mode-text");


        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        });
    </script>
</body>

</html>
