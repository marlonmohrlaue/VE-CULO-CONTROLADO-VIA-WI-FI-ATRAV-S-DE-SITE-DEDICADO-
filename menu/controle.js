// Estabelece conexão WebSocket com a ESP32
const socket = new WebSocket('ws://172.16.1.52');

socket.onopen = () => {
    console.log("Conexão com a ESP32 estabelecida");
};

// Objeto para rastrear o estado das teclas pressionadas
const keysPressed = {
    'w': false,
    'a': false,
    's': false,
    'd': false
};

// Função para enviar o comando atual baseado nas teclas pressionadas
function sendMovementCommand() {
    if (keysPressed['w'] && keysPressed['a']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'forward-left' }));
        console.log("Enviando comando: Frente e Esquerda");
    } else if (keysPressed['w'] && keysPressed['d']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'forward-right' }));
        console.log("Enviando comando: Frente e Direita");
    } else if (keysPressed['s'] && keysPressed['a']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'backward-left' }));
        console.log("Enviando comando: Trás e Esquerda");
    } else if (keysPressed['s'] && keysPressed['d']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'backward-right' }));
        console.log("Enviando comando: Trás e Direita");
    } else if (keysPressed['w']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'forward' }));
        console.log("Enviando comando: Frente");
    } else if (keysPressed['s']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'backward' }));
        console.log("Enviando comando: Trás");
    } else if (keysPressed['a']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'left' }));
        console.log("Enviando comando: Esquerda");
    } else if (keysPressed['d']) {
        socket.send(JSON.stringify({ action: 'move', direction: 'right' }));
        console.log("Enviando comando: Direita");
    } else {
        socket.send(JSON.stringify({ action: 'stop' }));
        console.log("Enviando comando: Parar");
    }
}

// Captura o evento de pressionar a tecla
document.addEventListener('keydown', (event) => {
    const key = event.key.toLowerCase();
    if (keysPressed.hasOwnProperty(key)) {
        if (!keysPressed[key]) {  // Só envia comando se a tecla não estava já pressionada
            keysPressed[key] = true;
            sendMovementCommand();
        }
    }
});

// Captura o evento de soltar a tecla
document.addEventListener('keyup', (event) => {
    const key = event.key.toLowerCase();
    if (keysPressed.hasOwnProperty(key)) {
        if (keysPressed[key]) {  // Só envia comando se a tecla estava pressionada
            keysPressed[key] = false;
            sendMovementCommand();
        }
    }
});

// Tratamento de erros
socket.onerror = (error) => {
    console.error("Erro na conexão WebSocket:", error);
};
