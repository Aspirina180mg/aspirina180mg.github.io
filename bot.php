<?php
// bot.php
// Basic Telegram bot with webhook-style update handling

// Replace with your bot token
$token = '8306368438:AAGa3VcCEJAiD8ic9ZVku0MigzlfZ2di9GU';
$website = 'https://api.telegram.org/bot' . $token;

$input = file_get_contents('php://input');
$data = json_decode($input, true);

$chat_id = $update['message']['chat']['id'];
$message = $update['message']['text'] ;

switch($message) {
    case '/start':
        $response = 'Iniciando Bot, un momento...';
        sendMessage($chat_id, $response);
        break;
    case 'como me ira en la prueba?':
        $response = 'te irá bien, pero no te confíes';
        sendMessage($chat_id, $response);
        break;
    default:
        $response = 'I got your message: ' . ($text === '' ? '[empty]' : $text);
}

https://api.telegram.org/setWebHooks?url=https://aspirina180mg.github.io/bot.php