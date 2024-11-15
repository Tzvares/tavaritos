<?php
$host = 'localhost';
$db = 'pokemons_dataset';
$user = 'root'; // Substitua com o usuário correto
$pass = ''; // Substitua com a senha correta

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro ao conectar: " . $e->getMessage());
}
?>
