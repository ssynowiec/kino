<?php
    session_start();
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
    require_once './db_config.php';
?>
    <header>
        <div class="hero">
            <div class="container">
                <h1 class="hero-title">Kino najbliżej ciebie!</h1>
                <p class="hero-text">Najlepsze wrażenia z najlepszych filmów</p>
                <a href="repertuar.php" class="btn">Sprawdź repertuar</a>
                <div class="next-section">
                    <p class="incentive">Poznaj moc filmowych emocji</p>
                    <a href="#today" aria-label="next section">
                        <img src="./img/icons/arrow-down.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="today" id="today">
            <div class="container">
                <h2 class="section-title">Dzisiaj gramy:</h2>
                <div class="films-wrapper">
                <?php
                    $sql = "SELECT DISTINCT f.plakat, f.tytul FROM `seanse` s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE `date` = CURDATE() LIMIT 3";
                    $result = $mysql->query($sql);
                    if (mysqli_num_rows($result) > 0) {
                        while ($film = mysqli_fetch_assoc($result)) {
                ?>
                        <div class="film">
                            <img src="<?php echo $film['plakat'] ?>" alt="<?php echo $film['tytul']?> plakat" class="poster">
                            <div class="screening-hour">
                                <?php
                                    $sql = "SELECT `time` FROM seanse s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE tytul = ?";
                                    $stmt = $mysql->prepare($sql);
                                    $stmt->bind_param("s", $film['tytul']);
                                    $stmt->execute();
                                    $hours = $stmt->get_result();
                                    if ($hours->num_rows > 0) {
                                        while ($hour = $hours->fetch_assoc()) {
                                ?>
                                <p><a href="./buy-ticket.php?film=<?php echo $film['tytul']?>&hour=<?php echo $hour['time']?>" title="Kup bilet na tą godzinę"><?php echo date('H', strtotime($hour['time'])) ?><sup><?php echo date('i', strtotime($hour['time'])) ?></sup></a></p>
                                <?php
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                <?php
                        }
                    } else {
                        echo '<p>Brak seansów na dzisiaj</p>';
                    }
                ?></div>
                <a href="repertuar.php" class="btn" title="Zobacz pełny repertuar">Zobacz więcej</a>
            </div>
        </section>
        <section class="premieres" id="premieres">
            <div class="container">
                <h2 class="section-title">Nadchodzące premiery:</h2>
        <?php
            $today = date('Y-m-d');
            $sql = "SELECT * FROM filmy WHERE `premiera` >= '$today' ORDER BY `idFilmu` DESC LIMIT 1";
            $result = $mysql->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $film = mysqli_fetch_assoc($result);
        ?>
                <div class="new">
                    <img src="<?php echo $film['plakat'] ?>" alt="<?php echo $film['tytul']?> plakat" class="premiere-poster">
                    <div class="premiere-description">
                        <h3 class="premiere-title"><?php echo $film['tytul']?></h3>
                        <p class="premiere-date"><?php echo $film['premiera']?></p>
                        <p>Producent: <span class="bold"><?php echo $film['producent']?></span></p>
                        <p>Czas trwania: <span class="bold"><?php echo $film['czas_trwania']?></span></p>
                        <p>Opis: <span class=""><?php echo $film['opis']?></span></p>
                    </div>
                </div>
        <?php
        } else {
            echo '<p>Brak nadchodzącyh premier</p>';
        }
        ?>
        </div>
        </section>
    </main>
<?php
    require_once './footer.php';
?>
</body>

</html>