<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] == false || !isset($_SESSION['user']) || $_SESSION['user'] == '') {
        $_SESSION['error'] == 'Musisz być zalogowany aby uzyskać dostęp do tej strony';
        header('Location: login.php');
        exit();
    } else {
        require_once './db_config.php';
        $sql = "SELECT * FROM klienci WHERE `login` = ?";
        $stmt = $mysql->prepare($sql);
        $stmt->bind_param('s', $_SESSION['user']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
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
?>
<main>
    <div class="container register-container" style="padding-top: 150px;">
        <h1>Moje dane</h1>
            <form action="./update-userData-script.php" method="post" class="form">
                <div class="box left">
                    <label for="name">Imię:</label>
                    <input type="text" name="first-name" id="name" placeholder="Jan" required value="<?php echo $row['imie'] ?>">
                    <label for="last-name">Nazwisko:</label>
                    <input type="text" name="last-name" id="last-name" placeholder="Kowalski" required value="<?php echo $row['nazwisko'] ?>">
                    <label for="email">Adres email:</label>
                    <input type="email" name="email" id="email" placeholder="jan@example.pl" required value="<?php echo $row['mail'] ?>">
                    <label for="adress">Adres:</label>
                    <input type="text" name="adress" id="adress" placeholder="Warszawska 52" required value="<?php echo $row['adres'] ?>">
                    <label for="postal-code">Kod pocztowy:</label>
                    <input type="text" name="postal-code" id="postal-code" placeholder="98-400" required pattern="[0-9]{2}-[0-9]{3}" value="<?php echo $row['kod_pocztowy'] ?>">
                    <label for="city">Miejscowość:</label>
                    <input type="text" name="city" id="city" placeholder="Wieruszów" required value="<?php echo $row['miejscowosc'] ?>">
                    <label for="tel">Numer telefonu:</label>
                    <input type="text" name="tel" id="tel" placeholder="123456789" required value="<?php echo $row['nr_telefonu'] ?>">
                </div>
                <div class="box right">
                    <label for="login">Login:</label>
                    <input type="text" name="login" id="login" placeholder="janek" required value="<?php echo $row['login'] ?>" readonly>
                    <label for="password">Hasło:</label>
                    <input type="password" name="password" id="password" placeholder="**********" required>
                    <label for="reapet-password">Powtórz hasło:</label>
                    <input type="password" name="reapet-password" id="reapet-password" placeholder="**********" required>
                    <label for="regulamin">Akceptuję regulamin</label>
                    <input type="submit" value="Zapisz zmiany" class="btn">
                </div>
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
</main>
<?php
    require_once './footer.php';
?>
</body>
</html>