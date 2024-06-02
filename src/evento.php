<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="styles/style-pattern.css">
    <link rel="stylesheet" href="styles/evento.css">
    <title>Eventos</title>
</head>

<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <a href="">
                    <span class="image">
                        <img src="../imgs/usuario/user-1.webp" alt="">
                    </span>
                </a>


                <div class="text logo-text">
                    <span class="name">Felipe</span>
                    <span class="profession">Ciência da computação</span>
                </div>
            </div>


        </header>

        <div class="menu-bar">
            <div class="menu">

                <ul class="menu-links">

                    <li class="nav-link">
                        <a class="toggle" style="cursor:pointer;">
                            <i class='bx bx-menu icon' id="menu-icon"></i>
                            <span class="text nav-text">Menu</span>
                        </a>
                    </li>


                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-calendar-event icon'></i>
                            <span class="text nav-text">Evento</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-trophy icon'></i>
                            <span class="text nav-text">Atléticas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-shape-triangle icon'></i>
                            <span class="text nav-text">Comodidades</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="#">
                            <i class='bx bx-support icon'></i>
                            <span class="text nav-text">Suporte</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="#">
                        <i class='bx bx-log-out icon'></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

            </div>
        </div>

    </nav>

    <section class="home">
        <div class="event-img">
            <img src="../imgs/card/avalanche.jpg" class="img-fluid" alt="...">
        </div>
        <div class="event-img-small">
            <img src="../imgs/card/avalanche.jpg" class="img-fluid" alt="...">
        </div>
        <div class="event-text">
            <div class="event-name">
                <h1>CERVEJADA: AVALANCHE UFPR</h1>
            </div>
            <div class="event-info-container">
                <div class="event-info">
                    <div class="event-data">
                        <div class="event-title">
                            <i class='bx bxs-stopwatch'></i>
                            <h2>Data e Horário</h2>
                        </div>
                        <div class="event-data-content">
                            <h3>11 de junho de 2024</h3>
                        </div>
                    </div>
                    <div class="event-adress">
                        <div class="event-title">
                            <i class='bx bxs-map'></i>
                            <h2>Endereço e Local</h2>
                        </div>
                        <div class="event-adress-content">
                            <h3>Av. Dr. Assis Ribeiro, 5895-5899 - Ermelino Matarazzo, São Paulo - SP - São Paulo / São Paulo</h3>
                        </div>
                    </div>
                    <div class="event-age">
                        <div class="event-title">
                            <i class='bx bxs-error-circle'></i>
                            <h2>Faixa Etária</h2>
                        </div>
                        <div class="event-age-content">
                            <h3>Proibido menores de 18</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="event-buttons">
            <div class="event-container">
                <form action="#" method="post" id="form-like">
                    <button type="submit"><i class='bx bxs-heart'></i>Tenho interesse</button>
                </form>
                <div class="other-btn">
                    <a href=""><i class='bx bxs-map-pin'></i></a>
                    <a href=""><i class='bx bx-calendar-exclamation'></i></a>
                    <a href=""><i class='bx bxs-share-alt'></i></a>
                </div>
            </div>
        </div>
        <div class="event-description">
            <div class="event-container">
                <h1>Descrição do evento</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem corporis obcaecati aspernatur doloremque qui fugit possimus. Voluptates ullam rerum, corrupti possimus explicabo nemo quia quis id vitae cumque laborum, sequi asperiores tempora. Dolorum consequatur odio, voluptatibus molestiae quaerat dolores voluptatem ipsum. Veniam ipsa sapiente quod perferendis corporis pariatur ea, error nostrum earum?</p>
            </div>
        </div>
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