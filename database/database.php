<?php
$servername = "localhost:3500";
$username = "root";
$password = "";
$dbname = "comunidade_anima";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE comunidade_anima";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);

    $queries = [
        "CREATE TABLE usuario (
            id INT(9) AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(30),
            senha VARCHAR(100),
            nome VARCHAR(70),
            email VARCHAR(50),
            nivel VARCHAR(3)
        )",
        "CREATE TABLE eventos (
            id INT(9) AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(50),
            data_inicial DATE,
            horario_inicial TIME,
            data_final DATE,
            horario_final TIME,
            endereco VARCHAR(100),
            descricao_inicial VARCHAR(50),
            descricao_completa TEXT,
            arquivo VARCHAR(400),
            situacao_post VARCHAR(10),
            justificativa TEXT,
            autor INT,
            curtidas INT(9),
            FOREIGN KEY (autor) REFERENCES usuario(id)
        )",
        "CREATE TABLE servicos_universitarios (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            servico VARCHAR(30),
            titulo VARCHAR(30),
            descricao_inicial VARCHAR(50),
            descricao_completa TEXT,
            telefone VARCHAR(15),
            email VARCHAR(50),
            arquivo VARCHAR(400)
        )",
        "INSERT INTO usuario(usuario, senha, nome, nivel) VALUES ('adm', '202cb962ac59075b964b07152d234b70', 'Administrador', 'ADM');",
        
        "INSERT INTO eventos(titulo, data_inicial, horario_inicial, data_final, horario_final, endereco, descricao_inicial, descricao_completa, arquivo, situacao_post, autor) VALUES ('Hackathon Unicuritiba', '2024-06-27', '18:00', '2024-06-27','23:00', 'R. Chile, 1678 - Rebouças, Curitiba - PR, 80220-181','Evento top para programadores', '<div class=\'container\' style=\'text-align: justify;\'>
        <h1 style=\'text-align: justify;\'>Hackathon Unicuritiba</h1>
        <img class=\'event-image\' src=\'../imgs/posts/665e6a717c6f5.jpg\' alt=\'Hackathon Unicuritiba\' width=\'654\' height=\'342\'>
        <p style=\'text-align: justify;\'><span class=\'highlight\'>O Hackathon Unicuritiba</span> &eacute; um evento incr&iacute;vel que re&uacute;ne estudantes, profissionais e entusiastas da tecnologia para uma maratona de inova&ccedil;&atilde;o e desenvolvimento. Durante <strong>05 horas intensas</strong>, os participantes trabalham em equipes para criar solu&ccedil;&otilde;es inovadoras para desafios reais, utilizando as mais recentes tecnologias e metodologias &aacute;geis.</p>
        <p style=\'text-align: justify;\'>Este evento &eacute; uma <em>excelente oportunidade</em> para aprender, colaborar e se conectar com outros talentos da &aacute;rea. Al&eacute;m disso, os participantes ter&atilde;o acesso a <strong>mentorias especializadas</strong>, workshops e muito mais. &Eacute; uma chance &uacute;nica de colocar suas habilidades em pr&aacute;tica e mostrar sua criatividade e inova&ccedil;&atilde;o.</p>
        <p style=\'text-align: justify;\'>No Hackathon Unicuritiba, voc&ecirc; pode esperar:</p>
        <ul style=\'text-align: justify;\'>
        <li>Desafios empolgantes e relevantes para o mercado.</li>
        <li>Pr&ecirc;mios incr&iacute;veis para as melhores solu&ccedil;&otilde;es.</li>
        <li>Networking com profissionais renomados da ind&uacute;stria.</li>
        <li>Ambiente colaborativo e inspirador.</li>
        </ul>
        <p style=\'text-align: justify;\'> &nbsp; </p>
        <p style=\'text-align: justify;\'><span class=\'highlight\'>Data:</span> 27 de junho de 2024<br><span class=\'highlight\'>Local:</span> Centro Universit&aacute;rio Curitiba - Unicuritiba</p>
        <p style=\'text-align: justify;\'>N&atilde;o perca essa oportunidade de fazer parte de algo grandioso e impulsionar sua carreira. Inscreva-se agora e prepare-se para viver uma experi&ecirc;ncia inesquec&iacute;vel no Hackathon Unicuritiba!</p>
        <p style=\'text-align: center;\'><img src=\'../imgs/posts/665e6a9e0f393.png\' alt=\'\' width=\'278\' height=\'210\'></p>
        </div>', '../imgs/posts/hackathon-o-que-e-vantagens-desafios-como-promover-1280x720.jpg', 'ativo', '1')"

    ];

    foreach ($queries as $query) {
        if ($conn->query($query) !== TRUE) {
            die("Error creating table: " . $conn->error);
        }
    }
    header("Location: create_db.php?status=success");
} else {
    die("Error creating database: " . $conn->error);
}

$conn->close();
?>
