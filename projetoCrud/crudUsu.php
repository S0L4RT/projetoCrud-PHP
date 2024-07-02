<?php
session_start();
include_once './config/config.php';
include_once './classes/Usuario.php';

// Verificar se o usuário está logado
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit();
}

$usuario = new Usuario($db);

// Obter dados do usuário logado
$dados_usuario = $usuario->lerPorId($_SESSION['usuario_id']);
$nome_usuario = $dados_usuario['nome'];


// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];
    $usuario->deletar($id);
    header('Location: portal.php');
    exit();
}
// Obter parâmetros de pesquisa e filtros
$search = isset($_GET['search']) ? $_GET['search'] : '';
$order_by = isset($_GET['order_by']) ? $_GET['order_by'] : '';
// Obter dados dos usuários com filtros
$dados = $usuario->ler($search, $order_by);

// Processar exclusão de usuário
if (isset($_GET['deletar'])) {
    $id = $_GET['deletar'];

    $usuario->deletar($id);
    header('Location: portal.php');
    exit();
}

// Obter dados dos usuários
//$dados = $usuario->ler();


// Função para determinar a saudação
function saudacao()
{
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
    <title>Usuários</title>
    <link rel="stylesheet" href="css/crudUsu.css">
</head>

<body>
<header>
        <h1>portal de notícias</h1>
        <div class="btn"><a href="portal.php"><button>Voltar</button></a></div>
    </header>
    <div class="container">
    <div class="box">
    <h1><?php echo saudacao() . ", " . $nome_usuario; ?>!</h1>
    <a href="registrar.php">Adicionar Usuário</a>
    <a href="logout.php">Logout</a>
    <!-- INCORPORADO UM FORMULÁRIO PARA FAZER O FILTRO -->

    <form method="GET">
        <input class="inserir" type="text" name="search" placeholder="Pesquisar por nome ou email" value="<?php echo htmlspecialchars($search); ?>">
        <label>
            <input type="radio" name="order_by" value="" <?php if ($order_by == '') echo 'checked'; ?>>
            Normal
        </label>
        <label>
            <input type="radio" name="order_by" value="nome" <?php if ($order_by == 'nome') echo 'checked'; ?>>
            Ordem Alfabética
        </label>
        <label>
            <input type="radio" name="order_by" value="sexo" <?php if ($order_by == 'sexo') echo 'checked'; ?>>
            Sexo
        </label>
        <button class="btn" type="submit">Pesquisar</button>
    </form>

    <br>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Sexo</th>
            <th>Fone</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $dados->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nome']; ?></td>
                <td><?php echo ($row['sexo'] === 'M') ? 'Masculino' : 'Feminino'; ?></td>
                <td><?php echo $row['fone']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>
                    <a class="btn" href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
                    <a class="btn" href="deletar.php?id=<?php echo $row['id']; ?>">Deletar</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    </div>
    </div>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>

</html>