<?php
    session_start();
    if (!isset($_POST['login']) || !isset($_POST['password'])) {
        $_SESSION['error'] = 'Podaj dane logowania';
        header('Location: login.php');
    } else {
        require_once './db_config.php';
        $login = $_POST['login'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM klienci WHERE `login` = ?";
        $stmt = mysqli_prepare($mysql, $sql);
        $stmt->bind_param('s', $login);
        $stmt->execute();
        $result = $stmt->get_result();
        if (mysqli_num_rows($result) == 0) {
            $_SESSION['error'] = 'Podany użytkownik nie istnieje';
            header('Location: login.php');
            exit();
        } else {
            $sql = "SELECT pass FROM klienci WHERE `login` = ?";
            $stmt = mysqli_prepare($mysql, $sql);
            $stmt->bind_param('s', $login);
            $stmt->execute();
            $result = $stmt->get_result();
            $dane = mysqli_fetch_assoc($result);
            if (password_verify($password, $dane['pass'])) {
                $_SESSION['error'] = '';
                unset($_SESSION['error']);
                $_SESSION['logged'] = true;
                $_SESSION['user'] = $login;
                header('Location: dashboard.php');
            } else {
                $_SESSION['error'] = 'Podano błędne hasło';
                header('Location: login.php');
                exit();
            }
        }
    }
?>