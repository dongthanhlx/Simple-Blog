<?php
require_once (APP_DIR . 'queries/comment_table.php');
if(isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $page_id = $_GET['pid'];
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    echo '
        <script>
            document.getElementById("comment-form").style.display = \'block\';
        </script>
    ';
    $errors = array();
    if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = mysqli_real_escape_string($dbc, strip_tags($_POST['email']));
    } else {
        $errors[] = 'email';
    }

    if (!empty($_POST['comment'])) {
        $comment = mysqli_real_escape_string($dbc, strip_tags($_POST['comment']));
    } else {
        $errors[] = 'comment';
    }

    if (!empty($errors)) {
        $message = "<p class='warning'>Điền đầy đủ các trường</p>";
    } else {
        insert_comment($email, $comment, date("Y-m-d H:i:s"), $page_id);
        $message = "<p class='success'>Comment của bạn đã được thêm thành công</p>";
    }
}
?>
<div id="add-comment">
    <p>Bạn nghĩ như thế nào về bài viết này?</p>
    <button onclick="joinComment()">Tham gia bình luận</button>
    <form action='' method='post' id="comment-form">
        <fieldset>
            <legend>Comment</legend>
            <?php if (!empty($message)) echo $message; ?>
            <div class="email">
                <input type="text" class="input" name="email" placeholder="Email gõ vào đây"/>
                <?php
                if (!empty($errors) && in_array('email', $errors)) {
                    echo "<p class='warning'>Email bạn nhập không đúng</p>";
                }
                ?>
            </div>
            <div class="comment">
                <input placeholder="Comment gõ vào đây" name="comment" />
                <?php
                if (!empty($errors) && in_array('comment', $errors)) {
                    echo "<p class='warning'>Hãy viết comment</p>";
                }
                ?>
            </div>
            <button type="submit" name="submit">Submit</button>
        </fieldset>
    </form>
</div>

