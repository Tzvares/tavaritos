<?php
// Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");

// Verifica se a conexão foi bem-sucedida
if ($db->connect_error) {
    die("Falha na conexão: " . $db->connect_error);
}

// ID da pessoa (defina de acordo com a lógica do seu sistema)
$id_pessoa = 1; // Supondo que seja o usuário atual

// Query para selecionar os Pokémons adicionados
$query = "
    SELECT pp.id_pessoa, p.pokedex_number, p.name, p.attack, p.defense, p.type, p.is_legendary
    FROM pessoa_pokemon pp
    INNER JOIN pokemon p ON pp.pokedex_number = p.pokedex_number
    WHERE pp.id_pessoa = $id_pessoa
";

$resultado = $db->query($query);

// Mensagem de status (se houver)
if (isset($_GET['status'])) {
    if ($_GET['status'] == 'adicionado') {
        echo "<p>Pokémon adicionado com sucesso!</p>";
    } elseif ($_GET['status'] == 'editado') {
        echo "<p>Pokémon editado com sucesso!</p>";
    } elseif ($_GET['status'] == 'deletado') {
        echo "<p>Pokémon deletado com sucesso!</p>";
    }
}

// Verifica se há Pokémons adicionados
if ($resultado && $resultado->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Nome</th>
                <th>Attack</th>
                <th>Defense</th>
                <th>Type</th>
                <th>Is Legendary</th>
                <th>Ações</th>
            </tr>";
    while ($row = $resultado->fetch_assoc()) {
        echo "<tr>
                <td>{$row['name']}</td>
                <td>{$row['attack']}</td>
                <td>{$row['defense']}</td>
                <td>{$row['type']}</td>
                <td>" . ($row['is_legendary'] ? 'Sim' : 'Não') . "</td>
                <td>
                    
                    <a href='edita_pokemon.php?id_pessoa={$row['id_pessoa']}&pokedex_number={$row['pokedex_number']}'>Editar</a> | 
                    <a href='deleta_pokemon.php?id_pessoa={$row['id_pessoa']}&pokedex_number={$row['pokedex_number']}' onclick='return confirm(\"Tem certeza que deseja deletar?\");'>Deletar</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum Pokémon adicionado.";
}

// Fecha a conexão
$db->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokémons Favoritos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Pokémons Favoritos</h1>
    <li><a href="addpokemon.php">Adicionar Pokémon</a></li>
</body>
</html>
