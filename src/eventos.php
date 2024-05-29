
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
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
            <div class="card">
                <img src="../imgs/card/marciaoshowdebola.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Marcio e Marcelo</h5>
                    <p class="card-text">Costelinha e coxa sobre coxa, conheça os gêmeos do churrasco, sentem na graxa.</p>
                    <div class="card-buttons">
                        <a href="#" class="btn btn-primary">Ver detalhes</a>
                        <div class="like-share">
                            <i class='bx bx-heart heart-icon'></i>
                            <i class='bx bx-share bx-flip-horizontal'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../imgs/dev/anima.png" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Marcio e Marcelo</h5>
                    <p class="card-text">Costelinha e coxa sobre coxa, conheça os gêmeos do churrasco, sentem na graxa.</p>
                    <div class="card-buttons">
                        <a href="#" class="btn btn-primary">Ver detalhes</a>
                        <div class="like-share">
                            <i class='bx bx-heart heart-icon'></i>
                            <i class='bx bx-share bx-flip-horizontal'></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <img src="../imgs/card/marciaoshowdebola.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Marcio e Marcelo</h5>
                    <p class="card-text">Costelinha e coxa sobre coxa, conheça os gêmeos do churrasco, sentem na graxa.</p>
                    <div class="card-buttons">
                        <a href="#" class="btn btn-primary">Ver detalhes</a>
                        <div class="like-share">
                            <i class='bx bx-heart heart-icon'></i>
                            <i class='bx bx-share bx-flip-horizontal'></i>
                        </div>
                    </div>

                </div>
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