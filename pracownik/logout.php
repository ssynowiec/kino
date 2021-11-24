<?php
    session_start();
    $_SESSION['logged'] = false;
    $_SESSION['admin'] = "";
    unset($_SESSION['logged']);
    unset($_SESSION['admin']);
    session_destroy();
    header("Location: ./");
?>