<?php
    include_once './config/Config.php';
    include_once './classes/Usuario.php';

    $mensagem = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $codigo = $_POST['codigo'];
        $nova_senha = $_POST['nova_senha'];
        $usuario = new Usuario($db);

        if($usuario->redefinirSenha($codigo, $nova_senha)){
            $mensagem = 'Senha redefinida com sucesso. Você pode <a href="index.php">entrar</a> agora';
        }else{
            $mensagem = 'Código de verificação inválido.';
        }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>redefinir senha</title>
    <link rel="stylesheet" href="css/redefinirSenha.css">
</head>
<body>
<header>
        <h1>portal de notícias</h1>
    </header>
    <div class="container">
        <div class="box">
    <h1>redefinir senha</h1>
    <form method="POST">
        <label for="codigo">Código de verificação:</label>
        <input class="inserir" id="verific" type="text" name="codigo" placeholder="Seu código aqui" required><br><br>
        <label for="nova_senha">nova senha:</label>
        <input class="inserir" type="password" name="nova_senha" required><br><br>
        <input class="btn" type="submit" value="redefinir senha">
    </form>
    <p><?php echo $mensagem; ?></p>
    </div>
    </div>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>