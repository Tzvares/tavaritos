<?php
// Inicia sessão
session_start();
// Verifica se a sessão foi criada
if(!isset($_SESSION['id'])){
    // Se não foi criada a sessão, redireciona para a página inicial
    header("location: index.php");
}


 //Conexão com o banco de dados
 $db = new mysqli("localhost", "root", "", "pokemons_dataset");
    
 //Query de consulta
 $stmt = $db->prepare("select * from Pessoa");
 //$stmt->bind_param("i",$_SESSION['id']);
 $stmt->execute();
 //Executa a consulta e armazena o resultado
 $resultado = $stmt->get_result();
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>lista de treinadores</h1>
      <?php 
    if($resultado->num_rows==0){
        echo "Não há livros cadastrados";
    }else{
        // Resgata todas as linhas da consulta
        // https://www.php.net/manual/pt_BR/mysqli-result.fetch-all.php
        $treinadores = $resultado->fetch_all(MYSQLI_ASSOC);
        echo "<table>";
        echo "<thead>
              <th>Email</th>
              <th>pokemon</th>
            </thead>";
  
        foreach($treinadores as $linha){
            echo "<tr>";
                echo "<td>{$linha['email']}</td>";

                //isso aqui é para puxar os pokemon, ainda não está terminado
                $query2 = "SELECT * FROM disco d 
                        JOIN artista a ON d.IdArtista = a.IdArtista";
             $resultado2 = $db2->query($query2);
                echo "<td>{$linha['email']}</td>";



            echo "</tr>";
        }
        echo "</table>";
    }

 

    

?>
<a href='form_lista_pokemon.php'>Adicionar pokemon favorito</a>
<a href='logout.php'>Sair</a>
</body>
</html>