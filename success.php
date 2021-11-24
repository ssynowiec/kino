<?php
    session_start();
    if (!isset($_SESSION['success']) || $_SESSION['success'] != true) {
        unset($_SESSION['success']);
        header('Location: register.php');
        exit();
    } else {
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
    <h1>Dziękujemy za rejestrację!</h1>
</main>
<?php
    require_once './footer.php';
?>
</body>
</html>

<?php
    unset($_SESSION['success']);
    }
?>