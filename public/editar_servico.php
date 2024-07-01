<?php
    include "../app/includes/config.php";
    include '../app/Session/User.php';

    use App\Session\User as SessionUser;

    $user_info = SessionUser::getInfo();
    $id = isset($_GET['id']) ? $_GET['id'] : '';

    if ($user_info['nivel'] != "ADM") {
        header("Location: index.php");
        exit();
    } 

    $query = "SELECT * FROM servicos_universitarios WHERE id = '$id'";
    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $tableData = $row;
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])) {
        $servico = $_POST['inlineRadioOptions'];
        $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
        $responsavel = mysqli_real_escape_string($con, $_POST['responsavel']);
        $descricao_inicial = mysqli_real_escape_string($con, $_POST['descricao_inicial']);
        $descricao_completa = mysqli_real_escape_string($con, $_POST['descricao_completa']);
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $arquivo = $_FILES['arquivo'];

        if($arquivo['tmp_name'] == ''){
            $endereco_arquivo = $tableData['arquivo'];
        }

        if ($arquivo['error'] === 0) {
            $endereco_arquivo = '../imgs/posts/' . $arquivo['name'];
            move_uploaded_file($arquivo['tmp_name'], $endereco_arquivo);
        }

        $query = "UPDATE servicos_universitarios 
                        SET servico = '$servico', 
                            titulo = '$titulo', 
                            responsavel = '$responsavel', 
                            descricao_inicial = '$descricao_inicial', 
                            descricao_completa = '$descricao_completa', 
                            telefone = '$telefone', 
                            email = '$email', 
                            arquivo = '$endereco_arquivo' 
                        WHERE id = '$id'";

        $result = mysqli_query($con, $query);

        if ($result) {
            echo '<script>alert("Atualizado com sucesso!");</script>';
        } else {
            echo '<script>alert("Falha no cadastro!")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade Ânima - Novo Serviço</title>
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/novo_servico.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <script src="../tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="js/script.js" referrerpolicy="origin"></script>

    <script>
        initializeTinyMCE();
    </script>
</head>

<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu.php"; ?>

    <section class="home">
        <div class="text">
            <?php
                if($tableData['servico'] == "Comodidade"){
                    echo '<h1>Atualizar Comodidade</h1>';
                }elseif($tableData['servico'] == "Atlética"){
                    echo '<h1>Atualizar Atlética</h1>';
                }
            ?>
        </div>
        <div class="form-container">
            <form action="#" method="post" enctype="multipart/form-data">       
                <div class="radio-container">
                    <?php
                        if($tableData['servico'] == "Atlética"){
                            echo   '<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Atlética"  checked >
                                        <label class="form-check-label" for="inlineRadio1">Atlética</label>
                                    </div>';
                        }elseif($tableData['servico'] == "Comodidade"){
                            echo   '<div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Comodidade" checked >
                                       <label class="form-check-label" for="inlineRadio2">Comodidade</label>
                                    </div>';
                        } 
                    ?>
                </div>
                <div class="column">
                    <div class="input-box">
                        <input type="text" id="titulo" name="titulo" maxlength="30" value="<?php echo $tableData['titulo']?>" required>
                        <label for="titulo" class="placeholder1" required>Título</label>
                    </div>
                    <div class="input-box">
                        <input type="text" id="responsavel" name="responsavel" maxlength="60" value="<?php echo $tableData['responsavel']?>" required>
                        <label for="responsavel" class="placeholder1" required>Responsável</label>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <input type="text" id="email" name="email" maxlength="50" value="<?php echo $tableData['email']?>" required>
                        <label for="email" class="placeholder1" required>E-mail</label>
                    </div>
                    <div class="input-box">
                        <input type="text" maxlength="15" id="telefone" name="telefone" value="<?php echo $tableData['telefone']?>" required>
                        <label for="telefone" class="placeholder1" required>Telefone</label>
                    </div>
                </div>

                <div class="input-box">
                    <input type="text" id="descricao_inicial" name="descricao_inicial" maxlength="70" value="<?php echo $tableData['descricao_inicial']?>" maxlength="60" required>
                    <label for="descricao_inicial" class="placeholder1" required>Descrição Inicial</label>
                </div>

                <div class="input-box">
                    <label for="imagem" class="custom-file-upload">
                        Escolher arquivo
                    </label>
                    <input type="file" id="imagem" name="arquivo" class="file-btn" onchange="previewImage(event)" >
                </div>
                <img id="preview" src="#" alt="Preview da imagem" style="max-width: 100%; display: none;">

                <div class="input-box">
                    <label for="descricao_completa">Descrição Completa</label>
                    <textarea id="descricao_completa" name="descricao_completa" ><?php echo $tableData['descricao_completa']?></textarea>
                </div>

                <div class="row">
                    <div class="input-box">
                        <input type="submit" value="Atualizar <?php if($tableData['servico'] == "Atlética"){echo "Atlética";}elseif($tableData['servico'] == "Comodidade"){echo "Comodidade";}?>" name="atualizar" class="submit-btn">
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>
</html>