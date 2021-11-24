<?php
    session_start();
    if (!isset($_SESSION['finish']) || $_SESSION['finish'] === false) {
        header('Location: buy-ticket.php');
        exit();
    } else {
        $_SESSION['finish'] = '';
        unset($_SESSION['finish']);
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
        <h1>Dziękujemy za rezerwację i zaufanie</h1>
        <h3>Życzymy miłego seansu!</h3>
        </table>
        <a href="./" class="btn">Wróć na stronę główną</a>
    </div>
</main>
<?php
    require_once './footer.php';
?>
</body>
</html>