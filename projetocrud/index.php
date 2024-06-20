<?php
    session_start();
    include_once './classes/DataBase.php';
    include_once './classes/Usuario.php';
    
    $usuario = new Usuario($db);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['login'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
                if($dados_usuario = $usuario->login($email, $senha)){
                    $_SESSION['usuario_id'];
                    header('location:portal.php');
                    exit();
                }else{
                    $mensagem_erro = "Credenciais inválidos!";
                }
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticação</title>
</head>
<body>
    <div class="container">
        <from method="POST">
            <input type="email" name="email" placeholder="Insira seu email" required>
            <input type="password" name="senha" placeholder="Insira sua senha" required>
            <input type="submit" value="Entrar">
            <p>Não tem conta?<a href="./registrar.php">Aqui</a></p>
        </from>
        <div class="mensagem">
            <?php
                if(isset($mensagem_erro)){
                    echo '<p>'.$mensagem_erro.'<p>';
                }
            ?>
        </div>
    </div>
</body>
</html>