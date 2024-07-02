<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])){
        header('Location: login.php');
        exit();
    }

    include_once './config/Config.php';
    include_once './classes/Usuario.php';

    $usuario = new Usuario($db);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $sexo = $_POST['sexo'];
        $fone = $_POST['fone'];
        $email = $_POST['email'];
        $usuario->atualizar($id, $nome, $sexo, $fone, $email);
        header('Location: crudUsu.php');
        exit();
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $row = $usuario->lerPorId($id);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/editUsu.css">
</head>
<body>
<header>
        <h1>portal de notícias</h1>
        <div><a href="crudNot.php"><button class="btn">Voltar</button></a></div>
    </header>
    <div class="container">
        <div class="box">
            
    <h1>Editar Usuário</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <label for="nome">Nome:</label>
        <input class="inserir" type="text" name="nome" value="<?php echo $row['nome']; ?>" required>
        <br><br>
        <label>Sexo:</label>
        <label for="masculino_editar">
            <input type="radio" id="masculino_editar" name="sexo" value="M" <?php echo ($row['sexo'] === 'M') ? 'checked' : ''; ?> required>
            Masculino
        </label>
        <label for="feminino">
            <input type="radio" id="feminino_editar" name="sexo" value="F" <?php echo ($row['sexo'] === 'F') ? 'checked' : ''; ?> required>
            Feminino
        </label>
        <br><br>
        <label for="fone">Fone:</label>
        <input class="inserir" type="text" name="fone" value="<?php echo $row['fone']; ?>" required>
        <br><br>
        <label for="email">Email:</label>
        <input class="inserir" type="email" name="email" value="<?php echo $row['email']; ?>" required>
        <br><br>
        <input class="btn" type="submit" value="Atualizar">
    </form>
    
    </div>
    </div>
    <footer>
        Copyright Arthur Maciel da Rosa
    </footer>
</body>
</html>