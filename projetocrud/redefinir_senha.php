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
</head>
<body>
    <h1>redefinir senha</h1>
    <form method="POST">
        <label for="codigo">Código de verificação:</label>
        <input type="text" name="codigo" value="Seu código aqui" required><br><br>
        <label for="nova_senha">nova senha:</label>
        <input type="password" name="nova_senha" required><br><br>
        <input type="submit" value="redefinir senha">
    </form>
    <p><?php echo $mensagem; ?></p>
</body>
</html>