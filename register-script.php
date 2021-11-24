<?php
    session_start();
    if (!isset($_POST['login']) || !isset($_POST['first-name']) || !isset($_POST['last-name']) || !isset($_POST['email']) || !isset($_POST['adress']) || !isset($_POST['postal-code']) || !isset($_POST['city']) || !isset($_POST['tel']) || !isset($_POST['password']) || !isset($_POST['reapet-password'])) {
        $_SESSION['error'] = 'Nie wypełniono wszystkich pól';
        header('Location: register.php');
        exit();
    }
    else {
        if (!isset($_POST['regulamin']) || $_POST['regulamin'] != 'on') {
            $_SESSION['error'] = 'Nie zaakceptowano regulaminu';
            header('Location: register.php');
            exit();
        } else {
            require_once './db_config.php';
            $email = $_POST['email'];
            $verEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
            if ($verEmail) {
                $sql = "SELECT * FROM klienci WHERE `mail` = ?";
                $stmt = mysqli_prepare($mysql, $sql);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0) {
                    $_SESSION['error'] = 'Użytkownik o podanym emailu już istnieje!';
                    header('Location: register.php');
                    exit();
                } else {
                    $login = $_POST['login'];
                    $sql = "SELECT * FROM klienci WHERE `login` = ?";
                    $stmt = mysqli_prepare($mysql, $sql);
                    $stmt->bind_param('s', $login);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    if (mysqli_num_rows($result) > 0) {
                        $_SESSION['error'] = 'Użytkownik o podanym loginie już istnieje!';
                        header('Location: register.php');
                        exit();
                    } else {
                        $postalCode = $_POST['postal-code'];
                        $patt = "/[0-9]{2}\-[0-9]{3}/";
                        if (strlen($postalCode) != 6 || !preg_match($patt, $postalCode)) {
                            $_SESSION['error'] = 'Niepoprawny kod pocztowy';
                            header('Location: register.php');
                            exit();
                        } else {
                            $password = $_POST['password'];
                            $passwordRepeat = $_POST['reapet-password'];
                            if ($password == $passwordRepeat) {
                                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                                $name = $_POST['first-name'];
                                $lastName = $_POST['last-name'];
                                $adress = $_POST['adress'];
                                $city = $_POST['city'];
                                $tel = $_POST['tel'];
                                $sql = "INSERT INTO klienci(`login`, `imie`, `nazwisko`, `mail`, `adres`, `kod_pocztowy`, `miejscowosc`, `nr_telefonu`, `pass`) VALUES(?,?,?,?,?,?,?,?,?)";
                                $stmt = mysqli_prepare($mysql, $sql);
                                $stmt->bind_param('sssssssss', $login, $name, $lastName, $email, $adress, $postalCode, $city, $tel, $passwordHash);
                                if ($stmt->execute()) {
                                    $_SESSION['success'] = true;
                                    header('Location: success.php');
                                    exit();
                                }
                            } else {
                                $_SESSION['error'] = 'Podane hasła nie są identyczne!';
                                header('Location: register.php');
                                exit();
                            }
                        }
                    }
                }
            } else {
                $_SESSION['error'] = 'Podany email jest nieprawidłowy!';
                header('Location: register.php');
                exit();
            }
        }
    }
?>