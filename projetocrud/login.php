<?php
    session_start();
    include_once './config/Config.php';
    include_once './classes/Usuario.php';
    
    $usuario = new Usuario($db);
//var_dump($_POST['email']);
//exit();
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['login'])){
            // Processar login
            $email = $_POST['email'];
            $senha = $_POST['senha'];

                if($dados_usuario = $usuario->login($email, $senha)){
                    $_SESSION['usuario_id'] = $dados_usuario['id'];
                    header('Location: portal.php');
                    exit();
                }else{
                    $mensagem_erro = "Credenciais inválidas!";
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
        <div class="box">
            <h1>Autenticação</h1>
        <form method="POST">
            <label for="email">Email:</label>
            <input type="email" name="email" placeholder="Insira seu email" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input type="password" name="senha" placeholder="Insira sua senha" required>
            <br><br>
            <input type="submit" value="Login" name="login">
             <p>Clique <a href="solicitar_recuperacao.php">aqui</a> para solicitar recuperação de senha</p>
        </form>
        <p>Não tem conta?<a href="./registrar.php">Aqui</a></p>
        <div class="mensagem">
            <?php
                if(isset($mensagem_erro)){
                    echo '<p>'.$mensagem_erro.'<p>';
                }
            ?>
            </div>
        </div>
    </div>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>