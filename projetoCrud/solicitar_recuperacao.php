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
    <link rel="stylesheet" href="css/solicitarRecu.css">
</head>
<body>
<header>
        <h1>portal de notícias</h1>
    </header>
    <div class="container">
        <div class="box">
    <h1>recuperar senha</h1>
    <form method="POST">
        <label for="email">email:</label>
        <input class="inserir" type="email" name="email" required><br><br>
        <input class="btn" type="submit" value="Enviar">
    </form>
    <p><?php echo $mensagem; ?></p>
    <a class="btn" href="login.php">voltar</a>
    </div>
    </div>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>