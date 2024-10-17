<?php
// Conexão com o banco de dados
$db = new mysqli("localhost", "root", "", "pokemons_dataset");
if ($db->connect_error) {
    die("Conexão falhou: " . $db->connect_error);
}

// Definindo o id da pessoa (substitua isso pela lógica que obtém o ID da pessoa logada)
$id_pessoa = 1; // Exemplo: id fixo. No seu sistema, você pode usar sessões para o ID do usuário logado.

// Verifica se o formulário foi enviado e se o Pokémon foi selecionado
if (isset($_POST['pokemon'])) {
    $pokedex_number = $_POST['pokemon'];

    // Inserir o Pokémon favorito na tabela pessoa_pokemon
    $query = "INSERT INTO pessoa_pokemon (id_pessoa, pokedex_number) VALUES (?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("ii", $id_pessoa, $pokedex_number);
    
    if ($stmt->execute()) {
        echo "Pokémon favorito salvo com sucesso!";
    } else {
        echo "Erro ao salvar o Pokémon favorito: " . $db->error;
    }
    
    $stmt->close();
} else {
    echo "Nenhum Pokémon foi selecionado.";
}

$db->close();
?>
