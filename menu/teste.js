// const socket = new WebSocket('ws://ENDEREÇO_DA_ESP32');  // Comentar esta linha
console.log("Simulando WebSocket: Conexão com a ESP32 estabelecida");

// Substituir socket.send por console.log na função sendMovementCommand
function sendMovementCommand() {
    if (keysPressed['w'] && keysPressed['a']) {
        console.log("Comando Simulado: Frente e Esquerda");
    } else if (keysPressed['w'] && keysPressed['d']) {
        console.log("Comando Simulado: Frente e Direita");
    } else if (keysPressed['s'] && keysPressed['a']) {
        console.log("Comando Simulado: Trás e Esquerda");
    } else if (keysPressed['s'] && keysPressed['d']) {
        console.log("Comando Simulado: Trás e Direita");
    } else if (keysPressed['w']) {
        console.log("Comando Simulado: Frente");
    } else if (keysPressed['s']) {
        console.log("Comando Simulado: Trás");
    } else if (keysPressed['a']) {
        console.log("Comando Simulado: Esquerda");
    } else if (keysPressed['d']) {
        console.log("Comando Simulado: Direita");
    } else {
        console.log("Comando Simulado: Parar");
    }
}
