<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokémons Favoritos</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Lista de Pokémons Favoritos</h1>
    
    <?php
    // Conectando ao banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");
    if ($db->connect_error) {
        die("Conexão falhou: " . $db->connect_error);
    }

    // Consulta para obter os pokémons favoritos (baseado na tabela 'pessoa_pokemon')
    $query = "SELECT p.name 
              FROM pessoa_pokemon pp 
              JOIN pokemon p ON pp.pokedex_number = p.pokedex_number";

    $result = $db->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_assoc()) {
            echo "<li>{$row['name']}</li>";
        }
        echo "</ul>";
    } else {
        echo "<p>Nenhum Pokémon favorito adicionado ainda.</p>";
    }

    $db->close();
    ?>

    <li><a href="form_lista_pokemon.php">Adicionar mais Pokémon</a></li>
</body>

</html>
