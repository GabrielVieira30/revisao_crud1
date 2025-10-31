<?php
require '../includes/db.php';
$id = $_POST['id'] ?? '';
if ($id) {
    $stmt = $db->prepare('DELETE FROM tarefas WHERE id=?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => 'ID não informado']);
}
?>
