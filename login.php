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
    <div class="container" style="padding-top: 150px; text-align: center;">
        <h1>Mój bilet</h1>
        <div class="form">
            <div class="box left">
            <h2>Zaloguj się</h2>
            <form action="./login-script.php" method="post" class="box">
                <label for="login">Login: </label>
                <input type="text" name="login" id="login" required placeholder="Twój login">
                <label for="password">Hasło: </label>
                <input type="password" name="password" id="password" required placeholder="**********">
                <input type="submit" value="Zaloguj się" class="btn">
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
        <div class="box right">
            <h2>Nie masz konta?</h2>
            <a href="register.php" class="btn">Zarejestruj się</a>
        </div>
        </div>
    </div>
</main>
<?php
    require_once './footer.php';
?>
</body>
</html>