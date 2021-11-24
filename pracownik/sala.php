<?php
    session_start();
    if (!isset($_SESSION['logged']) || $_SESSION['logged'] != true || !isset($_SESSION['admin']) || $_SESSION['admin'] == '') {
        header('Location: ./index.php');
        exit();
    }

    require_once '../db_config.php';
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "SELECT `nr_sali`, `pojemnosc` FROM `sale` WHERE nr_sali = ?";
        $stmt = $mysql->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $sala = $result->fetch_assoc();
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
                <?php
                    if (isset($_GET['id'])) {
                        echo '<h2>Edytuj salę</h2>';
                    } else {
                        echo '<h2>Dodaj nową salę</h2>';
                    }
                ?>
            <form action="./save_sala.php" method="post" enctype="multipart/form-data" class="box">
                    <input type="hidden" name="id" value="<?php if (isset($_GET['id'])) { echo $id; } else { echo ''; } ?>">

                    <label for="pojemnosc">Pojemność <span class="required"><sup>*</sup></span></label>
                    <input type="number" name="pojemnosc" id="pojemnosc" value="<?php if (isset($_GET['id'])) { echo $sala['pojemnosc']; } else { echo ''; } ?>">

                        <?php
                        if (isset($_GET['id'])) {
                            echo '<input type="submit" value="Edytuj salę" class="btn">';
                        } else {
                            echo '<input type="submit" value="Dodaj salę" class="btn">';
                        }
                    ?>
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
        </div>
    </div>
</main>
<?php
    /*require_once '../footer.php';*/
?>
</body>
</html>