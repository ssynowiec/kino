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
        <h1>Rezerwacje</h1>
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
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Film</th>
                <th>Sala</th>
                <th>Bilet</th>
                <th>Miejsce</th>
                <th>Rząd</th>
                <!-- <th>Edytuj</th> -->
                <th>Usuń</th>
            </thead>
            <tbody>
        <?php
            require_once '../db_config.php';
            $sql = "SELECT * FROM show_reservation";
            $result = $mysql->query($sql);
            if ($result->num_rows > 0) {
                while ($rezerwacja = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>".$rezerwacja['imie']."</td>
                        <td>".$rezerwacja['nazwisko']."</td>
                        <td>".$rezerwacja['tytul']."</td>
                        <td>".$rezerwacja['sala']."</td>
                        <td>".$rezerwacja['typ']."</td>
                        <td>".$rezerwacja['miejsce']."</td>
                        <td>".$rezerwacja['rzad']."</td>

                        <td><a href='./delete_reservation.php?id=".$rezerwacja['idRezerwacje']."'>Usuń</a></td>
                    </tr>";
                }
            }
            // <td><a href='./film.php?id=".$rezerwacja['idRezerwacje']."'>Edytuj</a></td>
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