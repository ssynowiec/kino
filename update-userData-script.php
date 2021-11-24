<?php
    session_start();

    if (isset($_POST['first-name']) || isset($_POST['last-name']) || isset($_POST['email']) || isset($_POST['adress']) || isset($_POST['postal-code']) || isset($_POST['city']) || isset($_POST['tel'])) {

        $login = $_SESSION['user'];
        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $adress = $_POST['adress'];
        $postalCode = $_POST['postal-code'];
        $city = $_POST['city'];
        $tel = $_POST['tel'];

        require_once './db_config.php';

        if (isset($_POST['password']) && isset($_POST['reapet-password']) && $_POST['password'] != '' && $_POST['reapet-password'] != '') {
            $password = $_POST['password'];
            $reapetPassword = $_POST['reapet-password'];
            if ($password == $reapetPassword) {
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE klienci SET imie = '$firstName', nazwisko = '$lastName', mail = '$email', adres = '$adress', kod_pocztowy = '$postalCode', miejscowosc = '$city', nr_telefonu = '$tel', `pass` = '$passwordHash' WHERE `login` = '$login'";
            } else {
                $_SESSION['error'] = 'Hasła nie są takie same';
                header('Location: ./dashboard.php');
                exit();
            }
        } else {
            $sql = "UPDATE klienci SET imie = '$firstName', nazwisko = '$lastName', mail = '$email', adres = '$adress', kod_pocztowy = '$postalCode', miejscowosc = '$city', nr_telefonu = '$tel' WHERE `login` = '$login'";
        }
        if (mysqli_query($mysql, $sql)) {
            $_SESSION['success'] = true;
            header('Location: ./dashboard.php');
            exit();
        }
    }
?>