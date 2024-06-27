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

// Obter dados dos usuários
$dados = $usuario->ler();

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