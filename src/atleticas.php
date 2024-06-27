@ -1,119 +1,118 @@
<?php
include '../app/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $pesquisa = mysqli_real_escape_string($con, ucwords($_POST['search']));
}

if (!$pesquisa == "") {
    $query = "SELECT * FROM servicos_universitarios WHERE titulo LIKE '%$pesquisa%' AND servico = 'Atlética' ORDER BY curtidas DESC";
} else {
    $query = "SELECT * FROM servicos_universitarios WHERE servico = 'Atlética' ORDER BY curtidas DESC";
}

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $tableData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tableData[] = $row;
    }
    $sem_resultados = FALSE;
} else {
    $sem_resultados = TRUE;
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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/atleticas.css">
    <link rel="stylesheet" href="../src/styles/eventos.css">
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
                <form action='' method="POST">
                    <i class='bx bx-search'></i>
                    <input type="search" name="search" id="" placeholder="Procure por atléticas">
                </form>
            </div>
            <div class="atletica-title">
                <?php
                if ($sem_resultados == FALSE) {
                    echo '<h1>Mais Relevantes</h1>';
                } else {
                    echo '<h1>Sem resultados para essa consulta!</h1>';
                }
                ?>
            </div>
            <div class="atletica-card">
                <?php
                if ($sem_resultados == FALSE) {
                    $rows = $tableData;
                    $cont = 0;

                    foreach ($rows as $data) {
                        $relevancia[] = $data['titulo'];
                        $id[] = $data['id'];
                        $cont++;
                    }
                    if ($cont > 6) {
                        $i = 6;
                    } elseif ($cont > 3 && $cont <= 6) {
                        $i = 3;
                    } else {
                        $i = $cont;
                    }
                    $e = 0;
                    while ($i > $e) {
                        echo '<a href="servicos_universitarios.php?id=' . $id[$e] . '#">' . $relevancia[$e] . '</a>';
                        $e++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="cards-main">
        <?php
        if ($sem_resultados == FALSE) {
            foreach ($tableData as $dados) {
                echo '<div class="card">
                                <img src="' . $dados['arquivo'] . '" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $dados['titulo'] . '</h5>
                                    <p class="card-text">' . $dados['descricao_inicial'] . '</p>
                                    <div class="card-buttons">
                                        <a href="servicos_universitarios.php?id=' . $dados['id'] . '" class="btn btn-primary">Ver detalhes</a>
                                        <div class="like-share">  
                                            <i class="bx bx-share bx-flip-horizontal compartilhar" data-id="' . $dados['id'] . '"></i>
                                        </div>
                                    </div>
                                </div>
                             </div>';
            }
        }
        ?>
    </div>
    <!-- Campo de texto oculto para copiar a URL -->
    <textarea id="urlField" style="display:none;"></textarea>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareButtons = document.querySelectorAll('.compartilhar');

            shareButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentHost = window.location.host;
                    const id = this.getAttribute('data-id');
                    const urlField = document.getElementById('urlField');
                    const url = `http://${currentHost}/Comunidade-Anima/public/servicos_universitarios.php?id=${id}`;
                    urlField.value = url;
                    urlField.style.display = 'block';
                    urlField.select();
                    urlField.setSelectionRange(0, 99999); // Para dispositivos móveis

                    try {
                        const successful = document.execCommand('copy');
                        const msg = successful ? 'URL copiada com sucesso!' : 'Falha ao copiar a URL';
                        alert(msg);
                    } catch (err) {
                        console.error('Erro ao copiar a URL: ', err);
                    }

                    urlField.style.display = 'none';
                });
            });
        });
    </script>
</section>
</body>

</html>
@ -1,119 +1,118 @@
<?php
include '../app/includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search'])) {
    $pesquisa = ucwords($_POST['search']);
}

if (!$pesquisa == "") {
    $query = "SELECT * FROM servicos_universitarios WHERE titulo LIKE '%$pesquisa%' AND servico = 'Atlética' ORDER BY curtidas DESC";
} else {
    $query = "SELECT * FROM servicos_universitarios WHERE servico = 'Atlética' ORDER BY curtidas DESC";
}

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $tableData = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $tableData[] = $row;
    }
    $sem_resultados = FALSE;
} else {
    $sem_resultados = TRUE;
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
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/atleticas.css">
    <link rel="stylesheet" href="../src/styles/eventos.css">
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
                <form action='' method="POST">
                    <i class='bx bx-search'></i>
                    <input type="search" name="search" id="" placeholder="Procure por atléticas">
                </form>
            </div>
            <div class="atletica-title">
                <?php
                if ($sem_resultados == FALSE) {
                    echo '<h1>Mais Relevantes</h1>';
                } else {
                    echo '<h1>Sem resultados para essa consulta!</h1>';
                }
                ?>
            </div>
            <div class="atletica-card">
                <?php
                if ($sem_resultados == FALSE) {
                    $rows = $tableData;
                    $cont = 0;

                    foreach ($rows as $data) {
                        $relevancia[] = $data['titulo'];
                        $id[] = $data['id'];
                        $cont++;
                    }
                    if ($cont > 6) {
                        $i = 6;
                    } elseif ($cont > 3 && $cont <= 6) {
                        $i = 3;
                    } else {
                        $i = $cont;
                    }
                    $e = 0;
                    while ($i > $e) {
                        echo '<a href="servicos_universitarios.php?id=' . $id[$e] . '#">' . $relevancia[$e] . '</a>';
                        $e++;
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="cards-main">
        <?php
        if ($sem_resultados == FALSE) {
            foreach ($tableData as $dados) {
                echo '<div class="card">
                                <img src="' . $dados['arquivo'] . '" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title">' . $dados['titulo'] . '</h5>
                                    <p class="card-text">' . $dados['descricao_inicial'] . '</p>
                                    <div class="card-buttons">
                                        <a href="servicos_universitarios.php?id=' . $dados['id'] . '" class="btn btn-primary">Ver detalhes</a>
                                        <div class="like-share">  
                                            <i class="bx bx-share bx-flip-horizontal compartilhar" data-id="' . $dados['id'] . '"></i>
                                        </div>
                                    </div>
                                </div>
                             </div>';
            }
        }
        ?>
    </div>
    <!-- Campo de texto oculto para copiar a URL -->
    <textarea id="urlField" style="display:none;"></textarea>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const shareButtons = document.querySelectorAll('.compartilhar');

            shareButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const currentHost = window.location.host;
                    const id = this.getAttribute('data-id');
                    const urlField = document.getElementById('urlField');
                    const url = `http://${currentHost}/Comunidade-Anima/public/servicos_universitarios.php?id=${id}`;
                    urlField.value = url;
                    urlField.style.display = 'block';
                    urlField.select();
                    urlField.setSelectionRange(0, 99999); // Para dispositivos móveis

                    try {
                        const successful = document.execCommand('copy');
                        const msg = successful ? 'URL copiada com sucesso!' : 'Falha ao copiar a URL';
                        alert(msg);
                    } catch (err) {
                        console.error('Erro ao copiar a URL: ', err);
                    }

                    urlField.style.display = 'none';
                });
            });
        });
    </script>
</section>
</body>

</html>