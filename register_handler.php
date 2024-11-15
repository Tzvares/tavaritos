<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = password_hash($_POST['senha'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO pessoa (email, senha) VALUES (?, ?)");
    if ($stmt->execute([$email, $senha])) {
        echo "Registro bem-sucedido! <a href='login.php'>Faça login</a>";
    } else {
        echo "Erro ao registrar.";
    }
}
?>
