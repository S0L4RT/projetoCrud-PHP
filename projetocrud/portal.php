<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portal</title>
</head>

<body>
    <header>
        <h1>portal de notícias</h1>
    </header>
    <main>
        <h2><?php echo saudacao() . ", " . $nome_usuario; ?>!</h2>
        <a href="crudUsu.php"><button>usuários</button></a>
        <a href="crudNot.php"><button>notícias</button></a>
    </main>
    <footer>
        Copyrigth Arthur Maciel da Rosa
    </footer>
</body>

</html>