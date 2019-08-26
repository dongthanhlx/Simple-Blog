<?php
session_start();

require_once ('includes/common.php');
require_once(APP_DIR . 'queries/post_table.php');
require_once(APP_DIR . 'queries/tag_table.php');
require_once(APP_DIR . 'queries/comment_table.php');
require_once (APP_DIR . 'includes/functions.php');

$title = "Post";
include(APP_DIR . 'includes/head.php');
include(APP_DIR . 'includes/icon.php');

if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $post_id = $_GET['pid'];
    $posts = get_post_by_id($post_id);
} else {
    redirect_to();
}

if (mysqli_num_rows($posts) == 0) {
    redirect_to();
} else {
    $post = mysqli_fetch_array($posts, MYSQLI_ASSOC);
    $post_name = $post['post_name'];
    $content = $post['content'];
    $tag_id = $post['tag_id'];
    $tag = mysqli_fetch_array(get_tag_by_id($tag_id), MYSQLI_ASSOC);
    $tag_name = $tag['tag_name'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {
        redirect_to(APP_DIR . 'admin/edit/edit_post.php?pid=' . $post_id);
    }

    if (isset($_POST['radio']) && $_POST['radio'] == 'yes') {
        if (delete_post($post_id) == 1) {
            redirect_to();
        }
    }
}

?>

<article id="post">

    <h1><?php echo "$post_name"; ?></h1>

        <?php

        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
            echo "
                <ul class='admin'>
                    <form action=\"\" method=\"post\">
                        <li><button name=\"edit\" type=\"submit\">Edit</button></li>
                    </form> 
                    <li><button onclick='isDelete()'>Delete</button></li>
            </ul>
            ";
        }
        ?>


    <form action='' method='post' id="delete">
        <fieldset>
            <legend>Bạn có chắc chắn muốn xóa bài post này</legend>
            <input type='radio' name='radio' value='yes' />Có<br />
            <input type='radio' name='radio' value='no' checked />Không<br />
            <button type='submit'>Xác nhận</button>
        </fieldset>
    </form>

    <div id="content">
        <p><?php echo "$content"; ?></p>
    </div>

    <h3>Tags: <a class='tag' href='tag.php?tid=<?php echo $tag_id; ?>'><?php echo "$tag_name"; ?></a></h3>
    <div id="border"></div>
    <?php include ('includes/forms/comment_form.php'); ?>
    <div id="comments">
        <?php
        $comments = get_comments_by_page_id($post_id);
        if (mysqli_num_rows($comments) > 0) {
            while ($comment = mysqli_fetch_array($comments, MYSQLI_ASSOC)) {
                $email = $comment['email'];
                $content = stripslashes($comment['comment']);
                $comment_date = $comment['comment_date'];

                echo "<comment>";
                    echo "<div class='comment-info'><strong>$email</strong> lúc <time>$comment_date</time></div>";
                    echo "<p>$content</p>";
                echo "</comment>";
            }
        }
        ?>
    </div>
</article>

<?php
include ('includes/footer.php');
?>
