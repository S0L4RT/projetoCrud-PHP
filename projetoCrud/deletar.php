<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])){
        header('Location: login.php');
        exit();
    }

    include_once './config/Config.php';
    include_once './classes/Usuario.php';
    include_once './classes/Noticia.php';

    $usuario = new Usuario($db);
    $noticia = new Noticia($db);
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $noticia->deletarUsu($id);
        $usuario->deletar($id);
        header('Location: crudUsu.php');
        exit();
    }
?>