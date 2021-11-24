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
        <h1>Filmy</h1>
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
                <th>Tytuł</th>
                <th>Producent</th>
                <th>Premiera</th>
                <th>Reżyser</th>
                <th>Czas trwania</th>
                <th>Opis</th>
                <th>Gatunek</th>
                <th>Edytuj</th>
                <th>Usuń</th>
            </thead>
            <tbody>
        <?php
            require_once '../db_config.php';
            $sql = "SELECT `idFilmu`, `tytul`, `producent`, `premiera`, `rezyser`, `czas_trwania`, `plakat`, `opis`, nazwa as 'gatunek' FROM filmy f INNER JOIN gatunki g ON f.Gatunki_idGatunku = g.idGatunku";
            $result = $mysql->query($sql);
            if ($result->num_rows > 0) {
                while ($film = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$film['tytul']."</td>
                        <td>".$film['producent']."</td>
                        <td>".$film['premiera']."</td>
                        <td>".$film['rezyser']."</td>
                        <td>".$film['czas_trwania']."</td>
                        <td>".$film['opis']."</td>
                        <td>".$film['gatunek']."</td>
                        <td><a href='./film.php?id=".$film['idFilmu']."'>Edytuj</a></td>
                        <td><a href='./delete_film.php?id=".$film['idFilmu']."'>Usuń</a></td>
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