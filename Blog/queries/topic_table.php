<?php
    require_once (APP_DIR . '/includes/mysqli_connect.php');
    require_once (APP_DIR . '/includes/functions.php');

    function get_topic_by_id($topic_id) {
        global $dbc;
        $query = "
            SELECT *
            FROM topics 
        " . (!empty($topic_id) ? "WHERE topic_id = {$topic_id}" : '');

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function insert_topic($topic_name) {
        global $dbc;
        $query = "
            INSERT INTO topics (topic_name) VALUE ('$topic_name')
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);
    }

    function check_topic_name($topic_name) {
        global $dbc;
        $query = "
            SELECT *
            FROM topics
            WHERE topic_name = '{$topic_name}'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function delete_topic_by_user_id($user_id) {
        global $dbc;
        $query = "
            DELETE FROM topics
            WHERE user_id = '$user_id'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

