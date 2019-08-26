<?php
    require_once(APP_DIR . '/queries/post_table.php');
    require_once(APP_DIR . '/queries/tag_table.php');
    if (!isset($posts)) $posts = get_post_by_id('');
?>

<section id="posts">
    <?php
    if (mysqli_num_rows($posts) > 0) {
        while ($post = mysqli_fetch_array($posts, MYSQLI_ASSOC)) {
            $post_name = $post['post_name'];
            $post_date = $post['post_date'];
            $post_id = $post['post_id'];

            $tag_id = $post['tag_id'];
            $tag = mysqli_fetch_array(get_tag_by_id($tag_id), MYSQLI_ASSOC);
            $tag_name = $tag['tag_name'];

            echo "<div class='post'>"
                    . "<time>{$post_date}</time> {$tag_name}"
                    . "<h3 class='post-name'><a href='post.php?pid={$post_id}'>$post_name</a></h3>"
                . "</div><!--End .post-->";

        }
    }
    ?>
</section>
