<?php
session_start();
require_once ('includes/common.php');
require_once (APP_DIR . 'includes/functions.php');
unset($_SESSION['status']);
$_SESSION = array();
session_destroy();

redirect_to();
