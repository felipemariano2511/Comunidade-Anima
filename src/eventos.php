<?php
include '../app/includes/crontab.php';

$query = "SELECT * FROM eventos WHERE situacao = 'ativo' ORDER BY data_inicial ASC";
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
    <link rel="stylesheet" href="../src/styles/eventos.css">
    <title>Eventos</title>
</head>
<section class="home">
    <div class="text">
        <h1>Eventos</h1>
        <p>Acompanhe os eventos que estão rolando!</p>
    </div>
    <div class="cards-main">
        <?php
        if (is_array($tableData) && !empty($tableData)) {
            foreach ($tableData as $dados) {
                echo '
                <div class="card">
                    <img src="' . $dados['arquivo'] . '" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">' . $dados['titulo'] . '</h5>
                        <p class="card-text">' . $dados['descricao_inicial'] . '</p>
                        <div class="card-buttons">
                            <a href="evento.php?id=' . $dados['id'] . '" class="btn btn-primary">Ver detalhes</a>
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
                    const id = this.getAttribute('data-id');
                    const urlField = document.getElementById('urlField');
                    const url = `http://localhost/Comunidade-Anima/public/evento.php?id=${id}`;
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.heart-icon').forEach(function(icon) {
            icon.addEventListener('click', function() {
                this.classList.toggle('bx-heart');
                this.classList.toggle('bxs-heart');
                this.classList.toggle('liked');
            });
        });
    });
</script>

<script>
    const body = document.querySelector('body'),
        sidebar = body.querySelector('nav'),
        toggle = body.querySelector(".toggle"),
        searchBtn = body.querySelector(".search-box"),
        modeSwitch = body.querySelector(".toggle-switch"),
        modeText = body.querySelector(".mode-text");


    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    })

    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    })

    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Light mode";
        } else {
            modeText.innerText = "Dark mode";

        }
    });
</script>
</body>

</html>