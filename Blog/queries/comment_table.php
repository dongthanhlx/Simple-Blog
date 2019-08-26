<?php
require_once ('./includes/mysqli_connect.php');
require_once ('./includes/functions.php');
function get_comments_by_page_id($pid) {
    global $dbc;
    $query = "
        SELECT *
       FROM comments
       WHERE page_id = {$pid}
    ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);

    return $result;
}

function insert_comment($email, $comment, $comment_date, $page_id) {
    global $dbc;
    $query = "
        INSERT INTO comments (email, comment, comment_date, page_id)
        VALUES ('$email', '$comment', '$comment_date', '$page_id')
    ";

    $result = mysqli_query($dbc, $query);
    confirm_query($result, $query);
}


