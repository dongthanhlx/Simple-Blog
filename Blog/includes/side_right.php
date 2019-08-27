<div id="side-right">
    <?php
        require_once (APP_DIR . "includes/functions.php");
        if (isAdmin()) {
            echo "
                <ul class='admin'>
                    <li><a href='" . APP_DIR . "add_post.php'>Add Post</a></li>
                    <li><a href='". APP_DIR . "admin/logout.php'>Logout</a></li>
                </ul>
            ";
        } else {
            echo "
                <a class='admin' href='" . APP_DIR ."add_post.php'>I want to write a post</a>
            ";
        }
        include('posts.php');
    ?>
</div>