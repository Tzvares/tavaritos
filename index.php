<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
    <div class='container'>
        <div class='box'>
            <h1>Login</h1>
            <form action='login.php' method='post'>
                <label>E-mail:</label>
                <input type='email' name='email' required>
                <label>Senha:</label>
                <input type='password' name='senha' required title="Oi">
                <div class='grupo_botao'>
                    <input type='submit' name='botao' value='Acessar'>
                </div>
                <a href='form_adicionar_pessoa.php'>Adicionar nova pessoa</a>
                
            </form>
        </div>
    </div>
</body>
</html>