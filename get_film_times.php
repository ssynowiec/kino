<?php
    require_once './db_config.php';
    $sql = "SELECT `time` FROM seanse WHERE Filmy_idFilmu = '".$_GET['film']."' AND `date` = '".$_GET['date']."'";
    echo $sql;
    $result = mysqli_query($mysql, $sql);

    $times = '<option value="">godzina</option>';

    while ($time = mysqli_fetch_assoc($result)) {
        $times .= '<option value="'.$time['time'].'">'.$time['time'].'</option>';
    }

    echo $times;
?>