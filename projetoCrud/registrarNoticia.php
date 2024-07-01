<?php
session_start();
    include_once './config/Config.php';
    include_once './classes/Noticia.php';
    include_once './classes/Usuario.php';
 
    if(!isset($_SESSION['usuario_id'])){
        header('Location> login.php');
        exit();
    }

    $usuario = new Usuario($db);
    $n = new Noticia($db);

    // Obter dados do usuário logado
    $dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
    $nome_usuario = $dados_usuario['nome'];


    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id_usu = $_SESSION['usuario_id'];
        $titulo = $_POST['titulo'];
        $noticia = $_POST['noticia'];
        $data = date('Y-m-d');
        $n->registrar($id_usu, $data, $titulo, $noticia);
        header('Location: crudNot.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Notícia</title>
    <link rel="stylesheet" href="css/registrarNot.css">
</head>
<body>
<header>
        <h1>portal de notícias</h1>
    </header>
    <main>
    <div class="container">
        <div class="box">
            
    <h1>Adicionar Usuário</h1>
    <form method="POST">
        <label class="tit" for="titulo">Titulo:</label>
        <input class="inserir" type="text" name="titulo" placeholder="Adicionar titulo" required>
        <br><br>
        <label class="not" for="noticia">Notícia:</label>
        <input class="inserir" type="text" name="noticia" placeholder="Adicionar noticia" required>
        <br><br>
        <input class="btn" type="submit" value="Adicionar">
    </form>
    
    </div>
    </div>
    </main>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>