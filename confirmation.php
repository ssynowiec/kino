<?php
    session_start();
    if (!isset($_SESSION['succes']) || $_SESSION['succes'] === false) {
        header('Location: buy-ticket.php');
        exit();
    } else {
        $_SESSION['succes'] = '';
        unset($_SESSION['succes']);
        $ticket = $_SESSION['ticket'];
        $_SESSION['ticket'] = '';
        unset($_SESSION['ticket']);
        $seans = $_SESSION['seans'];
        $_SESSION['seans'] = '';
        unset($_SESSION['seans']);
        $places = $_SESSION['places'];
        $_SESSION['places'] = '';
        unset($_SESSION['places']);
    }
    require_once './db_config.php';
    if (isset($_SESSION['logged']) && $_SESSION['logged'] != false) {
        $sql = "SELECT `tytul`,`Klienci_idKlienta`, `Sale_nr_sali`, `date`, `time`, `typ`, `miejsce`, `rzad` FROM `rezerwacje` r INNER JOIN `klienci` k ON r.Klienci_idKlienta = k.idKlienta INNER JOIN seanse s ON r.Seanse_idSeansu = s.idSeansu INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu INNER JOIN bilety b ON r.Bilety_idBiletu = b.idBiletu WHERE `login` = ? AND `Seanse_idSeansu` = ? AND `Bilety_idBiletu` = ? ORDER BY idRezerwacje DESC LIMIT ".count($places);
        $stmt = mysqli_prepare($mysql, $sql);
        $stmt->bind_param('sii', $_SESSION['user'], $seans, $ticket);
        $stmt->execute();
        $result = $stmt->get_result();
    } else {
        $sql = "SELECT `tytul`,`Klienci_idKlienta`, `Sale_nr_sali`, `date`, `time`, `typ`, `miejsce`, `rzad` FROM `rezerwacje` r INNER JOIN `klienci` k ON r.Klienci_idKlienta = k.idKlienta INNER JOIN seanse s ON r.Seanse_idSeansu = s.idSeansiu INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE `mail` = ? AND `Seanse_idSeansu` = ? AND `Bilety_idBiletu` = ? ORDER BY idRezerwacje DESC LIMIT".count($places);
        $stmt = mysqli_prepare($mysql, $sql);
        $stmt->bind_param('sii', $_SESSION['mail'], $seans, $ticket);
        $stmt->execute();
        $result = $stmt->get_result();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        require_once './metatags.html';
    ?>
</head>
<body>
<?php
    require_once './nav.php';
?>
<main>
    <div class="container register-container" style="padding-top: 150px;">
        <h1>Potwierdzenie rezerwacji</h1>
        <h3>Zarezerwowano następujące bilety:</h3>
        <table>
            <thead>
                <th>Film</th>
                <th>Sala</th>
                <th>Data</th>
                <th>Godzina</th>
                <th>Bilet</th>
                <th>Rząd</th>
                <th>Miejsce</th>
            </thead>
            <tbody>
                <?php
                    while ($confirmation = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                                <td>'.$confirmation['tytul'].'</td>
                                <td>'.$confirmation['Sale_nr_sali'].'</td>
                                <td>'.$confirmation['date'].'</td>
                                <td>'.$confirmation['time'].'</td>
                                <td>'.$confirmation['typ'].'</td>
                                <td>'.$confirmation['rzad'].'</td>
                                <td>'.$confirmation['miejsce'].'</td>
                            </tr>';
                    }
                    $_SESSION['finish'] = true;
                ?>
            </tbody>
        </table>
        <a href="./finish.php" class="btn">Zakończ</a>
    </div>
</main>
<?php
    require_once './footer.php';
?>
</body>
</html>