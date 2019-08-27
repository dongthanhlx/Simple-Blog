<?php
    require_once (APP_DIR . '/includes/mysqli_connect.php');
    require_once (APP_DIR . '/includes/functions.php');
    function get_post_by_id($post_id) {
        global $dbc;
        $query = "
            SELECT *
            FROM posts 
        " . (!empty($post_id) ? "WHERE post_id = {$post_id}" : '');

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function insert_post($post_name, $content, $post_date, $topic_id, $user_id, $status) {
        global $dbc;
        $query = "
            INSERT INTO posts (post_name, content, post_date, topic_id, user_id, status)
            VALUES ('$post_name', '$content', '$post_date', '$topic_id', '$user_id', '$status')
        ";

        $result = mysqli_query($dbc,$query);
        confirm_query($result, $query);

        return 1;
    }

    function get_post_by_topic_id($topic_id) {
        global $dbc;
        $query = "
            SELECT *
            FROM posts
            WHERE topic_id = '$topic_id'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function delete_post($post_id) {
        global $dbc;
        $query = "
            DELETE FROM posts
            WHERE post_id = '$post_id'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function update_post($post_id, $post_name, $content, $post_date, $topic_id) {
        global $dbc;
        $query = "
            UPDATE posts
            SET post_name = '$post_name', content = '$content', post_date = '$post_date', topic_id = '$topic_id'
            WHERE post_id = '$post_id'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }

    function approved($post_id) {
        global $dbc;
        $query = "
            UPDATE posts
            SET status = 'approved'
            WHERE post_id = '$post_id'
        ";

        $result = mysqli_query($dbc, $query);
        confirm_query($result, $query);

        return $result;
    }