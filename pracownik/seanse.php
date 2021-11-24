<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        header('Location: ./index.php');
        exit();
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
        <h1>Seanse</h1>
        <?php
            if (isset($_SESSION['error'])) {
                echo '<div class="error">';
                echo '<p>'.$_SESSION['error'].'</p>';
                unset($_SESSION['error']);
                echo '</div>';
            }

            if (isset($_SESSION['success'])) {
                echo '<div class="success">';
                echo '<p>'.$_SESSION['success'].'</p>';
                unset($_SESSION['success']);
                echo '</div>';
            }
        ?>
        <table class="admin">
            <thead>
                <th>Film</th>
                <th>Nr. Sali</th>
                <th>Data</th>
                <th>Godzina</th>
                <th>Edytuj</th>
                <th>Usuń</th>
            </thead>
            <tbody>
        <?php
            require_once '../db_config.php';
            $sql = "SELECT `idSeansu`, f.tytul as 'film', `Sale_nr_sali`, `date`, `time` FROM `seanse` s INNER JOIN filmy f ON s.Filmy_idFilmu = f.idFilmu";
            $result = $mysql->query($sql);
            if ($result->num_rows > 0) {
                while ($seans = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$seans['film']."</td>
                        <td>".$seans['Sale_nr_sali']."</td>
                        <td>".$seans['date']."</td>
                        <td>".$seans['time']."</td>
                        <td><a href='./seans.php?id=".$seans['idSeansu']."'>Edytuj</a></td>
                        <td><a href='./delete_seans.php?id=".$seans['idSeansu']."'>Usuń</a></td>
                    </tr>";
                }
            }
        ?>
            </tbody>
        </table>
    </div>
</main>
<?php
    /*require_once '../footer.php';*/
?>
</body>
</html>