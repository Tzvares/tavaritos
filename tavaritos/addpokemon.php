<?php
// Conexão com o banco de dados
session_start();
// Verifica se a sessão foi criada
if(!isset($_SESSION['id_pessoa'])){
    // Se não foi criada a sessão, redireciona para a página inicial
    header("location: index.php");
}

// ID da pessoa 
$k = $session['id_pessoa'];
$db = new mysqli("localhost", "root", "", "pokemons_dataset");

// Verifica se a conexão foi bem-sucedida
if ($db->connect_error) {
    die("Falha na conexão: " . $db->connect_error);
}


// Query para selecionar os Pokémons adicionados
$query = "SELECT * FROM pessoa_pokemon WHERE id_pessoa = $k AND pokedex_number = $pokedex_number";
$result = $db->query($query);
if ($result && $result->num_rows > 0) {
    $update_query = "UPDATE pessoa_pokemon SET pokedex_number = $pokedex_number WHERE id_pessoa = $k";
    $db->query($update_query);}
    else{
        $query2 = "
        INSERT INTO pessoa_pokemon(id_pessoa, pokedex_number) 
        VALUES ($k,'$_POST[pokedex_number]')
    ";
    
    $resultado2 = $db->query($query2);
    };

header("location: restrita_lista.php");








$db->close();
?>

