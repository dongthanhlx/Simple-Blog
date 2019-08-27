<?php

require_once(APP_DIR . '/includes/functions.php');

function get_admin()
{
    global $dbc;
    $query = "
            SELECT *
            FROM users
            WHERE position = 'admin'
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
            FROM users
            WHERE email = '$email' AND password = '$password'
        ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}

function add_user($name, $description, $email, $password, $avatar) {
    global $dbc;
    $query = "
        INSERT INTO users (name, description, email, password, avatar, position)
        VALUES ('$name', '$description', '$email', '$password', '$avatar', 'user')
    ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}

function check_email($email) {
    global $dbc;
    $query = "
        SELECT id
        FROM users
        WHERE email = '$email'
    ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}

function get_user() {
    global $dbc;
    $query = "
        SELECT *
        FROM users
    ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}