<?php
$env = parse_ini_file('.env');

$token = $env['token'];
$website = $env['api_url'] . $token;

$input = file_get_contents('php://input');
$data = json_decode($input, TRUE);

$chat_id = $data['message']['chat']['id'];
$message = $data['message']['text'] ?? '';

switch ($message) {
    case '/start':
        sendMessage($chat_id, 'Iniciando Bot, un momento...');
        break;
    case 'prueba':
        sendMessage($chat_id, 'Prueba exitosa');
        break;
    default:
        sendMessage($chat_id, 'Comando no reconocido');
        break;
}

function sendMessage($chat_id, $response)
{
    $url = $GLOBALS['website'] . '/sendMessage?chat_id=' . $chat_id . '&parse_mode=HTML&text=' . urlencode($response);
    file_get_contents($url);
}
