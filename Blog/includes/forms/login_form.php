<?php
    require_once (APP_DIR . 'includes/functions.php');
    require_once (APP_DIR . 'queries/user_table.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = array();
        if (!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $email = mysqli_real_escape_string($dbc, strip_tags($_POST['email']));
        } else {
            $errors[] = 'email';
        }

        if (!empty($_POST['password']) && preg_match('/^\w{4,20}$/', trim($_POST['password']))) {
            $password = mysqli_real_escape_string($dbc, trim($_POST['password']));
        } else {
            $errors[] = 'password';
        }

        if (empty($errors)) {
            $result = check_account($email, $password);
            if (mysqli_num_rows($result) == 0) {
                $message = "<p class='warning'>You are not admin</p>";
            } else {
                $_SESSION['status'] = 'admin';
                redirect_to();
            }
        } else {
            $message = "<p class='warning'>Please fill in all the required fields</p>";
        }
    }
?>

<section id="login-form">
    <form action="" method="post">
        <fieldset>
            <legend>Login</legend>
            <?php
            if (!empty($message)) echo $message;
            ?>
            <div class="row">
                <input type="email" id="email" name="email" placeholder="Nhập email"/>
            </div>

            <div class="row">
                <input type="password" id="password" name="password" placeholder="Nhập password" />
            </div>

            <div class="row">
                <button type="submit" id="login" name="login">Login</button>
            </div>
        </fieldset>
    </form>
</section>