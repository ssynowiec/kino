<?php
    session_start();

    if ((!isset($_POST['seans']) || $_POST['seans'] == '') && (!isset($_POST['place']) || $_POST['place'] == '')) {
        header('Location: buy-ticket.php');
        exit();
    } else {
        $_SESSION['places'] = $_POST['place'];
        $_SESSION['seans'] = $_POST['seans'];
        $_SESSION['ticket'] = $_POST['ticket'];
    }

    if (isset($_SESSION['logged']) && isset($_SESSION['user']) && $_SESSION['user'] != '') {
        header('Location: your-data.php');
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
            <a href="./your-data.php" class="btn">Kontynuuj jako gość</a>
        </div>
        <div class="box">
        <h2>Lub</h2>
        </div>
        <div class="box right">
            <a href="login.php" class="btn">Zaloguj się</a>
        </div>
        </div>
    </div>
</main>
<?php
    require_once './footer.php';
?>
</body>
</html>