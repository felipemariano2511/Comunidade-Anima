<?php
    include "../app/includes/config.php";
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
    }else{
        header("Location: index.php");
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cadastrar'])){
        $titulo = $_POST['titulo'];
        $data_final = $_POST['data_inicial'];
        $data_inicial = $_POST['data_final'];
        $horario_inicial = $_POST['horario_inicial'];
        $horario_final = $_POST['horario_final'];
        $endereco = $_POST['endereco'];
        $descricao_inicial = $_POST['descricao_inicial'];
        $descricao_completa = $_POST['descricao_completa'];
        $arquivo = $_FILES['arquivo'];
        $restrito = isset($_POST['switch_status']) ? 'restrito' : 'aberto'; // Verifica o estado do switch
        $autor = 1;

        if($arquivo['error'] === 0) {
            move_uploaded_file($arquivo['tmp_name'], '../imgs/posts/' . $arquivo['name']);
            $endereco_arquivo = '../imgs/posts/' . $arquivo['name'];

            $query = "INSERT INTO eventos(titulo, data_inicial, horario_inicial, data_final, horario_final, endereco, descricao_inicial, descricao_completa, arquivo, situacao, restrito, autor)
                    VALUES ('$titulo', '$data_inicial', '$horario_inicial', '$data_final','$horario_final', '$endereco','$descricao_inicial', '$descricao_completa', '$endereco_arquivo', 'ativo', '$restrito', '$autor')";
            $result = mysqli_query($con, $query);

            if($result){
                echo '<script>alert("Cadastrado com sucesso, aguarde aprovação!")</script>';
            } else{
                echo '<script>alert("Falha no cadastro!")</script>';
            }
        } else {
            echo '<script>alert("Erro ao fazer upload do arquivo. Por favor, tente novamente!")</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/novo_evento.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Novo Evento</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tiny.cloud/1/dkcuc3lf8zdkfx6zb8p2vuryz2mntql0gvb3f8vtjbqo45zp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        function openInGoogleMaps() {
            const address = document.getElementById('endereco').value;
            if (address) {
                const url = `https://www.google.com/maps/search/?api=1&query=${encodeURIComponent(address)}`;
                window.open(url, '_blank');
            } else {
                alert("Por favor, insira um endereço válido.");
            }
        }
    </script>
</head>
<body>
    <?php include "../src/components/main_header.php"; ?>
    <?php include "../src/components/menu_formatted.php"; ?>

    <section class="home">
        <div class="text">
            <h1>Novo Evento</h1>
        </div>
        <div class="container">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="titulo">Título</label>
                    <input type="text" id="titulo" name="titulo" required>
                </div>
                <div class="column">
                    <div class="form-group">
                        <label for="data_inicial">Data Inicial</label>
                        <input type="date" id="data_inicial" name="data_inicial" required>
                    </div>
                    <div class="form-group">
                        <label for="horario_inicial">Horário Inicial</label>
                        <input type="time" id="horario_inicial" name="horario_inicial" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="data_final">Data Final</label>
                    <input type="date" id="data_final" name="data_final" required>
                </div>
                <div class="form-group">
                    <label for="horario_final">Horário Final</label>
                    <input type="time" id="horario_final" name="horario_final" required>
                </div>
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" id="endereco" name="endereco" required>
                    <button type="button" class="map-btn" onclick="openInGoogleMaps()">Verificar endereço</button>
                </div>
                <div class="switch-container">
                    <span class="label-text">Restrito</span>
                    <label class="switch">
                        <input type="checkbox" name="switch_status">
                        <span class="slider round"></span>
                    </label>
                    <span class="label-text">Aberto ao Público</span>
                </div>
                <div class="form-group">
                    <label for="descricao_inicial">Descrição Inicial:</label>
                    <input type="text" id="descricao_inicial" name="descricao_inicial" maxlength="30">
                </div>
                <div class="form-group">
                    <label for="descricao_completa">Descrição:</label>
                    <textarea id="descricao_completa" name="descricao_completa"></textarea>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem</label>
                    <input type="file" id="imagem" name="arquivo">
                </div>
                <div class="form-group">
                    <input type="submit" value="Cadastrar Evento" name="cadastrar">
                </div>
            </form>
        </div>
    </section>
    
    <script>
        tinymce.init({
            selector: 'textarea',
            language: 'pt_BR',
            plugins: 'code anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate ai mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
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
                            remove: true });
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
</body>
</html>
