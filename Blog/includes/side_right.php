<div id="side-right">
    <?php
        if (isset($_SESSION['email']) && isset($_SESSION['password'])) {
            echo "
                <ul class='admin'>
                    <li><a href='" . APP_DIR . "admin/add/add_post.php'>Add Post</a></li>
                    <li><a href='". APP_DIR . "admin/logout.php'>Logout</a></li>
                </ul>
            ";
        }
        include('posts.php');
    ?>
</div>