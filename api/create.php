<?php
require '../includes/db.php';
$usuario_id = $_POST['usuario_id'] ?? '';
$descricao = trim($_POST['descricao'] ?? '');
$setor = trim($_POST['setor'] ?? '');
$prioridade = $_POST['prioridade'] ?? '';
$status = $_POST['status'] ?? 'a fazer';
if ($usuario_id && $descricao && $setor && $prioridade) {
    $stmt = $db->prepare('INSERT INTO tarefas (usuario_id, descricao, setor, prioridade, status) VALUES (?, ?, ?, ?, ?)');
    $stmt->bind_param('issss', $usuario_id, $descricao, $setor, $prioridade, $status);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
}
?>
