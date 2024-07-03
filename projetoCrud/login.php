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
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
    <header>
        <h1>portal de notícias</h1>
        <div><a href="index.php"><button class="btn">Voltar</button></a></div>
    </header>
    <div class="container">
        <div class="box">
            <h1>Autenticação</h1>
        <form method="POST">
            <label  for="email">Email:</label>
            <input class="inserir" type="email" name="email" placeholder="Insira seu email" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input class="inserir" type="password" name="senha" placeholder="Insira sua senha" required>
            <br><br>
            <input class="btn" type="submit" value="Login" name="login">
            <a href="./registrar.php"><button class="btn">Registre-se</button></a>
             <p>Esqueceu sua senha? Clique <a href="solicitar_recuperacao.php">aqui</a> </p>
        </form>
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