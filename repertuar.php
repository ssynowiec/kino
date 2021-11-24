<?php
    session_start();
    require_once './db_config.php';
    if (isset($_GET['day'])) {
        $date = date($_GET['day']);
        $sql = "SELECT `idSeansu`, f.tytul as 'film', `Sale_nr_sali`, `date`, `time` FROM `seanse` s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE `date` LIKE '".$date."'";
        $result = $mysql->query($sql);
    } else {
        $month = date('m');
        $year = date('Y');
        $sql = "SELECT `idSeansu`, f.tytul as 'film', `Sale_nr_sali`, `date`, `time` FROM `seanse` s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE `date` LIKE '".$year.'-'.$month."-%'";
        $result = $mysql->query($sql);
        $seanse = [];
        while ($seans = $result->fetch_assoc()) {
            array_push($seanse, $seans);
        }
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
    // echo date('D', strtotime(date('Y-m-1')));
    // echo date('t', strtotime(date('Y-m-1')));
?>
<main>
    <div class="container" style="padding-top: 150px;">
    <?php
        if (isset($_GET['day'])) {
            if ($result->num_rows == 0) {
                echo '<h1>W wybranym dniu nie gramy żadnych filmów</h1>';
            } else {
                echo '<h1>W dniu '.date('d.m.Y', strtotime($date)).' gramy: </h1>';
            }
        } else {
    ?>
        <h1>Nasz repertuar na ten miesiąc</h1>
        <table class="calendar">
            <thead>
                <th>Pon</th>
                <th>Wt</th>
                <th>Śr</th>
                <th>Czw</th>
                <th>Pt</th>
                <th>Sob</th>
                <th>Nd</th>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['day'])) {
                    # code...
                } else {
                    $d = 1;
                    for ($i=1; $i <= date('t', strtotime(date('Y-m-1'))); $i++) {
                        if (date('D', strtotime(date('Y-m-1'))) == 'Mon') {
                            if ($i == 1) {
                                echo '<tr>';
                            }
                            if ($i == 1) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }
                        if (date('D', strtotime(date('Y-m-1'))) == 'Tue') {
                            if ($i == 1) {
                                echo '<tr>';
                                echo '<td></td>';
                                $d++;
                            }
                            if ($i == 7) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }
                        if (date('D', strtotime(date('Y-m-1'))) == 'Wed') {
                            if ($i == 1) {
                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td></td>';
                                $d++;
                                $d++;
                            }
                            if ($i == 6) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }
                        if (date('D', strtotime(date('Y-m-1'))) == 'Thu') {
                            if ($i == 1) {
                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                $d++;$d++;$d++;
                            }
                            if ($i == 5) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }
                        if (date('D', strtotime(date('Y-m-1'))) == 'Fri') {
                            if ($i == 1) {
                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                $d++;$d++;$d++;$d++;
                            }
                            if ($i == 4) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }
                        if (date('D', strtotime(date('Y-m-1'))) == 'Sat') {
                            if ($i == 1) {
                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                $d++;$d++;$d++;$d++;$d++;
                            }
                            if ($i == 3) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }
                        if (date('D', strtotime(date('Y-m-1'))) == 'Sun') {
                            if ($i == 1) {
                                echo '<tr>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                echo '<td></td>';
                                $d++;$d++;$d++;$d++;$d++;$d++;
                            }
                            if ($i == 2) {
                                echo '</tr>';
                                echo '<tr>';
                            }
                        }

                        if($i < 10) {
                            $echo = 1;
                            foreach ($seanse as $dayseans) {
                                if ($dayseans['date'] == date('Y-m-0'.$i)) {
                                    echo '<td class="seans"><a href="repertuar.php?day='.date('Y-m-0'.$i).'">'.$i.'</a></td>';
                                    $echo = 0;
                                    break;
                                }
                            }
                            if ($echo == 1) {
                                if (date('Y-m-d') == date('Y-m-0'.$i)) {
                                    echo '<td class="today"><a href="repertuar.php?day='.date('Y-m-0'.$i).'">'.$i.'</a></td>';
                                    /*break;*/
                                } else {
                                    echo '<td><a href="repertuar.php?day='.date('Y-m-0'.$i).'">'.$i.'</a></td>';
                                    /*break;*/
                                }
                            }
                        } else {
                            $echo = 1;
                            foreach ($seanse as $dayseans) {
                                if (date('Y-m-'.$i) == $dayseans['date']) {
                                    echo '<td class="seans"><a href="repertuar.php?day='.date('Y-m-'.$i).'">'.$i.'</a></td>';
                                    $echo = 0;
                                    break;
                                }
                            }
                            if ($echo == 1) {
                                if (date('Y-m-d') == date('Y-m-'.$i)) {
                                    echo '<td class="today"><a href="repertuar.php?day='.date('Y-m-'.$i).'">'.$i.'</a></td>';
                                    /*break;**/
                                } else {
                                    echo '<td><a href="repertuar.php?day='.date('Y-m-'.$i).'">'.$i.'</a></td>';
                                    /*break;*/
                                }
                            }
                        }

                        if ($d % 7 == 0) {
                            echo '</tr>';
                            echo '<tr>';
                        }
                        $d++;
                    }
                }
                ?>
            </tbody>
        </table>
        <?php
            }
        ?>
        <!-- <div class="seans">
            <img src="./img/plakaty/matrix.png" alt="matrix">
            <div class="details">
                <h2>Matrix</h2>
                <p>Data: <?php echo date('d-m-Y'); ?></p>
                <p>Godzina: <?php echo date('H:i'); ?></p>
            </div>
        </div> -->
    </div>
</main>
<?php
    require_once './footer.php';
?>
<script src="./js/buy-ticket.js"></script>
</body>
</html>