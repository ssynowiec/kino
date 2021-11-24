<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        $_SESSION['error'] = 'Musisz być zalogowany aby uzyskać dostęp do tej strony';
        header('Location: ./index.php');
        exit();
    }
    if(!isset($_POST['title']) || !isset($_POST['gatunek']) || !isset($_POST['producent']) || !isset($_POST['premiera']) || !isset($_POST['rezyser']) || !isset($_POST['time']) || !isset($_POST['description'])) {
        $_SESSION['error'] = "Nie wszystkie dane zostały przesłane";
        header('Location: ./film.php');
        exit();
    } else {
        require_once '../db_config.php';
        $tytul = $_POST['title'];
        $gatunek = $_POST['gatunek'];
        $producent = $_POST['producent'];
        $premiera = $_POST['premiera'];
        $rezyser = $_POST['rezyser'];
        $time = $_POST['time'];
        $opis = $_POST['description'];
        $target_dir = "../img/plakaty/";
        $target_file = $target_dir . basename($_FILES["poster"]["name"]);
        $check = getimagesize($_FILES["poster"]["tmp_name"]);
        if ($check === false) {
            $_SESSION['error'] = "Plik nie jest plikiem graficznym";
            header('Location: ./film.php');
            exit();
        } else {
            if (file_exists($target_file)) {
                $_SESSION['error'] = "Plik o tej nazwie już istnieje";
                header('Location: ./film.php');
                exit();
            } else {
                if ($_FILES["poster"]["size"] > 500000) {
                    $_SESSION['error'] = "Plik jest za duży";
                    header('Location: ./film.php');
                    exit();
                } else {
                    if ($_FILES["poster"]["type"] != "image/jpeg" && $_FILES["poster"]["type"] != "image/png") {
                        $_SESSION['error'] = "Plik nie jest w formacie JPEG lub PNG";
                        header('Location: ./film.php');
                        exit();
                    } else {
                        if (move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file)) {
                            $plakat = "./img/plakaty/".basename($_FILES["poster"]["name"]);
                        } else {
                            $_SESSION['error'] = "Nie udało się załadować pliku";
                            header('Location: ./film.php');
                            exit();
                        }
                    }
                }
            }
        }
        $a_rows = 0;
        if(isset($_POST['id']) && $_POST['id'] != '') {
            $id = $_POST['id'];
            $sql = "UPDATE `filmy` SET `tytul`='$tytul', `Gatunki_idGatunku`='$gatunek', `producent`='$producent', `premiera`='$premiera', `rezyser`='$rezyser', `czas_trwania`='$time', `plakat`='$plakat', `opis`='$opis' WHERE `idFilmu`='$id'";
            $result = mysqli_query($mysql, $sql);
            $a_rows = mysqli_affected_rows($mysql);
            echo 'tests';
        } else {
            $sql = "INSERT INTO `filmy`(`tytul`, `Gatunki_idGatunku`, `producent`, `premiera`, `rezyser`, `czas_trwania`, `plakat`, `opis`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $mysql->prepare($sql);
            $stmt->bind_param('sissssss', $tytul, $gatunek, $producent, $premiera, $rezyser, $time, $plakat, $opis);
            $stmt->execute();
            $a_rows = mysqli_affected_rows($mysql);
        }

        if($a_rows != 0) {
            if (isset($_POST['id']) && $_POST['id'] != '') {
                $_SESSION['success'] = "Film został zedytowany";
            } else {
                $_SESSION['success'] = "Film został dodany";
            }
            header('Location: ./films.php');
            exit();
        } else {
            if (isset($_POST['id']) && $_POST['id'] != '') {
                $_SESSION['error'] = "Wystąpił błąd podczas edycji filmu";
                header('Location: ./film.php?id='.$id);
            } else {
                $_SESSION['error'] = "Wystąpił błąd podczas dodawania filmu";
                header('Location: ./film.php');
            }
            exit();
        }
    }
?>