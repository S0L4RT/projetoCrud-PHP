<?php
session_start();
include_once './config/config.php';
include_once './classes/Noticia.php';
include_once './classes/Usuario.php';

$usuario = new Usuario($db);
$n = new Noticia($db);

// Obter parâmetros de pesquisa e filtros
$search = isset($_GET['search']) ? $_GET['search'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';
// Obter dados dos usuários com filtros
$dados = $n->lerNot($search, $order_by);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Portal</title>
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <header>
        <h1>portal de notícias</h1>
        <div class="btn"><a href="login.php"><button>entrar</button></a></div>
    </header>
    <main>
        <div class="container">
    <!-- INCORPORADO UM FORMULÁRIO PARA FAZER O FILTRO -->
    <form method="GET">
        <input type="text" name="search" placeholder="Pesquisar por titulo" value="<?php echo htmlspecialchars($search); ?>">
        <label>
            <input type="radio" name="order_by" value="" <?php if ($order_by == '') echo 'checked'; ?>>
            Normal
        </label>
        <label>
            <input type="radio" name="order_by" value="titulo" <?php if ($order_by == 'titulo') echo 'checked'; ?>>
            Ordem Alfabética
        </label>
        <button class="btnPesq" type="submit">Pesquisar</button>
    </form>
    <table border="1">
        <tr>
            <th>autor</th>
            <th>data</th>
            <th>título</th>
            <th>notícia</th>
        </tr>
        <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?php echo $row['nome_usuario']; ?></td>
            <td><?php echo $row['data']; ?></td>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['noticia']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    </div>
    </main>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>