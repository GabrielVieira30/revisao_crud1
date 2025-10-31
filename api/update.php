<?php
require '../includes/db.php';
$id = $_POST['id'] ?? '';
$usuario_id = $_POST['usuario_id'] ?? '';
$descricao = trim($_POST['descricao'] ?? '');
$setor = trim($_POST['setor'] ?? '');
$prioridade = $_POST['prioridade'] ?? '';
$status = $_POST['status'] ?? '';
if ($id && $usuario_id && $descricao && $setor && $prioridade && $status) {
    $stmt = $db->prepare('UPDATE tarefas SET usuario_id=?, descricao=?, setor=?, prioridade=?, status=? WHERE id=?');
    $stmt->bind_param('issssi', $usuario_id, $descricao, $setor, $prioridade, $status, $id);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos']);
}
?>
