<?php
    include '../app/includes/config.php'; 
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;

    $uri = $_SERVER['REQUEST_URI'];

    if ($uri == "/Comunidade-Anima/public/portal_adm.php") {
        header("Location: portal_adm.php?page=PortalADM");
        exit;
    };

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
        if($user_info['nivel'] != "ADM"){
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }

    $pagina = isset($_GET['page']) ? $_GET['page'] : '';

    switch ($pagina){
        case '':
            $page = '../src/portal_adm.php';
            break;

        case 'PortalADM':
            $page = '../src/portal_adm.php';
            break;
        
        case 'AprovarEventos':
            $page = '../src/aprovar_eventos.php';
            break;

        case 'GerenciarAtléticas':
            $page = '../src/gerenciar_atleticas.php';
            break;

        case 'GerenciarComodidades':
            $page = '../src/gerenciar_comodidades.php';
            break; 
            
        case 'GerenciarUsuários':
            $page = '../src/gerenciar_usuarios.php';
            break; 
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/portal_adm.css">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Portal Adm</title>
    
</head>
<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu.php"; ?>
    <?php include $page;?>
    
</body>
</html>