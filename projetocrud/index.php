<?php
    session_start();
    include_once './config/Config.php';
    include_once './classes/Usuario.php';
    include_once './classes/Noticia.php';

    $noticia = new Noticia($db);
    $usuario = new Usuario($db);

    $noticias = $noticia->lerTodasComAutor();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portal de notícias</title>
</head>

<body>
    <header>
        <h1>portal de notícias</h1>
        <a href="login.php"><button>entrar</button></a>
    </header>
    <main>
    </main>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>