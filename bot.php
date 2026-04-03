<?php
// bot.php
// Basic Telegram bot with webhook-style update handling

// Replace with your bot token
const BOT_TOKEN = '8306368438:AAGa3VcCEJAiD8ic9ZVku0MigzlfZ2di9GU';
const API_URL = 'https://api.telegram.org/bot' . BOT_TOKEN . '/';

function sendTelegram($method, $params = [])
{
    $url = API_URL . $method;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

// Read incoming webhook JSON
$input = file_get_contents('php://input');
if (!$input) {
    http_response_code(400);
    exit;
}

$data = json_decode($input, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    http_response_code(400);
    exit;
}

if (!isset($data['message'])) {
    http_response_code(200);
    exit;
}

$message = $data['message'];
$chat_id = $message['chat']['id'] ?? null;
$text = trim($message['text'] ?? '');

if (!$chat_id) {
    http_response_code(200);
    exit;
}

$response = 'I got your message: ' . ($text === '' ? '[empty]' : $text);

if (strcasecmp($text, '/start') === 0) {
    $response = 'Hello! I am your basic PHP Telegram bot. Send any text and I echo it.';
} elseif (strcasecmp($text, '/ping') === 0) {
    $response = 'Pong';
}

sendTelegram('sendMessage', [
    'chat_id' => $chat_id,
    'text' => $response,
    'parse_mode' => 'HTML',
]);

http_response_code(200);