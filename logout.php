<?php
    session_start();
    $_SESSION['logged'] = false;
    $_SESSION['user'] = "";
    unset($_SESSION['logged']);
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ./");
?>