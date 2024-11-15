<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    // Se não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit;
}

echo "<h1>Bem-vindo à Pokédex</h1>";
echo "<p>Aqui você pode escolher seu Pokémon favorito, ver os favoritos dos outros treinadores e visualizar as estatísticas dos Pokémons.</p>";
echo '<a href="choose_favorite.php">Escolher Pokémon Favorito</a><br>';
echo '<a href="logout.php">Logout</a>';
?>
