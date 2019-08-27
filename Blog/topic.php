<?php
session_start();
require_once './includes/common.php';
require_once ('queries/post_table.php');
require_once('queries/topic_table.php');

$title = "Topics";
include (APP_DIR . '/includes/head.php');
include (APP_DIR . '/includes/icon.php');

if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $topic_id = $_GET['tid'];
    $topic = mysqli_fetch_array(get_topic_by_id($topic_id), MYSQLI_ASSOC);
    $topic_name = $topic['topic_name'];
    echo "<div id='topic'>";
        echo "<h1>Topic: {$topic_name}</h1>";
        $posts = get_post_by_topic_id($topic_id);
        include ('includes/posts.php');
    echo "</div>";
}

include ('includes/footer.php');