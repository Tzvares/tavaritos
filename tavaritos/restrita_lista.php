<?php
// Inicia sessão
session_start();
// Verifica se a sessão foi criada
if(!isset($_SESSION['id_pessoa'])){
    // Se não foi criada a sessão, redireciona para a página inicial
    header("location: index.php");
}

    //Conexão com o banco de dados
    $db = new mysqli("localhost", "root", "", "pokemons_dataset");
    
    //Query de consulta
    $stmt = $db->prepare("select * from pokemon ");
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
    <title>Coleção de pokemons</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div class='container'>
    <h1>Lista de pokemons</h1>
      <?php 
    if($resultado->num_rows==0){
        echo "Não há pokemons cadastrados";
    }else{
        // Resgata todas as linhas da consulta
        // https://www.php.net/manual/pt_BR/mysqli-result.fetch-all.php
        $aa = $resultado->fetch_all(MYSQLI_ASSOC);
        echo "<table>";
        echo "<thead>
              <th>pokemon</th>
              <th>attack</th>
              <th>defense</th>
              <th>lendário</th>
              <th>Tipo</th>
            </thead>";
  
        foreach($aa as $linha){
            echo "<tr>";
                echo "<td>{$linha['Name']}</td>";
                echo "<td>{$linha['Attack']}</td>";
                echo "<td>{$linha['Defense']}</td>";
                if($linha['Is_legendary']==1){
                    echo "<td>SIM</td>";
                }
                else{
                    echo "<td>NÃO</td>";
                }
                //echo "<td>{$linha['Is_legendary']}</td>";

                
            echo "</tr>";
        }
        echo "</table>";
    }

 

    echo "<a href='form_lista_pokemon.php'>Adicionar/mudar pokemon favorito</a>";
    echo "<a href='logout.php'>Sair</a>";

?>
<a href="lista_treinadores.php">ver treinadores</a>
<a href='mostra_pokemon.php'>ver pokemon favorito</a>
    </div>
</body>
</html>