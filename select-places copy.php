<?php
    session_start();
    if (!isset($_POST['seans'])) {
        header('Location: ./buy-ticket.php');
    }
    $seans = $_POST['seans'];
    $ticket = $_POST['ticket'];
    $quantity = $_POST['quantity'];
    // $sql = "SELECT pojemnosc-(SELECT count(idRezerwacje) FROM rezerwacje WHERE Seanse_idSeansu = ".$seans.") as 'ilosc' FROM sale s INNER JOIN seanse se ON s.nr_sali = se.Sale_nr_sali WHERE se.idSeansu =".$seans;
    $sql = "SELECT pojemnosc FROM sale s INNER JOIN seanse se ON s.nr_sali = se.Sale_nr_sali WHERE se.idSeansu =".$seans;
    require_once './db_config.php';
    $result = $mysql->query($sql);
    $pojemnosc = $result->fetch_assoc()['pojemnosc'];
    $sql = "SELECT Sale_nr_sali, tytul, `date`, `time` FROM seanse s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE idSeansu =".$seans;
    $result = $mysql->query($sql);
    $sql2 = "SELECT `miejsce`, `rzad` FROM `rezerwacje` WHERE `Seanse_idSeansu` = ?";
    $stmt = mysqli_prepare($mysql, $sql2);
    $stmt->bind_param('i', $seans);
    $stmt->execute();
    $result2 = $stmt->get_result();
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
    <div class="container" style="padding-top: 150px;">
        <h1>Kup bilet</h1>
        <p>
            <?php
                $dane = $result->fetch_assoc();
                echo 'Film: '.$dane['tytul'].'</br>';
                echo 'Data: '.$dane['date'].'</br>';
                echo 'Godzina: '.$dane['time'].'</br>';
                echo 'Sala: '.$dane['Sale_nr_sali'].'</br>';
            ?>
        </p>
        <p>Wybierz <?php echo $quantity; ?> miejsca.</p>
        <form action="./check-logged.php" method="post" class="sala-miejsca">
            <div class="screen">EKRAN</div>
            <input type="hidden" name="seans" id="seans" value="<?php echo $seans; ?>">
            <input type="hidden" name="ticket" id="ticket" value="<?php echo $ticket; ?>">
            <input type="hidden" name="quantity" id="quantity" value="<?php echo $quantity;?>">
            <!-- <input type="hidden" name="quantity" id="quantity" value="3"> -->
            <?php
                $pom = 0;
                for ($row = 1; $row <= ceil($pojemnosc/10); $row++) {
                    echo '<div class="row">';
                    for ($m=1; $m <= 10; $m++) {
                        $isReserved = false;
                        if (mysqli_num_rows($result2) > 0) {
                            $stmt->execute();
                            $result2 = $stmt->get_result();
                            while($reserved = mysqli_fetch_assoc($result2)) {
                                if ($row.$m == $reserved['rzad'].$reserved['miejsce']) {
                                    echo '<label class="place"> &nbsp;';
                                    echo '<input type="checkbox" name="place[]" id="" value="'.$row.'-'.$m.'" class="chair" checked disabled>';
                                    echo '<span class="checkmark"></span>';
                                    echo '</label>';
                                    $isReserved = true;
                                }
                            }
                            if (!$isReserved) {
                                echo '<label class="place">  &nbsp;';
                                echo '<input type="checkbox" name="place[]" id="" value="'.$row.'-'.$m.'" class="chair">';
                                echo '<span class="checkmark"></span>';
                                echo '</label>';
                            }
                        } else {
                            echo '<label class="place">  &nbsp;';
                            echo '<input type="checkbox" name="place[]" id="" value="'.$row.'-'.$m.'" class="chair">';
                            echo '<span class="checkmark"></span>';
                            echo '</label>';
                        }

                        $pom++;
                        if ($pom == $pojemnosc) {
                            break;
                        }
                    }
                    echo '</div>';
                }
            ?>
            <br>
            <div class="row">
            <input type="submit" value="Podaj swoje dane ->" class="btn">
            </div>
        </form>
        <label class="place free" id="free"> Wolne
            <input type="checkbox" id="" value="'.$m.'" class="chair" disabled>
            <span class="checkmark"></span>
        </label>
        <label class="place selected"> Wybrane
            <input type="checkbox" id="" value="'.$m.'" class="chair" disabled>
            <span class="checkmark"></span>
        </label>
        <label class="place block"> Zajęte
            <input type="checkbox" id="" value="'.$m.'" class="chair" disabled>
            <span class="checkmark"></span>
        </label>
    </div>
</main>
<?php
    require_once './footer.php';
?>
<script src="./js/places.js"></script>
</body>
</html>