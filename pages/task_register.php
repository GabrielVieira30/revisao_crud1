<?php
require '../includes/db.php';

$message = '';
$task = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $db->prepare('SELECT * FROM tarefas WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $task = $result->fetch_assoc();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario_id = $_POST['usuario_id'] ?? '';
    $descricao = trim($_POST['descricao'] ?? '');
    $setor = trim($_POST['setor'] ?? '');
    $prioridade = $_POST['prioridade'] ?? '';
    $status = $_POST['status'] ?? 'a fazer';

    if ($usuario_id && $descricao && $setor && $prioridade) {
        if (isset($_POST['id'])) {
            // Update
            $id = $_POST['id'];
            $stmt = $db->prepare('UPDATE tarefas SET usuario_id=?, descricao=?, setor=?, prioridade=?, status=? WHERE id=?');
            $stmt->bind_param('issssi', $usuario_id, $descricao, $setor, $prioridade, $status, $id);
        } else {
            // Insert
            $stmt = $db->prepare('INSERT INTO tarefas (usuario_id, descricao, setor, prioridade, status) VALUES (?, ?, ?, ?, ?)');
            $stmt->bind_param('issss', $usuario_id, $descricao, $setor, $prioridade, $status);
        }
        if ($stmt->execute()) {
            $message = 'Tarefa salva com sucesso';
        } else {
            $message = 'Erro ao salvar tarefa: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = 'Todos os campos são obrigatórios';
    }
}

// Buscar usuarios para select
$usuarios = [];
$result = $db->query('SELECT id, nome FROM usuarios');
while ($row = $result->fetch_assoc()) {
    $usuarios[] = $row;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $task ? 'Editar' : 'Cadastrar'; ?> Tarefa</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1><?php echo $task ? 'Editar' : 'Cadastrar'; ?> Tarefa</h1>
    <form method="POST" action="">
        <?php if ($task): ?>
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
        <?php endif; ?>
        <label for="usuario_id">Usuário:</label>
        <select id="usuario_id" name="usuario_id" required>
            <option value="">Selecione um usuário</option>
            <?php foreach ($usuarios as $usuario): ?>
                <option value="<?php echo $usuario['id']; ?>" <?php echo ($task && $task['usuario_id'] == $usuario['id']) ? 'selected' : ''; ?>><?php echo $usuario['nome']; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required><?php echo $task ? $task['descricao'] : ''; ?></textarea>
        <label for="setor">Setor:</label>
        <input type="text" id="setor" name="setor" value="<?php echo $task ? $task['setor'] : ''; ?>" required>
        <label for="prioridade">Prioridade:</label>
        <select id="prioridade" name="prioridade" required>
            <option value="Baixa" <?php echo ($task && $task['prioridade'] == 'Baixa') ? 'selected' : ''; ?>>Baixa</option>
            <option value="Média" <?php echo ($task && $task['prioridade'] == 'Média') ? 'selected' : ''; ?>>Média</option>
            <option value="Alta" <?php echo ($task && $task['prioridade'] == 'Alta') ? 'selected' : ''; ?>>Alta</option>
        </select>
        <?php if ($task): ?>
            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="a fazer" <?php echo ($task['status'] == 'a fazer') ? 'selected' : ''; ?>>A Fazer</option>
                <option value="fazendo" <?php echo ($task['status'] == 'fazendo') ? 'selected' : ''; ?>>Fazendo</option>
                <option value="pronto" <?php echo ($task['status'] == 'pronto') ? 'selected' : ''; ?>>Pronto</option>
            </select>
        <?php endif; ?>
        <button type="submit"><?php echo $task ? 'Atualizar' : 'Cadastrar'; ?> Tarefa</button>
    </form>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="index.html">Voltar ao Kanban</a>
</body>
</html>
