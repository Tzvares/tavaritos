<?php
session_start();
include 'db.php'; // Inclui o arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }

    // Verifica se o email já está registrado
    $stmt = $pdo->prepare("SELECT * FROM pessoa WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        die("Este email já está registrado.");
    }

    // Criptografa a senha e insere o usuário no banco de dados
    $hashedPassword = password_hash($senha, PASSWORD_BCRYPT);
    $stmt = $pdo->prepare("INSERT INTO pessoa (email, senha) VALUES (?, ?)");
    $stmt->execute([$email, $hashedPassword]);

    echo "Registro concluído com sucesso. <a href='login.php'>Faça login aqui</a>.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Registrar Conta - Pokédex</title>
</head>
<body>
    <h1>Registrar Conta</h1>
    <form method="POST" action="register.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="senha" placeholder="Senha" required>
        <button type="submit">Registrar</button>
    </form>

    <p>Já tem uma conta? <a href="login.php">Faça login</a></p>
</body>
</html>
