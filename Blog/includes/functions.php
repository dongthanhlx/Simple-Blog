<?php
include_once ('mysqli_connect.php');
function confirm_query($result, $query)
{
    global $dbc;
    if (!$result) {
        die("Query {$query} \n<br/> MySQL Error: " . mysqli_error($dbc));
    }
}

function redirect_to($page = 'index.php') {
    $url = APP_DIR . $page;
    header("Location: $url");
    exit();
}

function isAdmin() {
    return isset($_SESSION['status']);
}
