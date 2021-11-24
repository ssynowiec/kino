<?php
    session_start();
    if (isset($_GET['id'])) {
        $id_seansu = $_GET['id'];
        require_once '../db_config.php';
        $sql = "CALL delete_seans($id_seansu)";
        $result = $mysql->query($sql);
        if ($result) {
            $_SESSION['success'] = 'Pomyślnie usunięto seans'.$id_seansu;
            header('Location: ./seanse.php');
            exit();
        } else {
            $_SESSION['error'] = 'Pomyślnie usunięto seans'.$id_seansu;
            header('Location: ./seanse.php');
            exit();
        }
    } else {
        echo 'test';
        $_SESSION['error'] = 'Nie wybrano seansu';
        header('Location: ./seanse.php');
        exit();
    }
?>