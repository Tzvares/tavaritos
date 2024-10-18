<?php
if (isset($_GET['id_pessoa']) && isset($_GET['pokedex_number'])) {
    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");

    // Verifica se a conexão foi bem-sucedida
    if ($db->connect_error) {
        die("Falha na conexão: " . $db->connect_error);
    }

    // ID da pessoa e número da Pokédex do Pokémon a ser deletado
    $id_pessoa = intval($_GET['id_pessoa']);
    $pokedex_number = intval($_GET['pokedex_number']);

    // Query para deletar o Pokémon específico da tabela pessoa_pokemon
    $query = "DELETE FROM pessoa_pokemon WHERE id_pessoa = $id_pessoa AND pokedex_number = $pokedex_number";

    // Executa a query
    if ($db->query($query) === TRUE) {
        // Redireciona para a página de listagem após a exclusão
        header("Location: restrita_lista.php?status=deletado");
        exit();
    } else {
        echo "Erro ao deletar o Pokémon: " . $db->error;
    }

    // Fecha a conexão
    $db->close();
} else {
    echo "ID do Pokémon ou número da Pokédex não fornecido.";
}
?>
