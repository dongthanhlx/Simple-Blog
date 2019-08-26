<?php
require_once (APP_DIR . 'queries/tag_table.php');
require_once (APP_DIR . 'queries/post_table.php');
$tags = get_tag_by_id('');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post'])) {
    $errors = array();
    if (empty($_POST['post_name'])) {
        $errors[] = 'post name';
    } else {
        $post_name = mysqli_real_escape_string($dbc,strip_tags($_POST['post_name']));
    }

    if (isset($_POST['tag']) && filter_var($_POST['tag'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
        $tag_id = $_POST['tag'];
    } else {
        $errors[] = 'tag';
    }

    if (empty($_POST['content'])) {
        $errors[] = 'content';
    } else {
        $content = mysqli_real_escape_string($dbc, $_POST['content']);
    }

    if (empty($errors)) {
        $result = insert_post($post_name, $content, date('Y-m-d'), $tag_id);
        if ($result == 1) {
            $message_post = "<p class='success'>The post was added successfully</p>";
        } else {
            $message_post = "<p class='warning'>The post counld not be added due to a system error</p>";
        }
    } else {
        $message_post = "<p class='warning'>Please fill in all the required fields</p>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_tag'])) {
    $flag_add_tag = TRUE;
    if (!empty($_POST['tag_name'])) {

        $result = check_tag_name($_POST['tag_name']);
        $is_existed_tag_name = (mysqli_num_rows($result) >= 1) ;

        if ($is_existed_tag_name) {
            $message_tag = "<p class='warning'>Tag đã tồn tại </p>";
        } else {
            insert_tag(mysqli_real_escape_string($dbc, strip_tags($_POST['tag_name'])));
            $message_tag = "<p class='success'>Tag đã đươc thêm thành công </p>";
        }

    } else {
        $errors[] = 'tag name';
    }
}
?>

<section id="add-post">
    <h2>Create a post</h2>
    <form action="" method="post">
        <fieldset>
            <legend>POST</legend>
            <?php
            if (isset($message_post)) {
                echo $message_post;
            }
            ?>
            <div class="row">
                <label>Post Name</label>

                <?php
                if (isset($errors) && in_array('post name', $errors)) {
                    echo "<p class='warning'>Please fill in the post name</p>";
                }
                ?>

                <input type="text" name="post_name" <?php if (!empty($errors) && !in_array('post name', $errors) &&  isset($post_name)) echo " value='$post_name'"; ?>/>

            </div>

            <div class="row">
                <label>Select tag</label>

                <?php
                if (isset($errors) && in_array('tag', $errors)) {
                    echo "<p class='warning'>Please pick a tag</p>";
                }
                ?>

                <select name="tag">
                    <?php
                    $tags = get_tag_by_id('');
                    if (mysqli_num_rows($tags) > 0) {
                        while ($tag = mysqli_fetch_array($tags)) {
                            $tag_id = $tag['tag_id'];
                            $tag_name = $tag['tag_name'];
                            echo "<option value='$tag_id'>$tag_name</option>";
                        }
                    }
                    ?>
                </select><!--
                --><form action="" method="post">
                    <button type="submit" name="add_tag">Thêm tag</button>
                    <?php
                    if (isset($flag_add_tag) && $flag_add_tag == TRUE) {
                        echo "
                            <input type='text' name='tag_name' placeholder='Điền tag vào đây'/>
                            ";
                        if (isset($is_existed_tag_name)) echo $message_tag;
                    }
                    ?>
                </form>
            </div>

            <div class="row">
                <label>Content</label>

                <?php
                if (isset($errors) && in_array('content', $errors)) {
                    echo "<p class='warning'>Please fill in the content</p><br />";
                }
                ?>

                <textarea name="content" id="admin-post-content"></textarea>
            </div>
            <button id="post" type="submit" name="post" value="post">POST</button>
        </fieldset>
    </form>
</section>