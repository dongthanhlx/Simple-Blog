<?php
require_once (APP_DIR . 'queries/post_table.php');
require_once (APP_DIR . 'queries/topic_table.php');
if (isset($_GET['pid']) && filter_var($_GET['pid'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
    $post_id = $_GET['pid'];
    $result_post = get_post_by_id($post_id);

    $post = mysqli_fetch_array($result_post, MYSQLI_ASSOC);
    $post_name = $post['post_name'];
    $content = $post['content'];
    $topic_id_of_post = $post['topic_id'];

    $all_topic = get_topic_by_id('');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $new_post_name = mysqli_real_escape_string($dbc, strip_tags($_POST['post_name']));
    $new_topic_id = $_POST['topic_id'];
    $new_content = mysqli_real_escape_string($dbc, $_POST['content']);

    $result = update_post($post_id, $new_post_name, $new_content, date('Y:m:d'), $new_topic_id);
    if ($result) {
        redirect_to('post.php?pid=' . $post_id);
    }
}
?>

<section id="edit-post">
    <form action="" method="post">
        <fieldset>
            <legend>Edit Post</legend>
            <div>
                <label>Post Name </label><!--
            --><input type="text" name="post_name" value="<?php echo $post_name; ?>"/><br />
            </div>

            <div>
                <label>Topic </label><!--
                --><select name="topic_id">
                    <?php
                    if (mysqli_num_rows($all_topic) > 0) {
                        while ($topic = mysqli_fetch_array($all_topic, MYSQLI_ASSOC)) {
                            $topic_id = $topic['topic_id'];
                            $topic_name = $topic['topic_name'];
                            ?>
                            <option value="<?php echo $topic_id;?>" <?php if ($topic_id == $topic_id_of_post) echo "selected";?> ><?php echo $topic_name;?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div>
                <label>Content </label><!--
                --><textarea type="text" name="content"><?php echo $content; ?></textarea>
            </div>
            <button type="submit" name="update">Cập nhật</button>
        </fieldset>
    </form>
</section>