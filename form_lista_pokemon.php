<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Disco</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="http://localhost/Discoteca-Prog-2024/site/certificado_ouro.png?v=2" type="image/png">
</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="restrita_lista.php">Voltar</a></li>
            <li style="float:right; color: white;">
            </li>
        </ul>
    </nav>

    <h1>adicionar pokemon a pokedex</h1>
    <div class="formulario">
        <form action="addpokemon.php" method="post">
            <h1>bom dia</h1>
            <label for="pokemon">pokemon:</label>
            <select name="pokemon" id="pokemon" required>
                <?php
                $db = new mysqli("localhost", "root", "", "pokemons_dataset");
                if ($db->connect_error) {
                    die("Conexão falhou: " . $db->connect_error);
                }

                $query = "SELECT name FROM pokemon";
                $poemon = $db->query($query);

               


                if ($poemon->num_rows > 0) {
                    while ($bixo = $nomes->fetch_assoc()) {
                        echo "<option value='{$bixo['pokedex_number']}'>{$bixo['Name']}</option>";
                    }
                } else {
                    echo "<option value=\"\">nenhum poekom cadastrado</option>";
                }

                $db->close();
                ?>
            </select>
            <input type="submit" value="Adicionar" name="Adicionar" class="enviar">
        </form>
    </div>
   
</body>

</html>