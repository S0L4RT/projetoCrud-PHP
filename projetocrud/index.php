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
        <button>
            <svg id="arrow=horizontal" xmlns="http://www.w3.org/2000/svg" width="30" height="10" viewBox="0 0 46 16">
                <path id="Path_10" data-name="Path 10" d="M8,0,6.545,1.45515.506,5.506H-30V9.039H12.052L6.545,14.545,8,16l8-8Z" tranform="translate(30)"></path>
            </svg>
        </button>
    </main>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>