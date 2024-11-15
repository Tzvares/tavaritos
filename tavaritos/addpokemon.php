<?php
// Conexão com o banco de dados
session_start();
// Verifica se a sessão foi criada
if(!isset($_SESSION['id_pessoa'])){
    // Se não foi criada a sessão, redireciona para a página inicial
    header("location: index.php");
}

// ID da pessoa 

$db = new mysqli("localhost", "root", "", "pokemons_dataset");

// Verifica se a conexão foi bem-sucedida
if ($db->connect_error) {
    die("Falha na conexão: " . $db->connect_error);
}

$num_poke = $_GET['Pokedex_number'];
// Query para selecionar os Pokémons adicionados

$stmt = $db -> prepare("INSERT INTO pessoa_pokemon(id_pessoa, pokedex_number 
        VALUES (?,?) ");

$stmt ->bind_param("ii",$_SESSION['id_pessoa'], $num_poke);

$stmt ->execute();

header("location: restrita_lista.php");



$db->close();
?>

