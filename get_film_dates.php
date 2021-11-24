<?php
    require_once './db_config.php';
    $sql = "SELECT IdSeansu, `date`, `time` FROM seanse WHERE Filmy_idFilmu = '".$_GET['film']."'";
    $result = mysqli_query($mysql, $sql);

    $dates = '';
    $i = 0;

    while ($date = mysqli_fetch_assoc($result)) {
        $i++;
        $d_en = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        $d_pl = ['Pon', 'Wt', 'Śr', 'Czw', 'Pt', 'Sob', 'Nd'];
        $filmDate = str_replace($d_en, $d_pl, date('D',strtotime($date['date'])));
        $dates .= '<input type="radio" id='.$i.' name="seans" value="'.$date['IdSeansu'].'"></input><label for="'.$i.'">'.$date['date'].' ('.$filmDate.') '.$date['time'].'</label></br>';
    }

    echo $dates;
?>