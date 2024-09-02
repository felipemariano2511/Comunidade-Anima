<?php
    $data  = [
        "INSERT INTO servicos_universitarios (
            servico,
            titulo,
            responsavel,
            descricao_inicial,
            descricao_completa,
            telefone,
            email,
            curtidas,
            arquivo
          )
          VALUES (
            'Atletica',
            'Atletica Tubarao da UFCG',
            'Josias Matos',
            'Junte-se a Atletica Tubarao e viva a melhor experiencia universitaria!',
            '<p>A Atletica Tubareo da UFCG e uma entidade sem fins lucrativos que promove a integração social, a pratica esportiva e o desenvolvimento cultural dos estudantes da Universidade Federal de Campina Grande. Oferecemos diversas atividades para voce aproveitar ao maximo sua vida universitaria, como:</p><ul><li>Campeonatos esportivos em diversas modalidades;</li><li>Festas tematicas e eventos culturais;</li><li>Acoes sociais e voluntariado;</li><li>Viagens e excursoes;</li><li>Intercambios com outras atleticas;</li><li>Descontos em produtos e serviços.</li></ul><p>Venha fazer parte da nossa família e viver momentos inesqueciveis! SomosTubarao AtleticaTubarão UFCG</p><p><img src=”https://www.shutterstock.com/image-vector/cartoon-shark-logo-mascot-isolated-260nw-1324061330.jpg” alt=”Logo da Atletica Tubarao”></p><p>Acesse nossas redes sociais para saber mais:</p><ul><li><a href=”https://www.facebook.com/AtleticaTubaraoUFCG/”>Facebook</a></li><li><a href=”https://www.instagram.com/atleticatubarao/”>Instagram</a></li><li><a href=”https://twitter.com/AtleticaTubarao”>Twitter</a></li></ul>',
            '(83) 9999-9999',
            'atleticatubarao@ufcg.edu.br',
            100,
            'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRzyIse0UZcZR9LuQIpuID3GM7mH-CX0q3QPA&s'
          )",

          "INSERT INTO usuario(
            email,
            senha,
            nome,
            nivel,
            imagem
          )
          VALUES (
            'adm',
            '202cb962ac59075b964b07152d234b70',
            'Administrador',
            'ADM',
            '../imgs/usuario/user-1.webp'
          )",

          "INSERT INTO usuario(
            email,
            senha,
            nome,
            nivel,
            imagem
          )
          VALUES (
            'usr',
            '202cb962ac59075b964b07152d234b70',
            'Usuario',
            'USR',
            '../imgs/usuario/user-1.webp'
          )"



];

foreach ($data as $query) {
    if ($con->query($query) !== TRUE) {
        die("Error creating table: " . $con->error);
    }
}
header("Location: create_db.php?status=success");

$con->close();
?>