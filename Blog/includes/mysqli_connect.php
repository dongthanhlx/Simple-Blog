<?php
$dbc = mysqli_connect('localhost', 'root', '', 'Blog', 3307);

if (!$dbc) {
    trigger_error('Could not connect to DB: ' . mysqli_connect_error());
} else {
    $dbc->set_charset("utf8");
}

?>