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
</head>
<body>
    <h1>Adicionar Usuário</h1>
    <form method="POST">
        <label for="titulo">Titulo:</label>
        <input type="text" name="titulo" placeholder="Titulo" required>
        <br><br>
        <label for="noticia">Notícia:</label>
        <input type="text" name="noticia" placeholder="Noticia" required>
        <br><br>
        <input type="submit" value="Adicionar">
    </form>
</body>
</html>