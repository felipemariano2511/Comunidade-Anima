<?php
    include "../app/includes/config.php";
    include '../app/Session/User.php';

    use App\Session\User as SessionUser;

    $user_info = SessionUser::getInfo();
    $servico = isset($_GET['servico']) ? $_GET['servico'] : '';

    if ($user_info['nivel'] != "ADM") {
        header("Location: index.php");
        exit();
    } 

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])) {
        $servico = $_POST['inlineRadioOptions'];
        $titulo = $_POST['titulo'];
        $responsavel = $_POST['responsavel'];
        $descricao_inicial = $_POST['descricao_inicial'];
        $descricao_completa = $_POST['descricao_completa'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $arquivo = $_FILES['arquivo'];

        if ($arquivo['error'] === 0) {
            $endereco_arquivo = '../imgs/posts/' . $arquivo['name'];
            move_uploaded_file($arquivo['tmp_name'], $endereco_arquivo);

            $query = "INSERT INTO servicos_universitarios (servico, titulo, responsavel, descricao_inicial, descricao_completa, telefone, email, arquivo)
                    VALUES ('$servico', '$titulo', '$responsavel', '$descricao_inicial', '$descricao_completa', '$telefone', '$email', '$endereco_arquivo')";
            $result = mysqli_query($con, $query);

            if ($result) {
                echo '<script>alert("Cadastrado com sucesso!");window.location.reload();</script>';
            } else {
                echo '<script>alert("Falha no cadastro!")</script>';
            }
        } else {
            echo '<script>alert("Erro ao fazer upload do arquivo. Por favor, tente novamente!");window.location("novo_servico.php")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/novo_servico.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://cdn.tiny.cloud/1/1urspdm91tdq0tsrsyoyoqy2axv2xbtaajwhi7k8usek8jcd/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Novo Serviço</title>
</head>

<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu.php"; ?>

    <section class="home">
        <div class="text">
            <?php
                if($servico == "Comodidade"){
                    echo '<h1>Nova Comodidade</h1>';
                }elseif($servico == "Atlética"){
                    echo '<h1>Nova Atlética</h1>';
                }else{
                    echo '<h1>Novo Serviço</h1>';
                }

            ?>
        </div>
        <div class="form-container">
            <form action="#" method="post" enctype="multipart/form-data">       
                <div class="radio-container">
                    <?php
                        if($servico == "Atlética"){
                            echo   '<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Atlética"  checked >
                                        <label class="form-check-label" for="inlineRadio1">Atlética</label>
                                    </div>';
                        }elseif($servico == "Comodidade"){
                            echo   '<div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Comodidade" checked >
                                       <label class="form-check-label" for="inlineRadio2">Comodidade</label>
                                    </div>';
                        }else{
                            echo   '<div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="Atlética"  checked >
                                        <label class="form-check-label" for="inlineRadio1">Atlética</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="Comodidade"  >
                                       <label class="form-check-label" for="inlineRadio2">Comodidade</label>
                                    </div>';
                        }
                            
                    ?>
                </div>

                <div class="column">
                    <div class="input-box">
                        <input type="text" id="titulo" name="titulo" required>
                        <label for="titulo" class="placeholder1" required>Título</label>
                    </div>
                    <div class="input-box">
                        <input type="text" id="responsavel" name="responsavel" required>
                        <label for="responsavel" class="placeholder1" required>Responsável</label>
                    </div>
                </div>

                <div class="column">
                    <div class="input-box">
                        <input type="text" id="email" name="email" required>
                        <label for="email" class="placeholder1" required>E-mail</label>
                    </div>
                    <div class="input-box">
                        <input type="text" maxlength="15" id="telefone" name="telefone" required>
                        <label for="telefone" class="placeholder1" required>Telefone</label>
                    </div>
                </div>

                <div class="input-box">
                    <input type="text" id="descricao_inicial" name="descricao_inicial" maxlength="60" required>
                    <label for="descricao_inicial" class="placeholder1" required>Descrição Inicial</label>
                </div>

                <div class="input-box">
                    <label for="imagem" class="custom-file-upload">
                        Escolher arquivo
                    </label>
                    <input type="file" id="imagem" name="arquivo" class="file-btn">
                </div>

                <div class="input-box">
                    <label for="descricao_completa">Descrição Completa</label>
                    <textarea id="descricao_completa" name="descricao_completa"></textarea>
                </div>

                <div class="row">
                    <div class="input-box">
                        <input type="submit" value="Cadastrar <?php if($servico == "Atlética"){echo "Atlética";}elseif($servico == "Comodidade"){echo "Comodidade";}else{echo "Serviço";} ?>" name="cadastrar" class="submit-btn">
                    </div>
                </div>
            </form>
        </div>
    </section>

    <script>
        tinymce.init({
            selector: 'textarea',
            api_key: '1urspdm91tdq0tsrsyoyoqy2axv2xbtaajwhi7k8usek8jcd',
            language: 'pt_BR',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: '1urspdm91tdq0tsrsyoyoqy2axv2xbtaajwhi7k8usek8jcd',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
                ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
            images_upload_handler: (blobInfo, progress) => new Promise((resolve, reject) => {
                const xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'upload_imgs.php');

                xhr.upload.onprogress = (e) => {
                    progress(e.loaded / e.total * 100);
                };

                xhr.onload = () => {
                    if (xhr.status === 403) {
                        reject({
                            message: 'HTTP Error: ' + xhr.status + "Aqui",
                            remove: true
                        });
                        return;
                    }

                    if (xhr.status < 200 || xhr.status >= 300) {
                        console.log(xhr);
                        reject('HTTP Error: ' + xhr.statusText);
                        return;
                    }

                    const json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        reject('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    resolve(json.location);
                };

                xhr.onerror = () => {
                    reject('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
                };

                const formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            }),
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
    const telefoneInput = document.getElementById('telefone');

    telefoneInput.addEventListener('input', function (event) {
        let value = event.target.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos
        if (value.length > 11) value = value.slice(0, 11); // Limita o valor a 11 dígitos

        let formattedValue = '';

        if (value.length > 0) {
            formattedValue += `(${value.substring(0, 2)}`; // Código de área
        }
        if (value.length > 2) {
            formattedValue += `) ${value.substring(2, 7)}`; // Primeiros 5 dígitos
        }
        if (value.length > 7) {
            formattedValue += `-${value.substring(7, 11)}`; // Últimos 4 dígitos
        }

        event.target.value = formattedValue;
    });
});

    </script>
</body>

</html>