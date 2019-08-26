<?php
include ('./../../includes/mysqli_connect.php');
include('./../../queries/category_table.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = array();
    if (!empty($_POST['category_name'])) {
        $name_category = mysqli_real_escape_string($dbc, strip_tags($_POST['category_name']));
    } else {
        $errors[] = "category name";
    }

    if (!empty($_POST['link'])) {
        $link_category = mysqli_real_escape_string($dbc, strip_tags($_POST['link']));
    } else {
        $errors[] = "link of category";
    }

    if (empty($errors)) {
        insert_category($link_category, $name_category);
        echo "<p class='success'>The category was added successfully</p>";
    }
}
?>

<section id="add-category">
    <form action="" method="post">
        <fieldset>
            <legend>Add Category</legend>
            <div>
                <label>Name</label>
                <?php
                if (isset($errors) && in_array('category name', $errors)) {
                    echo "<p class='warning'>Please fill in the category name</p>";
                }
                ?>
                <input type="text" name="category_name" class="input" />
            </div>

            <div>
                <label>Link</label>
                <?php
                if (isset($errors) && in_array('link of category', $errors)) {
                    echo "<p class='warning'>Please fill in the link of category</p>";
                }
                ?>
                <input type="url" name="link" class="input" />
            </div>
        </fieldset>
        <button type="submit" name="add_category">Add</button>
    </form>
</section>