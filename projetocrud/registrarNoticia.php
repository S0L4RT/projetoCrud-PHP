<?php
    include_once './config/Config.php';
    include_once './classes/Noticia.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $noticia = new Noticia($db);
        $titulo = $_POST['titulo'];
        $noticia = $_POST['noticia'];
        $data = $_POST['data'];
        $noticia->criar($id, $titulo, $noticia, $data);
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