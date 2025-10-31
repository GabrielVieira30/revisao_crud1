<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$year = date('Y');
$country = isset($_GET['country']) ? strtoupper($_GET['country']) : 'BR';
$url = "https://date.nager.at/api/v3/PublicHolidays/{$year}/{$country}";

$context = stream_context_create([
    'http' => [
        'timeout' => 10,
    ]
]);

$response = file_get_contents($url, false, $context);

if ($response === false) {
    echo json_encode(['error' => 'Erro ao buscar feriados']);
    exit;
}

$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    echo json_encode(['error' => 'Erro ao decodificar resposta da API']);
    exit;
}

echo json_encode($data);
?>
