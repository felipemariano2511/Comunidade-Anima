<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../src/styles/style-pattern.css">
    <link rel="stylesheet" href="../src/styles/style.css">
    <link rel="stylesheet" href="../src/styles/gerenciar_usuarios.css">
    <title>Eventos</title>
</head>

<body>
    <section class="home">
        <div class="home-title">
            <h1>Gerenciar Comodidades</h1>
            <p>CRUD para comodidades</p>
        </div>
        <div class="container">
            <h1>Administração de Comodidades</h1>
            <button id="addUserBtn">Adicionar Comodidade<i class='bx bx-plus'></i></button>
            <table id="usersTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Comodidade</th>
                        <th>Outro</th>
                        <th>Outro</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Assistência Odontológica</td>
                        <td>Outro</td>
                        <td>Outro</td>
                        <td class="actions">
                            <button class="icon-button editBtn"><i class='bx bx-edit'></i></button>
                            <button class="icon-button deleteBtn"><i class='bx bx-trash'></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Consulta Veterinária</td>
                        <td>Outro</td>
                        <td>Outro</td>
                        <td class="actions">
                            <button class="icon-button editBtn"><i class='bx bx-edit'></i></button>
                            <button class="icon-button deleteBtn"><i class='bx bx-trash'></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</body>