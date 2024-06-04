<?php
    include "../app/includes/config.php";
    include "../app/Session/User.php";
    include "../app/Session/Adm.php";
    use \App\Session\User as SessionUser;
    use \App\Session\Adm as SessionAdm;

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
        $autor = 1;

        if($arquivo['error'] === 0) {
            move_uploaded_file($arquivo['tmp_name'], '../imgs/posts/' . $arquivo['name']);
            $endereco_arquivo = '../imgs/posts/' . $arquivo['name'];

            $query = "INSERT INTO eventos(titulo, data_inicial, horario_inicial, data_final, horario_final, endereco, descricao_inicial, descricao_completa, arquivo, situacao_post, autor)
                    VALUES ('$titulo', '$data_inicial', '$horario_inicial', '$data_final','$horario_final', '$endereco','$descricao_inicial', '$descricao_completa', '$endereco_arquivo', 'ativo', '$autor')";
            echo $query;
            $result = mysqli_query($con, $query);

            if($result){
                echo "Cadastro realizado com sucesso!";
            } else{
                echo "Falha no cadastro!";
            }
        } else {
            echo "Erro ao fazer o upload do arquivo.";
        }
    }
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Novo Evento</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tiny.cloud/1/dkcuc3lf8zdkfx6zb8p2vuryz2mntql0gvb3f8vtjbqo45zp/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="date"],
        input[type="time"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="file"] {
            margin-top: 10px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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
    <div class="container">
        <h2>Cadastro de Novo Evento</h2>
        <form action="publicar.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="titulo">Título:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div class="form-group">
                <label for="data_inicial">Data Inicial:</label>
                <input type="date" id="data_inicial" name="data_inicial" required>
            </div>
            <div class="form-group">
                <label for="horario_inicial">Horário Inicial:</label>
                <input type="time" id="horario_inicial" name="horario_inicial" required>
            </div>
            <div class="form-group">
                <label for="data_final">Data Final:</label>
                <input type="date" id="data_final" name="data_final" required>
            </div>
            <div class="form-group">
                <label for="horario_final">Horário Final:</label>
                <input type="time" id="horario_final" name="horario_final" required>
            </div>
            
            <div class="form-group">
                <label for="endereco">Endereço:</label>
                <input type="text" id="endereco" name="endereco" required>
                <button type="button" class="map-btn" onclick="openInGoogleMaps()">Verificar endereço</button>
            </div>
            <div class="form-group">
                <label for="descricao_inicial">Descrição Inicial:</label>
                <input type="text" id="descricao_inicial" name="descricao_inicial" maxlength="30"></input>
            </div>
            <div class="form-group">
                <label for="descricao_completa">Descrição:</label>
                <textarea id="descricao_completa" name="descricao_completa" ></textarea>
            </div>


            <div class="form-group">
                <label for="imagem">Imagem:</label>
                <input type="file" id="imagem" name="arquivo">
            </div>
            <div class="form-group">
                <input type="submit" value="Cadastrar Evento" name="cadastrar">
            </div>
        </form>
    </div>
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
