<?php

require_once(APP_DIR . '/includes/functions.php');

function get_admin()
{
    global $dbc;
    $query = "
            SELECT *
            FROM admin
            WHERE id = 1
        ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}

function check_account($email, $password)
{
    global $dbc;
    $query = "
            SELECT id
            FROM admin
            WHERE email = '$email' AND password = '$password'
        ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}