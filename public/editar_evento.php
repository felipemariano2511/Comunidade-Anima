<?php
    include "../app/includes/config.php";
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;

    $uri = $_SERVER['REQUEST_URI'];
    if ($uri == "/Comunidade-Anima/public/editar_evento.php" || $uri == "/Comunidade-Anima/public/editar_evento.php?id=") {
        header("Location: index.php?page=Home");
        exit;
    };

    $id_url = isset($_GET['id']) ? $_GET['id'] : '';

    $query = "SELECT * FROM eventos WHERE id = '$id_url'";
    $result = mysqli_query($con, $query);

    $tableData = mysqli_fetch_assoc($result);

    if(SessionUser::isLogged()){
        $user_info = SessionUser::getInfo();
        if($user_info['id'] != $tableData['autor']){
            header("Location: index.php");
        }
    } else {
        header("Location: index.php");
        exit();
    }



    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['atualizar'])){
        $titulo = mysqli_real_escape_string($con, $_POST['titulo']);
        $data_inicial = $_POST['data_inicial'];
        $data_final = $_POST['data_final'];
        $horario_inicial = $_POST['horario_inicial'];
        $horario_final = $_POST['horario_final'];
        $endereco = mysqli_real_escape_string($con, $_POST['endereco']);
        $descricao_inicial = mysqli_real_escape_string($con, $_POST['descricao_inicial']);
        $descricao_completa = mysqli_real_escape_string($con, $_POST['descricao_completa']);
        $arquivo = $_FILES['arquivo'];
        $restrito = $_POST['inlineRadioOptions'] == '1' ? TRUE : FALSE;

        if($arquivo['tmp_name'] == ''){
            $endereco_arquivo = $tableData['arquivo'];
            
        }elseif($arquivo['error'] === 0) {
            $endereco_arquivo = '../imgs/usuario/' . $arquivo['name'];
            move_uploaded_file($arquivo['tmp_name'], $endereco_arquivo);
        }

        $query = "UPDATE eventos 
                    SET titulo = '$titulo',
                        data_inicial = '$data_inicial',
                        data_final = '$data_final',
                        horario_inicial = '$data_final',
                        horario_final = '$horario_final',
                        endereco = '$endereco',
                        descricao_inicial = '$descricao_inicial',
                        descricao_completa = '$descricao_completa',
                        arquivo = '$endereco_arquivo',
                        situacao = 'pendente',
                        justificativa = 'Seu evento foi editado e precisa de aprovação do administrador. Por favor, aguarde!',
                        restrito = '$restrito'"
                        . "WHERE id = '$id_url'";

        $result = mysqli_query($con, $query);

        if($result){
            echo '<script>alert("Atualizado com sucesso!");window.location.href="editar_evento.php?id='.$id_url.'#";</script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/formularios.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <title>Comunidade Ânima - Editar Evento</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.tiny.cloud/1/1urspdm91tdq0tsrsyoyoqy2axv2xbtaajwhi7k8usek8jcd/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
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
    <?php include "../src/components/menu.php"; ?>

    <section class="home">
        <div class="text">
            <h1>Editar Evento</h1>
        </div>
        <div class="form-container">
            <form action="#" method="post" enctype="multipart/form-data">
                <div class="input-box">
                    <input type="text" id="titulo" name="titulo" value="<?php echo $tableData['titulo']; ?>" required>

                    <label for="titulo" class="placeholder1" required>Título</label>
                </div>

                <div class="input-box">
                    <input type="text" id="descricao_inicial" name="descricao_inicial" maxlength="70" value="<?php echo $tableData['descricao_inicial']; ?>" required>
                    <label for="descricao_inicial" class="placeholder1" required>Descrição Inicial</label>
                </div>

                <div class="column">
                    <div class="input-box">
                        <input type="text" id="endereco" name="endereco" maxlength="100" value="<?php echo $tableData['endereco']; ?>"required>
                        <label for="endereco" class="placeholder1">Endereço</label>
                    </div>
                    <button type="button" class="map-btn" onclick="openInGoogleMaps()">Verificar endereço</button>
                </div>
                
                <div class="radio-container">
                    <div class="form-check form-check-inline">
                        <h2>Evento:</h2>
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="1" <?php if($tableData['restrito'] == TRUE) echo "checked"; ?>>

                        <label class="form-check-label" for="inlineRadio1">Restrito</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="0"<?php if($tableData['restrito'] == FALSE) echo "checked"; ?>>
                        <label class="form-check-label" for="inlineRadio2">Aberto ao Público</label>
                    </div>
                </div>

                <div class="input-box">
                    <label for="imagem" class="custom-file-upload">
                        Escolher imagem
                    </label>
                    <input type="file" id="imagem" name="arquivo" class="file-btn" onchange="previewImage(event)" >
                </div>
                <img id="preview" src="#" alt="Preview da imagem" style="max-width: 100%; display: none;">

                <div class="column">
                    <div class="input-box">
                        <label for="data_inicial" >Data Inicial</label>
                        <input type="date" id="data_inicial" name="data_inicial" value="<?php echo $tableData['data_inicial']; ?>"required>
                        <label for="horario_inicial">Horário Inicial</label>
                        <input type="time" id="horario_inicial" name="horario_inicial" value="<?php echo $tableData['horario_inicial']; ?>" required>
                    </div>
                    <div class="input-box">
                        <label for="data_final">Data Final</label>
                        <input type="date" id="data_final" name="data_final" value="<?php echo $tableData['data_final']; ?>" required>
                        <label for="horario_final">Horário Final</label>
                        <input type="time" id="horario_final" name="horario_final" value="<?php echo $tableData['horario_final']; ?>" required>
                    </div>
                </div>

                <div class="input-box">
                    <label for="descricao_completa">Descrição</label>
                    <textarea id="descricao_completa" name="descricao_completa"><?php echo $tableData['descricao_completa'];?>"</textarea>
                </div>
                
                <div class="row">
                    <div class="input-box">
                        <input type="submit" value="Atualizar Evento" name="atualizar" class="submit-btn">
                    </div>
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
            mergetags_list: [{
                    value: 'First.Name',
                    title: 'First Name'
                },
                {
                    value: 'Email',
                    title: 'Email'
                },
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
        function previewImage(event) {
        var input = event.target;

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
            document.getElementById('preview').src = e.target.result;
            document.getElementById('preview').style.display = 'block';
            };

            reader.readAsDataURL(input.files[0]);
        }
        }
    </script>
</body>

</html>