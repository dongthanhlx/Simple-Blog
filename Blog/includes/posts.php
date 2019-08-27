<?php
    require_once(APP_DIR . '/queries/post_table.php');
    require_once(APP_DIR . '/queries/topic_table.php');
    require_once (APP_DIR . 'includes/functions.php');
    if (!isset($posts)) $posts = get_post_by_id('');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approved'])) {
        approved($_POST['approved']);
    } elseif (isset($_POST['not-approved'])) {
        delete_post($_POST['not-approved']);
    }
    redirect_to();
}
?>

<section id="posts">
    <?php
    if (mysqli_num_rows($posts) > 0) {
        while ($post = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
            $post_name = $post['post_name'];
            $post_date = $post['post_date'];
            $post_id = $post['post_id'];
            $status = $post['status'];

            $topic_id = $post['topic_id'];
            $topic = mysqli_fetch_array(get_topic_by_id($topic_id), MYSQLI_ASSOC);
            $topic_name = $topic['topic_name'];

            if (isAdmin()) {
                echo "<div class='post'>"
                    . "<time>{$post_date}</time> {$topic_name}"
                    . "<h3 class='post-name'><a href='post.php?pid={$post_id}'>$post_name</a></h3>";
                if ($status == 'not approved') {
                    echo "
                        <form action='' method='post' id='approved'>
                            <button type='submit' name='approved' value='$post_id'>Duyệt </button>
                            <button type='submit' name='not-approved' value='$post_id'>Xóa bài</button>
                        </form>
                    ";
                }
                echo "</div><!--End .post-->";
            } elseif ($status == 'approved') {
                echo "<div class='post'>"
                    . "<time>{$post_date}</time> {$topic_name}"
                    . "<h3 class='post-name'><a href='post.php?pid={$post_id}'>$post_name</a></h3>"
                    . "</div><!--End .post-->";
            }
        }
    }
    ?>
</section>
