<?php
require '../includes/db.php';
$result = $db->query('SELECT t.*, u.nome as usuario_nome FROM tarefas t JOIN usuarios u ON t.usuario_id = u.id');
$tasks = [];
while ($row = $result->fetch_assoc()) {
    $tasks[] = $row;
}
echo json_encode($tasks);
?>
