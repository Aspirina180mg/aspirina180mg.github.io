<?php

$token = '8306368438:AAGa3VcCEJAiD8ic9ZVku0MigzlfZ2di9GU';
$website = 'https://api.telegram.org/bot' . $token;

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$chat_id = $update['message']['chat']['id'];
$message = $update['message']['text'];

switch ($message) {
    case '/start':
        $response = 'Iniciando Bot, un momento...';
        sendMessage($chat_id, $response);
        break;
    case 'prueba':
        $response = 'Prueba exitosa';
        sendMessage($chat_id, $response);
        break;
    case 'prueba':

        sendMessage($chat_id, $response);
        break;
    default:
        $response = 'error';
}

function sendMessage($chat_id, $response)
{
    $url = $GLOBALS['website'] . '/sendMessage?chat_id=' . $chat_id . '&parse_mode=HTML&text=' . urlencode($response);
    file_get_contents($url);
}
?>














