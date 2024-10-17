<?php
// Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");
if ($db->connect_error) {
    die("Conexão falhou: " . $db->connect_error);
}

// Verifica se o parâmetro pokedex_number foi passado pela URL
if (isset($_GET['pokedex_number'])) {
    $pokedex_number = $_GET['pokedex_number'];

    // Consulta para buscar o Pokémon pelo número da Pokédex
    $query = "SELECT name, pokedex_number, type, attack, defense, is_legendary FROM pokemon WHERE pokedex_number = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $pokedex_number);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $pokemon = $result->fetch_assoc();
    } else {
        echo "Pokémon não encontrado.";
        exit();
    }
} else {
    echo "Nenhum Pokémon selecionado.";
    exit();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Pokémon</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Detalhes do Pokémon</h1>

    <div class="pokemon-detalhes">
        <h2><?php echo htmlspecialchars($pokemon['name']); ?></h2>
        <p><strong>Número na Pokédex:</strong> <?php echo $pokemon['pokedex_number']; ?></p>
        <p><strong>Tipo:</strong> <?php echo htmlspecialchars($pokemon['type']); ?></p>
        <p><strong>Ataque:</strong> <?php echo $pokemon['attack']; ?></p>
        <p><strong>Defesa:</strong> <?php echo $pokemon['defense']; ?></p>
        <p><strong>É Lendário:</strong> <?php echo $pokemon['is_legendary'] ? 'Sim' : 'Não'; ?></p>
    </div>

    <li><a href="restrita_lista.php">Voltar</a></li>
</body>

</html>
