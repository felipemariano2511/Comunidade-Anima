<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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