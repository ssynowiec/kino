<?php
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'kino';

    $mysql = mysqli_connect($host, $username, $password, $db_name);
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
?>