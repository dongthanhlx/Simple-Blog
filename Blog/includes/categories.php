<?php
    require_once(APP_DIR . '/queries/category_table.php');
    require_once ('functions.php');
    $categories = get_category();
?>
<nav id="categories">
    <ul>
        <?php

        if (mysqli_num_rows($categories) > 0) {
            while ($category = mysqli_fetch_array($categories)) {
                $cat_name = $category['cat_name'];
                $cat_link = $category['link'];
                echo "<li><a href='$cat_link'>$cat_name</a></li>";
            }
        }

        ?>
    </ul>
</nav>