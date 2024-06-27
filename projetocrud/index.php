<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticia.php';
include_once './classes/Usuario.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuario($db);
$noticia = new Noticia($db);

// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];

    $noticia->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

// Obter dados dos usuários
$dados = $noticia->ler();

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
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Titulo</th>
            <th>noticia</th>
            <th>data</th>
        </tr>
        <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>;
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['noticia']; ?></td>
            <td><?php echo $row['data']; ?></td>
    </main>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>

</html>