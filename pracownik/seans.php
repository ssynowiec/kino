<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        header('Location: ./index.php');
        exit();
    }

    require_once '../db_config.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT `idSeansu`, Filmy_idFilmu, f.tytul as 'film', `Sale_nr_sali`, `date`, `time` FROM `seanse` s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu WHERE idSeansu = ?";
        $stmt = $mysql->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $seans = $result->fetch_assoc();
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
        require_once '../metatags.html';
    ?>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<?php
    require_once './nav.php';
?>
<main>
    <div class="container" style="padding-top: 150px; text-align: center;">
        <h1>Panel pracownika</h1>
        <div class="form">
            <div class="box">
                <?php
                    if (isset($_GET['id'])) {
                        echo '<h2>Edytuj seans</h2>';
                    } else {
                        echo '<h2>Dodaj nowy seans</h2>';
                    }
                ?>
            <form action="./save_seans.php" method="post" enctype="multipart/form-data" class="box">
                    <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) { echo $id; } else { echo ''; } ?>">
                    
                    <?php
                        $sql = "SELECT * FROM filmy";
                        $stmt = $mysql->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                    ?>
                    <label for="film">Film <span class="required"><sup>*</sup></span></label>
                    <select name="film" id="film">
                        echo '<option value="0">Wybierz film</option>';
                        <?php
                            while ($film = $result->fetch_assoc()) {
                                if (isset($_GET['id']) && ($film['idFilmu'] == $seans['Filmy_idFilmu'])) {
                                    echo '<option value="'.$film['idFilmu'].'" selected>'.$film['tytul'].'</option>';
                                } else {
                                    echo '<option value="'.$film['idFilmu'].'">'.$film['tytul'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <?php
                        }
                    ?>

                    <?php
                        $sql = "SELECT * FROM sale";
                        $stmt = $mysql->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                    ?>
                    <label for="sala">Sala <span class="required"><sup>*</sup></span></label>
                    <select name="sala" id="sala">
                        echo '<option value="0">Wybierz film</option>';
                        <?php
                            while ($sala = $result->fetch_assoc()) {
                                if (isset($_GET['id']) && ($sala['nr_sali'] == $seans['Sale_nr_sali'])) {
                                    echo '<option value="'.$sala['nr_sali'].'" selected>'.$sala['nr_sali'].' ('.$sala['pojemnosc'].')</option>';
                                } else {
                                    echo '<option value="'.$sala['nr_sali'].'">'.$sala['nr_sali'].' ('.$sala['pojemnosc'].')</option>';
                                }
                            }
                        ?>
                    </select>
                    <?php
                        }
                    ?>

                    <label for="date">Data seansu <span class="required"><sup>*</sup></span></label>
                    <input type="date" name="date" id="date" value="<?php if (isset($_GET['id'])) { echo $seans['date']; } else { echo ''; } ?>">

                    <label for="time">Godzina senasu <span class="required"><sup>*</sup></span></label>
                    <input type="time" name="time" id="time" value="<?php if (isset($_GET['id'])) { echo $seans['time']; } else { echo ''; } ?>">

                    <?php
                        if (isset($_GET['id'])) {
                            echo '<input type="submit" value="Edytuj seans" class="btn">';
                        } else {
                            echo '<input type="submit" value="Dodaj seans" class="btn">';
                        }
                    ?>
                </form>
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="error">';
                    echo '<p>'.$_SESSION['error'].'</p>';
                    unset($_SESSION['error']);
                    echo '</div>';
                }
            ?>
            </div>
        </div>
    </div>
</main>
<?php
    /*require_once '../footer.php';*/
?>
</body>
</html>