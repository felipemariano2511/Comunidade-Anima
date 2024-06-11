<?php
    use App\Session\User as SessionUser;
?>

<nav class="sidebar close">
        <header>
        <div class="image-text">
                <a href="<?php if(!SessionUser::isLogged()){echo 'login.php';}?>">
                    <span class="image">
                        <img src="../imgs/usuario/user-1.webp" alt="">
                    </span>
                </a>
                <div class="text logo-text">
                    <span class="name">
                        <?php
                            if(SessionUser::isLogged()){
                                $user_info = SessionUser::getInfo();

                                echo $user_info['firstName'];
                            }else{
                                echo '<a href="login.php" class="text nav-text" style="text-decoration: none;">Login</a>';
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
                    <?php
                        if(SessionUser::isLogged()){
                            if($user_info['nivel'] == "USR" || $user_info['nivel'] == "ADM"){
                                echo '<li class="nav-link">
                                        <a href="novo_evento.php">
                                            <i class="bx bx-plus icon"></i>
                                            <span class="text nav-text">Novo Evento</span>
                                        </a>
                                    </li>';
                            }
                        }
                    ?>
                    <li class="nav-link">
                        <a href="index.php?page=MaisCurtidos">
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
