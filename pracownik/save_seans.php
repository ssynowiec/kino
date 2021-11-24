<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        $_SESSION['error'] = 'Musisz być zalogowany aby uzyskać dostęp do tej strony';
        header('Location: ./index.php');
        exit();
    }
    if(!isset($_POST['film']) || !isset($_POST['sala']) || !isset($_POST['date']) || !isset($_POST['time'])) {
        $_SESSION['error'] = "Nie wszystkie dane zostały przesłane";
        header('Location: ./film.php');
        exit();
    } else {
        require_once '../db_config.php';
        $film = $_POST['film'];
        $sala = $_POST['sala'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $a_rows = 0;
        if(isset($_POST['id']) && $_POST['id'] != '') {
            $id = $_POST['id'];
            $sql = "UPDATE `seanse` SET `Filmy_idFilmu`='$film', `Sale_nr_sali`='$sala', `date`='$date', `time`='$time' WHERE `idSeansu`='$id'";
            $result = mysqli_query($mysql, $sql);
            $a_rows = mysqli_affected_rows($mysql);
            echo 'tests';
        } else {
            $sql = "INSERT INTO `seanse`(`Filmy_idFilmu`, `Sale_nr_sali`, `date`, `time`) VALUES (?, ?, ?, ?)";
            $stmt = $mysql->prepare($sql);
            $stmt->bind_param('iiss', $film, $sala, $date, $time);
            $stmt->execute();
            $a_rows = mysqli_affected_rows($mysql);
        }

        if($a_rows != 0) {
            if (isset($_POST['id']) && $_POST['id'] != '') {
                $_SESSION['success'] = "Seans został zedytowany";
            } else {
                $_SESSION['success'] = "Seans został dodany";
            }
            header('Location: ./seanse.php');
            exit();
        } else {
            if (isset($_POST['id']) && $_POST['id'] != '') {
                $_SESSION['error'] = "Wystąpił błąd podczas edycji seansu";
                header('Location: ./seans.php?id='.$id);
            } else {
                $_SESSION['error'] = "Wystąpił błąd podczas dodawania seansu";
                header('Location: ./seans.php');
            }
            exit();
        }
    }
?>