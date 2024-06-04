<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Abrir Endereço no Google Maps</title>
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
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .map-btn {
            margin-top: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }
        .map-btn:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function openInGoogleMaps() {
            const address = document.getElementById('address-input').value;
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
        <h2>Abrir Endereço no Google Maps</h2>
        <div class="form-group">
            <label for="endereco">Endereço:</label>
            <input id="address-input" type="text" placeholder="Digite o endereço" required/>
            <button type="button" class="map-btn" onclick="openInGoogleMaps()">Abrir no Google Maps</button>
        </div>
    </div>
</body>
</html>
