<?php
// Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");

// Verifica se a conexão foi bem-sucedida
if ($db->connect_error) {
    die("Falha na conexão: " . $db->connect_error);
}

// Verifica se o número da Pokédex foi passado
if (isset($_GET['pokedex_number'])) {
    $pokedex_number = intval($_GET['pokedex_number']);

    // Query para buscar os atributos do Pokémon
    $query = "SELECT name, attack, defense, type, is_legendary FROM pokemon WHERE pokedex_number = $pokedex_number";
    $resultado = $db->query($query);

    // Verifica se o Pokémon foi encontrado
    if ($resultado && $resultado->num_rows > 0) {
        $pokemon = $resultado->fetch_assoc();
        echo "<h1>Atributos do Pokémon: {$pokemon['name']}</h1>";
        echo "<ul>
                <li><strong>Ataque:</strong> {$pokemon['attack']}</li>
                <li><strong>Defesa:</strong> {$pokemon['defense']}</li>
                <li><strong>Tipo:</strong> {$pokemon['type']}</li>
                <li><strong>É Lendário:</strong> " . ($pokemon['is_legendary'] ? 'Sim' : 'Não') . "</li>
              </ul>";
    } else {
        echo "Pokémon não encontrado.";
    }
} else {
    echo "Número da Pokédex não fornecido.";
}

// Fecha a conexão
$db->close();
?>
