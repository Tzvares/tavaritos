<?php
// Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");

// Verifica se a conexão foi bem-sucedida
if ($db->connect_error) {
    die("Falha na conexão: " . $db->connect_error);
}

// Verifica se os parâmetros foram passados
if (isset($_GET['id_pessoa']) && isset($_GET['pokedex_number'])) {
    $id_pessoa = intval($_GET['id_pessoa']);
    $pokedex_number = intval($_GET['pokedex_number']);

    // Verifica se é um POST para atualizar os dados
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtém os dados do formulário
        $novo_pokedex_number = intval($_POST['pokemon']); // Se você deseja mudar o Pokémon
        // Aqui pode ser adicionado qualquer outra atualização necessária

        // Atualiza o Pokémon na tabela pessoa_pokemon
        $query = "UPDATE pessoa_pokemon SET pokedex_number = $novo_pokedex_number WHERE id_pessoa = $id_pessoa AND pokedex_number = $pokedex_number";
        
        if ($db->query($query) === TRUE) {
            header("Location: restrita_lista.php?status=editado");
            exit();
        } else {
            echo "Erro ao editar o Pokémon: " . $db->error;
        }
    } else {
        // Busca o Pokémon para exibir no formulário
        $query = "SELECT pokedex_number FROM pessoa_pokemon WHERE id_pessoa = $id_pessoa AND pokedex_number = $pokedex_number";
        $resultado = $db->query($query);

        if ($resultado && $resultado->num_rows > 0) {
            $pokemon = $resultado->fetch_assoc();
            $pokedex_number_atual = $pokemon['pokedex_number'];
        } else {
            echo "Pokémon não encontrado.";
            exit();
        }
    }
} else {
    echo "ID da pessoa ou número da Pokédex não fornecido.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pokémon</title>
</head>
<body>
    <h1>Editar Pokémon</h1>
    <form action="" method="post">
        <label for="pokemon">Escolha um novo Pokémon:</label>
        <select name="pokemon" id="pokemon" required>
            <?php
            // Preenche o select com os Pokémons disponíveis
            $query = "SELECT pokedex_number, name FROM pokemon";
            $poemon = $db->query($query);

            if ($poemon && $poemon->num_rows > 0) {
                while ($bixo = $poemon->fetch_assoc()) {
                    $selected = ($bixo['pokedex_number'] == $pokedex_number_atual) ? 'selected' : '';
                    echo "<option value='{$bixo['pokedex_number']}' $selected>{$bixo['name']}</option>";
                }
            } else {
                echo "<option value=\"\">Nenhum Pokémon cadastrado</option>";
            }
            ?>
        </select>
        <input type="submit" value="Salvar Alterações">
    </form>
    <li><a href="restrita_lista.php">Voltar</a></li>
</body>
</html>
