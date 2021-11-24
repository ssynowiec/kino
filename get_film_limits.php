<?php
    require_once './db_config.php';
    // $sql = "SELECT pojemnosc-(SELECT count(idRezerwacje) FROM rezerwacje WHERE Seanse_idSeansu = se.idSeansu) as 'ilosc' FROM sale s INNER JOIN seanse se ON s.nr_sali = se.Sale_nr_sali WHERE se.idSeansu = (SELECT idSeansu FROM seanse WHERE Filmy_idFilmu = '".$_GET['film']."' AND `date` = '".$_GET['date']."' AND `time` = '".$_GET['time']."')";
    $sql = "SELECT pojemnosc-(SELECT count(idRezerwacje) FROM rezerwacje WHERE Seanse_idSeansu = ".$_GET['seans'].") as 'ilosc' FROM sale s INNER JOIN seanse se ON s.nr_sali = se.Sale_nr_sali WHERE se.idSeansu =".$_GET['seans'];
    $result = mysqli_query($mysql, $sql);

    if (mysqli_num_rows($result) == 0) {
        $dostepne = 0;
        echo $dostepne;
    } else {
        $dostepne = mysqli_fetch_assoc($result)['ilosc'];
        echo $dostepne;
    }
?>
