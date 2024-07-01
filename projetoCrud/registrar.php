<?php
    include_once './config/Config.php';
    include_once './classes/Usuario.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $usuario = new Usuario($db);
        $nome = $_POST['nome'];
        $sexo = $_POST['sexo'];
        $fone = $_POST['fone'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $usuario->criar($nome, $sexo, $fone, $email, $senha);
        header('Location: crudUsu.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Usuário</title>
    <link rel="stylesheet" href="css/registrar.css">
</head>
<body>
    <header>
        <h1>portal de notícias</h1>
    </header>
    <div class="container">
    <div class="box">
    <h1>Adicionar Usuário</h1>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input class="inserir" type="text" name="nome" placeholder="nome" required>
        <br><br>
        <label>Sexo:</label>
        <label for="masculino">
            <input class="inserir" type="radio" id="masculino" name="sexo" value="M" required>Masculino
        </label>
        
        <label>
            <input class="inserir" type="radio" id="feminino" name="sexo" value="F" required>Feminino
        </label>
        <br><br>
        <label for="fone">Fone:</label>
        <input class="inserir" type="text" name="fone" placeholder="Fone" required>
        <br><br>
        <label for="email">Email:</label>
        <input class="inserir" type="email" name="email" placeholder="E-mail" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input class="inserir" type="password" name="senha" placeholder="Senha" required>
        <br><br>
        <input class="btn" type="submit" value="Adicionar">
    </form>
    </div>
    </div>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>