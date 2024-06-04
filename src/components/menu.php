<?php
include_once '../app/Session/User.php'; 
use App\Session\User as SessionUser;

if(isset($_GET['page'])){
    $pagina = isset($_GET['page']) ? $_GET['page'] : '';

    switch ($pagina){
        case '':
            $page = '../src/home.php';
            break;

        case 'Home':
            $page = '../src/home.php';
            break;

        case 'Eventos':
            $page = '../src/eventos.php';
            break;

        case 'Atléticas':
            $page = '../src/atleticas.php';
            break;

        case 'Comodidades':
            $page = '../src/comodidades.php';
            break; 
            
        case '':
            $page = '../src/.php';
            break; 

        case 'Likes':
            $page = '../src/likes.php';
            break; 

        case 'Suporte':
            $page = '../src/suporte.php';
            break;
    }
}else{
    $page = null;
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style.css">
    <title>Eventos</title>
</head>
<body>
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
                        <a href="index.php?page=Home">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Eventos">
                            <i class='bx bx-calendar-event icon'></i>
                            <span class="text nav-text">Eventos</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Atléticas">
                            <i class='bx bx-trophy icon'></i>
                            <span class="text nav-text">Atléticas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Comodidades">
                            <i class='bx bx-shape-triangle icon'></i>
                            <span class="text nav-text">Comodidades</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Likes">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Likes</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="index.php?page=Suporte">
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
        <?php 
            if($page !== null){
                include $page;
            }?>
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