<?php
    require_once (APP_DIR . '/includes/mysqli_connect.php');
    require_once (APP_DIR . '/includes/functions.php');

    function get_tag_by_id($tag_id) {
        global $dbc;
        $query = "
            SELECT *
            FROM tags 
        " . (!empty($tag_id) ? "WHERE tag_id = {$tag_id}" : '');

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function insert_tag($tag_name) {
        global $dbc;
        $query = "
            INSERT INTO tags (tag_name) VALUE ('$tag_name')
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);
    }

    function check_tag_name($tag_name) {
        global $dbc;
        $query = "
            SELECT *
            FROM tags
            WHERE tag_name = '{$tag_name}'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }


