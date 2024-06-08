<?php
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/home.css">
    <title>Home</title>


</head>

<body>

    <section class="homepage">
        <div class="home-title">
            <h1>Home</h1>
            <p>Conheça nossa comunidade!</p>
        </div>
        <div class="links-container">
            <div class="links-item">
                <a href="index.php?page=Eventos"><img src="../imgs/dev/eventos.svg" alt=""></a>
                <a href="index.php?page=Eventos" class="button">Eventos</a>
            </div link>
            <div class="links-item">
                <a href="index.php?page=Atléticas"><img src="../imgs/dev/atletica.svg" alt=""></a>
                <a href="index.php?page=Atléticas" class="button">Atléticas</a>
            </div>
            <div class="links-item">
                <a href="index.php?page=Comodidades"><img src="../imgs/dev/comodidades.svg" alt=""></a>
                <a href="index.php?page=Comodidades" class="button">Comodidades</a>
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