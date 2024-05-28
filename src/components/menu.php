<?php
    use \App\Session\User as SessionUser;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="../src/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
</head>

<body>
    <header class="header-main">
        <div class="container-header">
            <img src="../imgs/dev/logo-anima-1024-white.png" alt="" width="100px">
        </div>
    </header>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <a href="<?php if(!SessionUser::isLogged()){echo 'login.php';}?>">
                    <span class="image">
                        <img src="../imgs/usuario/user-1.webp" alt="">
                    </span>
                </a>


                <div class="text logo-text">
                    <span class="name"><?php
                                            if(SessionUser::isLogged()){
                                                $user_info = SessionUser::getInfo();

                                                echo $user_info['firstName'];
                                            }else{
                                                echo '<a href="login.php" class="text nav-text" style="text-decoration: none;">Login</a>';
                                            }
                                        ?>
                    </span>
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
                        <a href="eventos.php">
                            <i class='bx bx-calendar-event icon'></i>
                            <span class="text nav-text">Eventos</span>
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
            
            <?php
                if(SessionUser::isLogged()){
                    echo '<div class="bottom-content">
                            <li class="">
                                <a href="../app/includes/logout.php">
                                    <i class="bx bx-log-out icon"></i>
                                    <span class="text nav-text">Logout</span>
                                </a>
                            </li>
                          </div>';
                }
            ?>
        </div>
    </nav>

    <section class="home">
        <div class="text">
            <h1>Nome da aba</h1>
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