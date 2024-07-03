<?php
    session_start();
    if(!isset($_SESSION['usuario_id'])){
        header('Location: login.php');
        exit();
    }

    include_once './config/Config.php';
    include_once './classes/Noticia.php';

    $noticia = new Noticia($db);
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $noticia->deletar($id);
        header('Location: crudNot.php');
        exit();
    }
?>