<?php
header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'POST') {
    // Recebe os dados enviados no corpo da requisição
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['acao'])) {
        $acao = $data['acao'];

        // URL do Arduino com IP definido
        $arduinoIp = "http://192.168.0.XX"; // Substitua pelo IP do Arduino/ESP32
        $url = "$arduinoIp/movimento?acao=" . urlencode($acao);

        // Envia o comando para o Arduino e retorna a resposta
        $response = file_get_contents($url);

        echo json_encode(["status" => "success", "message" => "Ação enviada", "arduino_response" => $response]);
    } else {
        echo json_encode(["status" => "error", "message" => "Ação não especificada"]);
    }
} else {
    http_response_code(405);
    echo json_encode(["status" => "error", "message" => "Método não permitido"]);
}
?>