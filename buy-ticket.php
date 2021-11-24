<?php
    session_start();
    if (isset($_GET['film'])) {
        $film = $_GET['film'];
    }
    if (isset($_GET['hour'])) {
        $hour = $_GET['hour'];
    }

    require_once './db_config.php';
    $sql = "SELECT DISTINCT f.idFilmu, f.tytul FROM filmy f INNER JOIN seanse s ON f.idFilmu = s.Filmy_idFilmu";
    $result = mysqli_query($mysql, $sql);
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
        <form action="./select-places.php" method="post" class="box">
            <label for="film">Wybierz film</label>
            <select name="film" id="film" class="film" required>
                <option value="">Wybierz</option>
                <?php
                    while ($films = mysqli_fetch_assoc($result)) {
                        if (isset($film) && $films['tytul'] == $film) {
                            echo '<option value="'.$films['idFilmu'].'" selected>'.$films['tytul'].'</option>';
                        } else {
                            echo '<option value="'.$films['idFilmu'].'">'.$films['tytul'].'</option>';
                        }
                    }
                ?>
            </select>
            <div class="seans" id="seans">
                <?php
                    if (isset($_GET['film'])) {
                        $sql = "SELECT IdSeansu, `date`, `time` FROM seanse s INNER JOIN filmy f ON s.Filmy_IdFilmu = f.idFilmu WHERE f.tytul = '".$film."'";
                        $dates = mysqli_query($mysql, $sql);
                        $i = 0;
                        while ($date = mysqli_fetch_assoc($dates)) {
                            $i++;
                            $today = date('Y-m-d');
                            $d_en = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
                            $d_pl = ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nd'];
                            $filmDate = str_replace($d_en, $d_pl, date('D',strtotime($date['date'])));
                            if (isset($hour) && ($date['time'] == $hour && $date['date'] == $today)) {
                                echo '<input type="radio" id='.$i.' name="seans" value="'.$date['IdSeansu'].'" checked></input><label for="'.$i.'">'.$date['date'].' ('.$filmDate.') '.$date['time'].'</label></br>';
                            } else {
                                echo '<input type="radio" id='.$i.' name="seans" value="'.$date['IdSeansu'].'"></input><label for="'.$i.'">'.$date['date'].' ('.$filmDate.') '.$date['time'].'</label></br>';
                            }
                        }
                    }
                ?>
            </div>
            <div class="tickets">
                <label for="ticket">Rodzaj biletu</label>
                <select name="ticket" id="ticket" class="ticket">
                    <?php
                        $sql = "SELECT 	idBiletu, concat(typ, ' (', cena, 'zł)') as bilet FROM bilety";
                        $result = mysqli_query($mysql, $sql);
                        while ($ticket = mysqli_fetch_assoc($result)) {
                            echo '<option value="'.$ticket['idBiletu'].'">'.$ticket['bilet'].'</option>';
                        }
                    ?>
                </select>
                <label for="quantity">Ilość</label>
                <?php
                if (isset($_GET['film']) && isset($_GET['hour'])) {
                    $today = date('Y-m-d');
                    $sql = "SELECT pojemnosc-(SELECT count(idRezerwacje) FROM rezerwacje WHERE Seanse_idSeansu = se.idSeansu) as 'ilosc' FROM sale s INNER JOIN seanse se ON s.nr_sali = se.Sale_nr_sali WHERE se.idSeansu = (SELECT idSeansu FROM seanse INNER JOIN filmy ON seanse.Filmy_idFilmu = filmy.idFilmu WHERE filmy.tytul = '".$_GET['film']."' AND `date` = '".$today."' AND `time` = '".$_GET['hour']."')";
                    $result = mysqli_query($mysql, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        echo '<input type="number" name="quantity" id="quantity" class="quantity" value="0" min="0" step="0" max="0" required></br>';
                    } else {
                        $dostepne = mysqli_fetch_assoc($result)['ilosc'];
                        echo '<input type="number" name="quantity" id="quantity" class="quantity" value="1" min="1" step="1" max="'.$dostepne.'" required></br>';
                    }
                } else {
                        echo '<input type="number" name="quantity" id="quantity" class="quantity" value="0" min="0" step="0" max="0" required></br>';
                    }
                ?>
            </div>
            <!-- <button class="btn next-ticket" id="next-ticket">Dodaj kolejny bilet</button> -->
            <input type="submit" value="Wybierz miejsca ->" class="btn">
        </form>
    </div>
</main>
<?php
    require_once './footer.php';
?>
<script src="./js/buy-ticket.js"></script>
</body>
</html>