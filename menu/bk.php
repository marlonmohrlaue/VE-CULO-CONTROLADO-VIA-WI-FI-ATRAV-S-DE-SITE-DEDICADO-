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
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const socket = new WebSocket('ws://172.16.1.75/ws');  // Endereço do WebSocket da ESP32

socket.onopen = () => {
    console.log("Conexão com a ESP32 estabelecida!");
};

socket.onmessage = (event) => {
    console.log("Mensagem recebida da ESP32: ", event.data);
};

socket.onerror = (error) => {
    console.log("Erro na conexão WebSocket: ", error);
};

socket.onclose = () => {
    console.log("Conexão WebSocket fechada!");
};

// Função para enviar comandos
function sendCommand(command) {
    if (socket.readyState === WebSocket.OPEN) {
        console.log("Enviando comando: ", command);
        socket.send(JSON.stringify(command));
    } else {
        console.log("WebSocket não está aberto.");
    }
}

// Evento de pressionar (inicia o movimento)
document.getElementById("up").addEventListener("mousedown", () => {
    sendCommand({ action: "move", direction: "forward" });
    socket.send("comando simples");
});

document.getElementById("down").addEventListener("mousedown", () => {
    sendCommand({ action: "move", direction: "backward" });
});

document.getElementById("left").addEventListener("mousedown", () => {
    sendCommand({ action: "move", direction: "left" });
});

document.getElementById("right").addEventListener("mousedown", () => {
    sendCommand({ action: "move", direction: "right" });
});

// Evento de soltar (stop) - envia o comando de parar quando o botão for solto
document.getElementById("up").addEventListener("mouseup", () => {
    sendCommand({ action: "stop" });
});

document.getElementById("down").addEventListener("mouseup", () => {
    sendCommand({ action: "stop" });
});

document.getElementById("left").addEventListener("mouseup", () => {
    sendCommand({ action: "stop" });
});

document.getElementById("right").addEventListener("mouseup", () => {
    sendCommand({ action: "stop" });
});
    </script>
</body>

</html>