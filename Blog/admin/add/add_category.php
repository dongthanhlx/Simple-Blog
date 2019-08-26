<?php
session_start();
require_once('common.php');

$title = "Add Category";
include (APP_DIR . 'includes/head.php');
include (APP_DIR . 'includes/forms/add_category_form.php');
include (APP_DIR . 'includes/footer.php');