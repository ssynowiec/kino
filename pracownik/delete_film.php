<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        header('Location: ./index.php');
        exit();
    }

    if (!isset($_GET['id']) && $_GET['id'] == '') {
        header('Location: ./rezerwacje.php');
        exit();
    } else {
        $id = $_GET['id'];
        $sql = "DELETE FROM filmy WHERE idFilmu = ?";
        require_once '../db_config.php';
        $stmt = $mysql->prepare($sql);
        $stmt->bind_param('i', $id);

        if ($stmt->execute()) {
            $_SESSION['success'] = 'Pomyślnie usunięto film';
            header('Location: ./films.php');
            exit();
        }
    }
?>