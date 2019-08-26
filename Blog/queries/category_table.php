<?php
    require_once (APP_DIR . '/includes/mysqli_connect.php');
    require_once (APP_DIR . '/includes/functions.php');
    function get_category() {
        global $dbc;
        $query = "
            SELECT *
            FROM categories
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function insert_category($link, $cat_name) {
        global $dbc;
        $query = "
            INSERT INTO categories (link, cat_name)
            VALUES ('$link', '$cat_name')
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);
    }
?>