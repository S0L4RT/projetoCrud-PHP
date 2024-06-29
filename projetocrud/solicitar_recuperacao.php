<?php
    include_once "./config/Config.php";
    include_once "./classes/Usuario.php";

    $mensagem = '';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_POST['email'];
        $usuario = new Usuario($db);
        $codigo = $usuario->gerarCodigoVerificacao($email);

        if($codigo){
            $mensagem = "Seu código de verificação é: $codigo. Por favor, anote o código e <a href='redefinir_senha.php'>Clique aqui</a> para redefinir sua senha.";
        }else{
            $mensagem = "Email não encontrado.";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recuperar senha</title>
</head>
<body>
    <h1>recuperar senha</h1>
    <form method="POST">
        <label for="email">email:</label>
        <input type="email" name="email" required><br><br>
        <input type="submit" value="Enviar">
    </form>
    <p><?php echo $mensagem; ?></p>
    <a href="login.php">voltar</a>
</body>
</html>