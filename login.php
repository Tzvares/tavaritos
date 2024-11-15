<?php
session_start();
include 'db.php'; // Inclui a conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        die("Por favor, preencha todos os campos.");
    }

    // Busca o usuário pelo email
    $stmt = $pdo->prepare("SELECT * FROM pessoa WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verifica se o usuário existe e a senha está correta
    if ($user && password_verify($senha, $user['senha'])) {
        // Cria a sessão com o ID do usuário
        $_SESSION['user_id'] = $user['ID'];
        // Redireciona para a página principal (index.php) após login bem-sucedido
        header("Location: index.php");
        exit; // Interrompe a execução para garantir que não continue
    } else {
        echo "Email ou senha inválidos.";
    }
}
?>
