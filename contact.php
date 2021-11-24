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
    require_once './db_config.php';
?>

    <main>
        <form action="" method="post">
            <div class="box">aa</div>
            <div class="box">aa</div>
        </form>
    </main>
<?php
    require_once './footer.php';
?>
</body>

</html>