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
            ra INT(9) UNIQUE KEY,
            email VARCHAR(50),
            nome VARCHAR(70),
            imagem_perfil VARCHAR(100)
        )",
        "CREATE TABLE administrador (
            id INT(9) AUTO_INCREMENT PRIMARY KEY,
            usuario VARCHAR(30),
            senha VARCHAR(100),
            nome VARCHAR(70),
            email VARCHAR(50),
            nivel VARCHAR(4)
        )",
        "CREATE TABLE eventos (
            id INT(9) AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(50),
            data_evento DATE,
            horario TIME,
            endereco VARCHAR(100),
            descricao TEXT,
            arquivo VARCHAR(400),
            situacao_post VARCHAR(10),
            justificativa TEXT,
            autor INT,
            FOREIGN KEY (autor) REFERENCES usuario(ra)
        )",
        "CREATE TABLE curtidas (
            curtido BOOLEAN,
            id_posts INT(9),
            id_usuario INT(9),
            FOREIGN KEY (id_posts) REFERENCES eventos(id),
            FOREIGN KEY (id_usuario) REFERENCES usuario(id)
        )",
        "CREATE TABLE servicos_universitarios (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            servico VARCHAR(30),
            descricao TEXT,
            telefone VARCHAR(100),
            email VARCHAR(50)
        )",
        "INSERT INTO administrador(usuario, senha, nome, nivel) VALUES ('root', '202cb962ac59075b964b07152d234b70', 'Root', 'ROOT');"

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
