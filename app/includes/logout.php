<?php
    include_once "../Session/User.php";
    use \App\Session\User as SessionUser;

    if(SessionUser::isLogged()){
        SessionUser::logout();
    }else{
        header("Location: ../../public/login.php");
    }
    

?>