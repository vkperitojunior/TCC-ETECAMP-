<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carregando...</title>
    <style>
        /* Estilo da tela de carregamento */
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden;
            font-family: Arial, sans-serif;
        }

        .loading-screen {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: #282c34;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }

        .loading-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .loading-content {
            text-align: center;
            color: white;
        }

        .loading-content img {
            width: 100px;
            height: 100px;
        }

        .loading-content h2 {
            font-size: 24px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <!-- Tela de carregamento -->
    <div class="loading-screen" id="loading-screen">
        <div class="loading-content">
            <img src="frontend/public/gif/loading/gif_normal.gif" alt="Carregando..."> <!-- Aqui você insere seu GIF -->
            <h2>Carregando, por favor aguarde...</h2>
        </div>
    </div>

    <script>
        // Esconde a tela de carregamento quando a página terminar de carregar
        window.onload = function() {
            const loadingScreen = document.getElementById("loading-screen");
            loadingScreen.classList.add("hidden");
        };
    </script>

</body>
</html>