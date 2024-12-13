<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Controle do Carrinho</title>

    <?php
    //include("../outros/navbarnova.php");
    ?>
    <style>
        #controls {
            text-align: center;
            margin-top: 50px;
        }

        button {
            width: 100px;
            height: 100px;
            font-size: 18px;
            background-color: #D9D9D9;
            /* Fundo branco para todos os botões */
            border: 1px solid black;
            /* Adiciona uma borda com a cor azul */
            border-radius: 8px;
            /* Borda arredondada */
            margin: 10px;
            /* Espaçamento entre os botões */
            transition: background-color 0.3s ease;
            /* Transição suave na mudança de cor de fundo */
        }

        .active {
            background-color: lightgreen;
        }

        #up {
            display: block;
            margin: 0 auto;
        }

        #down {
            display: block;
            margin: 0px auto 0;
            /* Adiciona uma margem superior para separar do botão acima */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6" id="controls">
                <button id="up">Cima</button>
                <button id="left">Esquerda</button>
                <button id="action">Ação</button>
                <button id="right">Direita</button>
                <button id="down">Baixo</button>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <p class="text-center">Pagina apenas ilustrativa.</p>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.9/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const keysMap = {
            'w': 'up',
            'a': 'left',
            'd': 'right',
            's': 'down'
        };

        // Objeto para rastrear o estado das teclas pressionadas
        const keysPressed = {};

        // Função para enviar comando e alternar estado do botão
        function sendCommandAndToggleState(buttonId, isPressed) {
            const button = document.getElementById(buttonId);
            if (button) {
                if (isPressed) {
                    button.classList.add('active');
                    console.log(`Comando Enviado: ${buttonId.toUpperCase()}`);
                } else {
                    button.classList.remove('active');
                    console.log(`Comando Enviado: Parar ${buttonId.toUpperCase()}`);
                }
            }
        }

        // Eventos de teclado
        document.addEventListener('keydown', (event) => {
            const key = event.key.toLowerCase();
            if (keysMap[key] && !keysPressed[key]) {
                keysPressed[key] = true;
                sendCommandAndToggleState(keysMap[key], true);
            }
        });

        document.addEventListener('keyup', (event) => {
            const key = event.key.toLowerCase();
            if (keysMap[key]) {
                keysPressed[key] = false;
                sendCommandAndToggleState(keysMap[key], false);
            }
        });

        // Eventos de clique
        document.querySelectorAll("button").forEach(button => {
            button.addEventListener("mousedown", () => {
                sendCommandAndToggleState(button.id, true);
            });
            button.addEventListener("mouseup", () => {
                sendCommandAndToggleState(button.id, false);
            });
            button.addEventListener("mouseleave", () => {
                sendCommandAndToggleState(button.id, false);  // Para desfazer o "active" ao sair do botão
            });
        });
    </script>
</body>

</html>