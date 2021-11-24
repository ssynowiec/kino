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
?>
<main>
    <div class="container register-container" style="padding-top: 150px;">
        <h1>Zarejestruj się</h1>
            <form action="./register-script.php" method="post" class="form">
                <div class="box left">
                    <h2>Twoje dane</h2>
                    <label for="name">Imię: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="first-name" id="name" placeholder="Jan" required>
                    <label for="last-name">Nazwisko: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="last-name" id="last-name" placeholder="Kowalski" required>
                    <label for="email">Adres email: <span class="required"><sup>*</sup></span></label>
                    <input type="email" name="email" id="email" placeholder="jan@example.pl" required>
                    <label for="adress">Adres: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="adress" id="adress" placeholder="Warszawska 52" required>
                    <label for="postal-code">Kod pocztowy: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="postal-code" id="postal-code" placeholder="98-400" required pattern="^[0-9]{2}-[0-9]{3}$">
                    <label for="city">Miejscowość: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="city" id="city" placeholder="Wieruszów" required>
                    <label for="tel">Numer telefonu: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="tel" id="tel" placeholder="123456789" required>
                </div>
                <div class="box right">
                    <h2>Dane logowania</h2>
                    <label for="login">Login: <span class="required"><sup>*</sup></span></label>
                    <input type="text" name="login" id="login" placeholder="janek" required>
                    <label for="password">Hasło: <span class="required"><sup>*</sup></span></label>
                    <input type="password" name="password" id="password" placeholder="**********" required>
                    <label for="reapet-password">Powtórz hasło: <span class="required"><sup>*</sup></span></label>
                    <input type="password" name="reapet-password" id="reapet-password" placeholder="**********" required>
                    <label for="regulamin">Akceptuję regulamin <span class="required"><sup>*</sup></span></label>
                    <input type="checkbox" name="regulamin" id="regulamin" required>
                    <input type="submit" value="Zarejestruj się" class="btn">
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