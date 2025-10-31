<?php
require '../includes/db.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');

    if ($nome && $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $db->prepare('INSERT INTO usuarios (nome, email) VALUES (?, ?)');
            $stmt->bind_param('ss', $nome, $email);
            if ($stmt->execute()) {
                $message = 'Cadastro concluído com sucesso';
            } else {
                $message = 'Erro ao cadastrar usuário: ' . $stmt->error;
            }
            $stmt->close();
        } else {
            $message = 'E-mail inválido';
        }
    } else {
        $message = 'Todos os campos são obrigatórios';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    <form method="POST" action="">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required>
        <button type="submit">Cadastrar</button>
    </form>
    <?php if ($message): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>
    <a href="index.html">Voltar ao Kanban</a>
</body>
</html>
