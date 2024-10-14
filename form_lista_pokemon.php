<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Pokémon Favorito</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav>
        <ul class="navbar">
            <li><a href="restrita_lista.php">Voltar</a></li>
            <li style="float:right; color: white;"></li>
        </ul>
    </nav>

    <h1>Adicionar Pokémon à Pokédex</h1>
    <div class="formulario">
        <form action="addpokemon.php" method="post">
            <h2>Bom dia</h2>
            <label for="pokemon">Pokémon:</label>
            <select name="pokemon" id="pokemon" required>
                <?php
                $db = new mysqli("localhost", "root", "", "pokemons_dataset");
                if ($db->connect_error) {
                    die("Conexão falhou: " . $db->connect_error);
                }

                $query = "SELECT pokedex_number, name FROM pokemon";
                $poemon = $db->query($query);

                if ($poemon && $poemon->num_rows > 0) {
                    while ($bixo = $poemon->fetch_assoc()) {
                        echo "<option value='{$bixo['pokedex_number']}'>{$bixo['name']}</option>";
                    }
                } else {
                    echo "<option value=\"\">Nenhum Pokémon cadastrado</option>";
                }

                $db->close();
                ?>
            </select>
            <input type="submit" value="Adicionar" name="Adicionar" class="enviar">
        </form>
    </div>
</body>

</html>
