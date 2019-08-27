<?php
require_once (APP_DIR . 'queries/topic_table.php');
require_once (APP_DIR . 'queries/post_table.php');
require_once (APP_DIR . 'queries/user_table.php');
require_once (APP_DIR . 'includes/functions.php');
$topics = get_topic_by_id('');
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['post'])) {
    $errors = array();

    if (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $email = $_POST['email'];
    }

    if (empty($_POST['post_name'])) {
        $errors[] = 'post name';
    } else {
        $post_name = mysqli_real_escape_string($dbc,strip_tags($_POST['post_name']));
    }

    if (isset($_POST['topic']) && filter_var($_POST['topic'], FILTER_VALIDATE_INT, array('min_range' => 1))) {
        $topic_id = $_POST['topic'];
    } else {
        $errors[] = 'topic';
    }

    if (empty($_POST['content'])) {
        $errors[] = 'content';
    } else {
        $content = mysqli_real_escape_string($dbc, $_POST['content']);
    }

    if (empty($errors)) {

        if (isAdmin()) {
            $status = 'approved';
            $user_id = 1;
        } else {
            $tmp_id = mysqli_num_rows(check_email($email));
            $status = 'not approved';

            if ($tmp_id > 0) {
                $user_id = $tmp_id;
            } else {
                add_user('', '', $email, '', '');
                $user_id = mysqli_num_rows(get_user());
            }
        }

        $result = insert_post($post_name, $content, date('Y-m-d'), $topic_id, $user_id, $status);
        if ($result == 1) {
            $message_post = "<p class='success'>The post was added successfully</p>";
        } else {
            $message_post = "<p class='warning'>The post counld not be added due to a system error</p>";
        }
    } else {
        $message_post = "<p class='warning'>Please fill in all the required fields</p>";
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_topic'])) {

    if (!empty($_POST['topic_name'])) {

        $result = check_topic_name($_POST['topic_name']);
        $is_existed_topic_name = (mysqli_num_rows($result) >= 1) ;

        if ($is_existed_topic_name) {
            $message_topic = "<p class='warning'>Tag đã tồn tại </p>";
        } else {
            insert_topic(mysqli_real_escape_string($dbc, strip_tags($_POST['topic_name'])));
            $message_topic = "<p class='success'>Tag đã đươc thêm thành công </p>";
        }

    } else {
        $errors[] = 'topic name';
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
            if (!isAdmin()) {
                echo "<div class='row'>";
                echo "
                <label>Email</label>
                <input type='email' name='email' "; if (!empty($errors) && !in_array('email', $errors) && isset($email)) echo "value='$email'"; echo "/>";

                echo "</div>";
            }
            if (isset($errors) && in_array('email', $errors)) {
                echo "<p class='warning'>Please fill in a email</p>";
            }
            ?>

            <div class="row">
                <label><br />Post Name</label>

                <?php
                if (isset($errors) && in_array('post name', $errors)) {
                    echo "<p class='warning'>Please fill in the post name</p>";
                }
                ?>

                <input type="text" name="post_name" <?php if (!empty($errors) && !in_array('post name', $errors) &&  isset($post_name)) echo " value='$post_name'"; ?>/>

            </div>

            <div class="row">
                <label>Select topic</label>

                <?php
                if (isset($errors) && in_array('topic', $errors)) {
                    echo "<p class='warning'>Please pick a topic</p>";
                }
                ?>

                <select name="topic">
                    <?php
                    $topics = get_topic_by_id('');
                    if (mysqli_num_rows($topics) > 0) {
                        while ($topic = mysqli_fetch_array($topics)) {
                            $topic_id = $topic['topic_id'];
                            $topic_name = $topic['topic_name'];
                            echo "<option value='$topic_id'>$topic_name</option>";
                        }
                    }
                    ?>
                </select>
                <img onclick="displayAddTopic()" id='icon-add' src="<?php echo APP_DIR . 'images/add-icon.png'; ?>" alt="icon-add" />
                <div id="add-topic">
                    <form action="" method="post">
                        <button type="submit" name="add_topic">Thêm topic</button>
                        <input type='text' name='topic_name' placeholder='Điền topic vào đây'/>
                    </form>
                </div>
                <?php
                    if (isset($message_topic)) echo $message_topic;
                ?>
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