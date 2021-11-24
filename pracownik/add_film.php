<?php
    session_start();
    if (isset($_SESSION['logged']) && $_SESSION['logged'] != true || isset($_SESSION['admin']) && $_SESSION['admin'] == '') {
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
        <div class="form">
            <div class="box">
                <h2>Dodaj nowy film</h2>
            <form action="./save_film.php" method="post" class="box">
                    <label for="title">Tytuł filmu</label>
                    <input type="text" name="title" id="title">

                    <?php /*TODO: SELECT gatunki*/ ?>

                    <label for="producent">Producent</label>
                    <input type="text" name="producent" id="producent">

                    <label for="premiera">Data premiery</label>
                    <input type="date" name="premiera" id="premiera">

                    <label for="rezyser">Reżyser</label>
                    <input type="text" name="rezyser" id="rezyser">

                    <label for="time">Czas trwania</label>
                    <input type="time" name="time" id="time">

                    <label for="poster">Plakat</label>
                    <input type="file" name="poster" id="poster">

                    <label for="description">Opis</label>
                    <textarea name="description" id="description" cols="30" rows="10"></textarea>

                    <input type="submit" value="Dodaj film" class="btn">
                </form>
            </div>
        </div>
    </div>
</main>
<?php
    /*require_once '../footer.php';*/
?>
</body>
</html>