<?php
    $query = "SELECT * FROM servicos_universitarios WHERE situacao = 'ativo' AND servico = 'Comodidades'";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/comodidades.css">
    <title>Comunidade Ânima - Comodidades</title>
</head>

<body>
    <section class="home">
        <div class="home-title">
            <h2>Comodidades</h2>
            <p>Você ja sabe das suas comodidades?</p>
        </div>
        <?php
            if (is_array($tableData) && !empty($tableData)) {
                foreach ($tableData as $dados) {
                    echo '<div class="links-container">
                            <div class="links-item">
                                <a href="servicos_universitarios.php?id='. $dados['id'].'"><img src="'.$dados['arquivo'].'" alt=""></a>
                                <a href="servicos_universitarios.php?id='. $dados['id'].'" class="button">'.$dados['titulo'].'</a>
                          </div link>';
                }
            }
        ?>
    </section>
    <script>
        const body = document.querySelector('body'),
            sidebar = body.querySelector('nav'),
            toggle = body.querySelector(".toggle");


        toggle.addEventListener("click", () => {
            sidebar.classList.toggle("close");
        })
    </script>
</body>

</html>