<?php
    

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
        <div class="links-container">
            <div class="links-item">
                <a href="index.php?page=Eventos"><img src="../imgs/dev/eventos.svg" alt=""></a>
                <a href="index.php?page=Eventos" class="button">Comodidade1</a>
            </div link>
            <div class="links-item">
                <a href="index.php?page=Atléticas"><img src="../imgs/dev/atletica.svg" alt=""></a>
                <a href="index.php?page=Atléticas" class="button">Comodidade2</a>
            </div>
            <div class="links-item">
                <a href="index.php?page=Comodidades"><img src="../imgs/dev/comodidades.svg" alt=""></a>
                <a href="index.php?page=Comodidades" class="button">Comodidade3</a>
            </div>
        </div>
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