<?php
    session_start();
    if (!isset($_SESSION['ticket'])) {
        header('Location: buy-ticket.php');
        exit();
    }
    if (!isset($_POST['name']) && !isset($_POST['last-name']) && !isset($_POST['email']) && !isset($_POST['adress']) && !isset($_POST['postal-code']) && !isset($_POST['city']) && !isset($_POST['tel']) && !isset($_POST['regulamin'])) {
        header('Location: your-data.php');
        exit();
    } else {
        require_once './db_config.php';
        if (isset($_SESSION['logged']) && $_SESSION['logged'] == true) {
            $sql = "SELECT idKlienta FROM klienci WHERE `login` = ?";
            $stmt = mysqli_prepare($mysql, $sql);
            $stmt->bind_param('s', $_SESSION['user']);
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $client = mysqli_fetch_assoc($result)['idKlienta'];
            }
        } else {
            $mail = $_POST['email'];
            $sql = "SELECT idKlienta FROM klienci WHERE mail = ?";
            $stmt = mysqli_prepare($mysql, $sql);
            $stmt->bind_param('s', $mail);
            $stmt->execute();
            $result = $stmt->get_result();
            if (mysqli_num_rows($result) > 0) {
                $client = mysqli_fetch_assoc($result)['idKlienta'];
            } else {
                $name = $_POST['name'];
                $lastName = $_POST['last-name'];
                $adress = $_POST['adress'];
                $postalCode = $_POST['postal-code'];
                $city = $_POST['city'];
                $tel = $_POST['tel'];

                $sql = "INSERT INTO `klienci`(`imie`, `nazwisko`, `mail`, `adres`, `kod_pocztowy`, `miejscowosc`, `nr_telefonu`) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($mysql, $sql);
                $stmt->bind_param('sssssss', $name, $lastName, $mail, $adress, $postalCode, $city, $tel);
                $stmt->execute();
                $result = $stmt->get_result();
                
                $sql = "SELECT idKlienta FROM klienci WHERE mail = ?";
                $stmt = mysqli_prepare($mysqli, $sql);
                $stmt->bind_param('s', $mail);
                $stmt->execute();
                $result = $stmt->get_result();
                if (mysqli_num_rows($result) > 0) {
                    $client = mysqli_fetch_assoc($result)['idKlienta'];
                }
            }
        }
        if ($client != '') {
            $places = $_SESSION['places'];
            foreach ($places as $place) {
                $row = substr($place, 0, strpos($place, '-'));
                $m = substr($place, strpos($place, '-')+1);
                $sql = "INSERT INTO `rezerwacje`(`Klienci_idKlienta`, `Seanse_idSeansu`, `Bilety_idBiletu`, `miejsce`, `rzad`) VALUES (?, ?, ?, ?, ?)";
                $stmt = mysqli_prepare($mysql, $sql);
                $stmt->bind_param('iiiii', $client, $_SESSION['seans'], $_SESSION['ticket'], $m, $row);
                $stmt->execute();
                $result = $stmt->get_result();
            }
        }
        if ($result !== '') {
            if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
                $_SESSION['mail'] = $mail;
            }
            $_SESSION['succes'] = true;
            header('Location: confirmation.php');
        }
    }
?>