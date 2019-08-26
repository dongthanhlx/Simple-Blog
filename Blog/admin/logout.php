<?php
require_once ('includes/common.php');
require_once (APP_DIR . 'includes/functions.php');
session_start();
$_SESSION = array();
session_destroy();

redirect_to();
