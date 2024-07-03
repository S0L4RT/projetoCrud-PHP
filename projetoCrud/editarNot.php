<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])){
        header('Location: login.php');
        exit();
    }

    include_once './config/Config.php';
    include_once './classes/Noticia.php';

    $noticia = new Noticia($db);
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $idnot = $_POST['id'];
        $data = date('Y-m-d');
        $titulo = $_POST['titulo'];
        $not = $_POST['noticia'];
        $noticia->atualizar($idnot, $data, $titulo, $not);
        header('Location: crudNot.php');
        exit();
    }

    if(isset($_GET['idnot'])){
        $id = $_GET['idnot'];
        $row = $noticia->lerPorId($id);
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/editNot.css">
</head>
<body>
<header>
        <h1>portal de notícias</h1>
        <div><a href="crudNot.php"><button class="btn">Voltar</button></a></div>
    </header>
    <div class="container">
        <div class="box">
    <h1>Editar Notícia</h1>
    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $row['idnot']; ?>">
        <label for="titulo">Titulo:</label>
        <input class="inserir" type="text" name="titulo" value="<?php echo $row['titulo']; ?>" required>
        <br><br>
        <label for="noticia">Notícia:</label>
        <input class="inserir" type="text" name="noticia" value="<?php echo $row['noticia']; ?>" required>
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