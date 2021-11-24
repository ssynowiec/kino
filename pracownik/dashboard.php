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
        <h1>Panel pracownika</h1>
        <h2>Witaj <?php echo $_SESSION['admin']; ?>!</h2>
        <a href="./films.php" class="btn">Filmy</a>
        <a href="./film.php" class="btn">Dodaj film</a>
        <a href="./seanse.php" class="btn">Seanse</a>
        <a href="./seans.php" class="btn">Dodaj seans</a>
        <a href="./rezerwacje.php" class="btn">Rezerwacje</a>
        <a href="./sale.php" class="btn">Sale</a>
        <a href="./sala.php" class="btn">Dodaj salę</a>
    </div>
</main>
<?php
    /*require_once '../footer.php';*/
?>
</body>
</html>