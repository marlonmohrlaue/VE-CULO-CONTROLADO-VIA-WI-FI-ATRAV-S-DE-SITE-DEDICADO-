<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Controle do Carrinho</title>

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
            border: 1px solid black;
            border-radius: 8px;
            margin: 10px;
            transition: background-color 0.3s ease;
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
        const socketUrl = "ws://172.16.0.34/ws";
        let socket = new WebSocket(socketUrl);

        socket.onopen = () => {
            console.log("Conexão WebSocket estabelecida.");
        };

        socket.onclose = () => {
            console.log("Conexão WebSocket fechada. Tentando reconectar...");
            setTimeout(connectWebSocket, 5000);
        };

        socket.onerror = (error) => {
            console.error("Erro no WebSocket:", error);
        };

        function connectWebSocket() {
            socket = new WebSocket(socketUrl);
        }

        function sendCommand(command) {
            if (socket.readyState === WebSocket.OPEN) {
                socket.send(command);
                console.log("Comando enviado:", command);
            } else {
                console.log("WebSocket não está aberto. Tentando reconectar...");
                setTimeout(connectWebSocket, 5000); // Reabre o WebSocket se não estiver conectado
            }
        }

        // Mapeamento de teclas para IDs dos botões
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

                    // Cria o comando JSON
                    let action = "move";
                    let direction;

                    switch (buttonId) {
                        case "up":
                            direction = "forward";
                            break;
                        case "down":
                            direction = "backward";
                            break;
                        case "left":
                            direction = "left";
                            break;
                        case "right":
                            direction = "right";
                            break;
                        case "action":
                            action = "stop";
                            break;
                        default:
                            console.error("Botão inválido");
                            return;
                    }

                    const command = JSON.stringify({
                        action,
                        direction
                    });

                    // Use sendCommand() para enviar o comando com a verificação de WebSocket
                    sendCommand(command);
                } else {
                    button.classList.remove('active');
                    // Envia um comando de parada (opcional)
                    if (socket.readyState === WebSocket.OPEN) {
                        sendCommand(JSON.stringify({
                            action: "stop"
                        }));
                    }
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
                sendCommandAndToggleState(button.id, false); // Para desfazer o "active" ao sair do botão
            });
        });
    </script>
</body>

</html>