<?php
session_start();
require_once 'includes/common.php';

$title = "Login";
$set_src_image = APP_DIR . "images/logoTheFullSnack.jpg";

include(APP_DIR . 'includes/head.php');
include(APP_DIR . 'includes/icon.php');
include(APP_DIR . 'includes/forms/login_form.php');
include(APP_DIR . 'includes/footer.php');
