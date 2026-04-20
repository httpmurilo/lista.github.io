<?php
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$csvFile = __DIR__ . '/items.csv';
$jsonFile = __DIR__ . '/items_data.json';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (file_exists($jsonFile)) {
        header('Content-Type: application/json; charset=utf-8');
        readfile($jsonFile);
    } elseif (file_exists($csvFile)) {
        header('Content-Type: text/csv; charset=utf-8');
        readfile($csvFile);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'Arquivo não encontrado']);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if (!$data || !isset($data['items'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Dados inválidos']);
        exit;
    }

    // Save full JSON (with images)
    $jsonData = json_encode($data['items'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    file_put_contents($jsonFile, $jsonData, LOCK_EX);

    // Save CSV (without images, for export compatibility)
    $csv = "Item,Emoji,Usuarios,Reservado\n";
    foreach ($data['items'] as $item) {
        $name = str_replace('"', '""', $item['name'] ?? '');
        $emoji = str_replace('"', '""', $item['emoji'] ?? '📦');
        $users = '';
        if (isset($item['users']) && is_array($item['users'])) {
            $users = implode(';', array_map(function($u) {
                return str_replace('"', '""', $u);
            }, $item['users']));
        }
        $reserved = !empty($item['users']) ? 'true' : 'false';
        $csv .= "\"$name\",\"$emoji\",\"$users\",$reserved\n";
    }
    file_put_contents($csvFile, $csv, LOCK_EX);

    echo json_encode(['ok' => true]);
    exit;
}

http_response_code(405);
echo json_encode(['error' => 'Método não permitido']);
