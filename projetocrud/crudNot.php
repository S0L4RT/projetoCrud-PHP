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
$n = new Noticia($db);

// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];

    $n->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter parâmetros de pesquisa e filtros
$search = isset($_GET['search']) ? $_GET['search'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';
// Obter dados dos usuários com filtros
$dados = $n->lerNot($search, $order_by);

// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];

    $n->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];

// Obter dados dos usuários
 $dados = $n->lerNot();

// Função para determinar a saudação
function saudacao() {
    $hora = date('H');
    if ($hora >= 6 && $hora < 12) {
    return 'Bom dia';
    } elseif ($hora >= 12 && $hora < 18) {
    return 'Boa tarde';
    } else {
    return 'Boa noite';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Portal</title>
</head>
<body>
    <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>
    <a href="./registrarNoticia.php">Adicionar notícia</a>
    <a href="logout.php">Logout</a>
    <br>
    <!-- INCORPORADO UM FORMULÁRIO PARA FAZER O FILTRO -->

    <form method="GET">
        <input type="text" name="search" placeholder="Pesquisar por titulo" value="<?php echo htmlspecialchars($search); ?>">
        <label>
            <input type="radio" name="order_by" value="" <?php if ($order_by == '') echo 'checked'; ?>>
            Normal
        </label>
        <label>
            <input type="radio" name="order_by" value="nome" <?php if ($order_by == 'titulo') echo 'checked'; ?>>
            Ordem Alfabética
        </label>
        <button type="submit">Pesquisar</button>
    </form>
    <table border="1">
        <tr>
            <th>Autor</th>
            <th>Data</th>
            <th>Título</th>
            <th>Notícia</th>
        </tr>
        <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
        <tr>
            <td><?php echo $row['idusu']; ?></td>
            <td><?php echo $row['data']; ?></td>
            <td><?php echo $row['titulo']; ?></td>
            <td><?php echo $row['noticia']; ?></td>
            <td>
                <a href="editarNot.php?idnot=<?php echo $row['idnot']; ?>">Editar</a>
                <a href="deletarNot.php?id=<?php echo $row['idnot']; ?>">Deletar</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>