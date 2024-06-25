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