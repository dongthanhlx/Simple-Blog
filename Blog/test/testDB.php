<?php
$json = file_get_contents('./../app/config.json');
$json_data = json_decode($json, true);

$param_mysqli = $json_data['mysqli_connect'];

$dbc = mysqli_connect($param_mysqli);

echo $dbc;