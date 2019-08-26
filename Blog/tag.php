<?php
session_start();

require_once './includes/common.php';
require_once ('queries/post_table.php');
require_once ('queries/tag_table.php');

$title = "Tag";
include (APP_DIR . '/includes/head.php');
include (APP_DIR . '/includes/icon.php');

if (isset($_GET['tid']) && filter_var($_GET['tid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $tag_id = $_GET['tid'];
    $tag = mysqli_fetch_array(get_tag_by_id($tag_id), MYSQLI_ASSOC);
    $tag_name = $tag['tag_name'];
    echo "<div id='tag'>";
        echo "<h1>Tag: {$tag_name}</h1>";
        $posts = get_post_by_tag_id($tag_id);
        include ('includes/posts.php');
    echo "</div>";
}

include ('includes/footer.php');