<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        $_SESSION['error'] = 'Musisz być zalogowany aby uzyskać dostęp do tej strony';
        header('Location: ./index.php');
        exit();
    }
    if(!isset($_POST['pojemnosc'])) {
        $_SESSION['error'] = "Nie wszystkie dane zostały przesłane";
        header('Location: ./sala.php');
        exit();
    } else {
        require_once '../db_config.php';
        $pojemnosc = $_POST['pojemnosc'];
        $a_rows = 0;
        if(isset($_POST['id']) && $_POST['id'] != '') {
            $id = $_POST['id'];
            $sql = "UPDATE `sale` SET `pojemnosc`='$pojemnosc' WHERE `nr_sali` = '$id'";
            $result = mysqli_query($mysql, $sql);
            $a_rows = mysqli_affected_rows($mysql);
        } else {
            $sql = "INSERT INTO `sale`(`pojemnosc`) VALUES (?)";
            $stmt = $mysql->prepare($sql);
            $stmt->bind_param('i', $pojemnosc);
            $stmt->execute();
            $a_rows = mysqli_affected_rows($mysql);
        }

        if($a_rows != 0) {
            if (isset($_POST['id']) && $_POST['id'] != '') {
                $_SESSION['success'] = "Sala została zedytowana";
            } else {
                $_SESSION['success'] = "Sala została dodana";
            }
            header('Location: ./sale.php');
            exit();
        } else {
            if (isset($_POST['id']) && $_POST['id'] != '') {
                $_SESSION['error'] = "Wystąpił błąd podczas edycji sali";
                header('Location: ./sala.php?id='.$id);
            } else {
                $_SESSION['error'] = "Wystąpił błąd podczas dodawania sali";
                header('Location: ./sala.php');
            }
            exit();
        }
    }
?>