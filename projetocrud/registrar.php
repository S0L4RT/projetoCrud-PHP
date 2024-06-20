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
        $usuario-> criar($nome, $sexo, $fone, $email, $senha);
        header('location:index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <h1>Cadastro Usuário</h1>
    <form method="POST">
        <input type="text" name="nome" placeholder="nome" required>
        <br><label>Masculino</label>
        <input type="radio" name="sexo" value="M" required>
        <label>Feminino</label>
        <input type="radio" name="sexo" value="F" required>
        <input type="text" name="fone" placeholder="Fone" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="password" name="senha" placeholder="Senha" required><br>
        <input type="submit" value="Salvar">
    </form>
</body>
</html>