<?php
    session_start();
    if (!isset($_SESSION['places']) || $_SESSION['places'] == '') {
         header('Location: buy-ticket.php');
         exit();
    }

    print_r($_SESSION['places']);
    require_once './db_config.php';

    if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) {
        $sql = "SELECT * FROM klienci WHERE `login` = ?";
        $stmt = mysqli_prepare($mysql, $sql);
        $stmt->bind_param('s', $_SESSION['user']);
        $stmt->execute();
        $result = $stmt->get_result();
        $dane = $result->fetch_assoc();
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
        <h1>Twoje dane</h1>
            <form action="./save-user-datae.php" method="post" class="form">
                <div class="box left">
                    <label for="name">Imię: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="first-name" id="name" placeholder="Jan" required value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['imie']; } ?>">
                    <label for="last-name">Nazwisko: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="last-name" id="last-name" placeholder="Kowalski" required value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['nazwisko']; } ?>">
                    <label for="email">Adres email: <span class="required"><sup>*</sup></span></label>
                    <input type="email" name="email" id="email" placeholder="jan@example.pl" required value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['mail']; } ?>">
                    <label for="adress">Adres: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="adress" id="adress" placeholder="Warszawska 52" required value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['adres']; } ?>">
                    <label for="postal-code">Kod pocztowy: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="postal-code" id="postal-code" placeholder="98-400" required pattern="^[0-9]{2}-[0-9]{3}$" value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['kod_pocztowy']; } ?>">
                    <label for="city">Miejscowość: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="city" id="city" placeholder="Wieruszów" required value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['miejscowosc']; } ?>">
                    <label for="tel">Numer telefonu: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="tel" id="tel" placeholder="123456789" required value="<?php if(isset($_SESSION['logged']) && $_SESSION['logged'] != false) { echo $dane['nr_telefonu']; } ?>">
                </div>
                <div class="box right">
                    <label for="reulamin">Akceptuję regulamin</label>
                    <input type="checkbox" name="regulamin" id="regulamin" required>
                    <input type="submit" value="Kontynuuj" class="btn">
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