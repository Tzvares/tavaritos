<?php
session_start();
// Verifica se a sessão foi criada
if(!isset($_SESSION['id_pessoa'])){
    // Se não foi criada a sessão, redireciona para a página inicial
    header("location: index.php");
}
    // Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");

    // Verifica se a conexão foi bem-sucedida
    if ($db->connect_error) {
        die("Falha na conexão: " . $db->connect_error);
    }

    // ID da pessoa e número da Pokédex do Pokémon a ser deletado
    $id_pessoa = $_session['id_pessoa'];
    

    // Query para deletar o Pokémon específico da tabela pessoa_pokemon
    $query = "DELETE FROM pessoa_pokemon WHERE id_pessoa = $id_pessoa ";
    $db->query($query);
    
    header('location: restrita_lista.php');

?>

<?php 
session_start();
if(!isset($_SESSION['id'])){
    header("location: index.php");
}

    if(isset($_GET)){
        //Conexão com o banco de dados
        $db = new mysqli("localhost", "root", "", "pokemons_dataset");
        
        $pok_num = filter_var($_GET['pokedex_number'],FILTER_SANITIZE_NUMBER_INT);
        
        $stmt = $db->prepare("delete from pessoa_pokemon where pokedex_number = ?");
        
        $stmt->bind_param("i",$pok_num);
        
        $stmt->execute();

        header("location:colecao.php");
    }
?>