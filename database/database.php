<?php
$servername = "localhost:3500";
$username = "root";
$password = "";
$dbname = "comunidade_anima";

$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE DATABASE comunidade_anima";
if ($conn->query($sql) === TRUE) {
    $conn->select_db($dbname);

    $queries = [
        "CREATE TABLE usuario (
            id INT(9) AUTO_INCREMENT PRIMARY KEY,
            email VARCHAR(50),
            senha VARCHAR(100),
            nome VARCHAR(70),
            nivel VARCHAR(3),
            imagem VARCHAR(400)
        )",
        "CREATE TABLE eventos (
            id INT(9) AUTO_INCREMENT PRIMARY KEY,
            titulo VARCHAR(50),
            data_inicial DATE,
            horario_inicial TIME,
            data_final DATE,
            horario_final TIME,
            endereco VARCHAR(100),
            descricao_inicial VARCHAR(70),
            descricao_completa TEXT,
            arquivo VARCHAR(400),
            situacao VARCHAR(10),
            justificativa TEXT,
            restrito BOOLEAN,
            autor INT(9),
            curtidas INT(9),
            FOREIGN KEY (autor) REFERENCES usuario(id)
        )",
        "CREATE TABLE servicos_universitarios (
            id INT(6) AUTO_INCREMENT PRIMARY KEY,
            servico VARCHAR(30),
            titulo VARCHAR(30),
            responsavel VARCHAR(60),
            descricao_inicial VARCHAR(50),
            descricao_completa TEXT,
            telefone VARCHAR(15),
            email VARCHAR(50),
            curtidas INT(9),
            arquivo VARCHAR(400)
        )",
        
    ];

    foreach ($queries as $query) {echo $query;
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
