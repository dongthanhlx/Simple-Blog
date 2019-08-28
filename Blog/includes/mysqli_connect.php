<?php
require_once ('functions.php');
require_once (APP_DIR . 'app/configuration.php');

$config = new configuration();
$dbc = mysqli_connect($config->getDBHost(), $config->getDBUser(), $config->getDBPassword(), $config->getDBName(), $config->getDBPort());

if (!$dbc) {
    trigger_error('Could not connect to DB: ' . mysqli_connect_error());
} else {
    $dbc->set_charset("utf8");
}
