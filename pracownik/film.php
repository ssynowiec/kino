<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        header('Location: ./index.php');
        exit();
    }

    require_once '../db_config.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT `idFilmu`, `tytul`, `producent`, `premiera`, `rezyser`, `czas_trwania`, `plakat`, `opis`, nazwa as 'gatunek', `Gatunki_idGatunku` FROM filmy f INNER JOIN gatunki g ON f.Gatunki_idGatunku = g.idGatunku WHERE idFilmu = ?";
        $stmt = $mysql->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $film = $result->fetch_assoc();
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
                        echo '<h2>Edytuj film</h2>';
                    } else {
                        echo '<h2>Dodaj nowy film</h2>';
                    }
                ?>
            <form action="./save_film.php" method="post" enctype="multipart/form-data" class="box">
                    <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) { echo $id; } else { echo ''; } ?>">
                    <label for="title">Tytuł filmu <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="title" id="title" value="<?php if (isset($_GET['id'])) { echo $film['tytul']; } else { echo ''; } ?>">

                    <?php
                        $sql = "SELECT * FROM gatunki";
                        $stmt = $mysql->prepare($sql);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result->num_rows > 0) {
                    ?>
                    <label for="gatunek">Gatunek</label>
                    <select name="gatunek" id="gatunek">
                        echo '<option value="0">Wybierz gatunek</option>';
                        <?php
                            while ($gatunek = $result->fetch_assoc()) {
                                if (isset($_GET['id']) && ($gatunek['idGatunku'] == $film['Gatunki_idGatunku'])) {
                                    echo '<option value="'.$gatunek['idGatunku'].'" selected>'.$gatunek['nazwa'].'</option>';
                                } else {
                                    echo '<option value="'.$gatunek['idGatunku'].'">'.$gatunek['nazwa'].'</option>';
                                }
                            }
                        ?>
                    </select>
                    <?php
                        }
                    ?>

                    <label for="producent">Producent <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="producent" id="producent" value="<?php if (isset($_GET['id'])) { echo $film['producent']; } else { echo ''; } ?>">

                    <label for="premiera">Data premiery <span class="required"><sup>*</sup></span></label>
                    <input type="date" name="premiera" id="premiera" value="<?php if (isset($_GET['id'])) { echo $film['premiera']; } else { echo ''; } ?>">

                    <label for="rezyser">Reżyser <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="rezyser" id="rezyser" value="<?php if (isset($_GET['id'])) { echo $film['rezyser']; } else { echo ''; } ?>">

                    <label for="time">Czas trwania <span class="required"><sup>*</sup></span></label>
                    <input type="time" name="time" id="time" value="<?php if (isset($_GET['id'])) { echo $film['czas_trwania']; } else { echo ''; } ?>">

                    <label for="poster">Plakat <span class="required"><sup>*</sup></span></label>
                    <input type="file" name="poster" id="poster" accept="image/png, image/jpeg" value="<?php if (isset($_GET['id'])) { echo $film['plakat']; } else { echo ''; } ?>">

                    <label for="description">Opis <span class="required"><sup>*</sup></span></label>
                    <textarea name="description" id="description" cols="30" rows="10"><?php if (isset($_GET['id'])) { echo $film['opis']; } else { echo ''; } ?></textarea>


                    <?php
                        if (isset($_GET['id'])) {
                            echo '<input type="submit" value="Edytuj film" class="btn">';
                        } else {
                            echo '<input type="submit" value="Dodaj film" class="btn">';
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