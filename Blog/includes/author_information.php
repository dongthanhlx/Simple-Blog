<?php
    require_once(APP_DIR . 'queries/user_table.php');
    $result = get_admin();
?>
<div id="author">
    <?php
    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_array($result, MYSQLI_ASSOC);
            ?>
            <?php
                include ('icon.php');
            ?>

            <h1>The Full Snack <br/>Developer</h1>

            <h3>By: <?php echo $admin['name'] ?></h3>

            <p id="email">Liên hệ: <?php echo $admin['email'] ?></p>

            <p id="description"><?php echo $admin['description'] ?></p>
            <?php
    }
    ?>
</div>
