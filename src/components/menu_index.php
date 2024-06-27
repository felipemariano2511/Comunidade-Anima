<?php
    include_once '../app/Session/User.php'; 
    use App\Session\User as SessionUser;

    $user_info = SessionUser::getInfo();

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
            
        case 'MeusEventos':
            $page = '../src/meus_eventos.php';
            break; 

        case 'MaisCurtidos':
            $page = '../src/mais_curtidos.php';
            break; 
    }
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    
</head>

<body>
    <nav class="sidebar close">
        <header>
        <div class="image-text">
                <a href="<?php if(!SessionUser::isLogged()){echo 'login.php';}else{echo  'perfil.php?id='.$user_info['id'].'';}?>">
                    <span class="image">
                        <img src="<?php if(SessionUser::isLogged()){echo  $user_info['imagem'];}else{echo "../imgs/usuario/user-1.webp";} ?>" alt="Foto de perfil">

                    </span>
                </a>


                <div class="text logo-text">
                    <span class="name"><?php
                                            if(SessionUser::isLogged()){
                                                $user_info = SessionUser::getInfo();

                                                echo "<a href='perfil.php?id=".$user_info['id']."'>".$user_info['firstName']."</a>";
                                            }else{
                                                echo "<a href='login.php' class='text nav-text' style='text-decoration: none; color: #9800ee; text-weight: 500; margin-left: 5px;'>Fazer Login<i class='bx bx-log-in'></i></a>";
                                            }
                                        ?>
                    </span>
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
                        <a href="?page=Home">
                            <i class='bx bx-home-alt icon'></i>
                            <span class="text nav-text">Home</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="?page=Eventos">
                            <i class='bx bx-calendar-event icon'></i>
                            <span class="text nav-text">Eventos</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="?page=Atléticas">
                            <i class='bx bx-trophy icon'></i>
                            <span class="text nav-text">Atléticas</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="?page=Comodidades">
                            <i class='bx bx-shape-triangle icon'></i>
                            <span class="text nav-text">Comodidades</span>
                        </a>
                    </li>
                    <?php
                        if(SessionUser::isLogged()){
                            if($user_info['nivel'] == "USR" || $user_info['nivel'] == "ADM"){
                                echo '<li class="nav-link">
                                        <a href="novo_evento.php">
                                            <i class="bx bx-plus icon"></i>
                                            <span class="text nav-text">Novo evento</span>
                                        </a>
                                    </li>
                                    <li class="nav-link">
                                        <a href="?page=MeusEventos">

                                            <i class="bx bi-layout-text-window-reverse icon"></i>
                                            <span class="text nav-text">Meus eventos</span>
                                        </a>
                                    </li>';
                            }
                        }
                    ?>
                    <li class="nav-link">
                        <a href="?page=MaisCurtidos">
                            <i class='bx bx-heart icon'></i>
                            <span class="text nav-text">Mais curtidos</span>
                        </a>
                    </li>
                    <?php
                        if(SessionUser::isLogged()){
                            if($user_info['nivel'] == "ADM"){
                                echo '<li class="nav-link">
                                        <a href="portal_adm.php">
                                            <i class="bx bx-check-shield icon"></i>
                                            <span class="text nav-text">Portal ADM</span>
                                        </a>
                                    </li>';
                            }
                        }    
                    ?>
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
        <?php include $page;?>
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