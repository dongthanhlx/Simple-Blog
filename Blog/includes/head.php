<!DOCTYPE html>
<html>
<?php
header("Cache-Control: private, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: Sat, 26Jul 1997 05:00:00 GMT");
?>
    <head>
        <title><?php echo (isset($title)) ? $title:'Blog TheFullSnack'; ?></title>
        <meta charset="utf-8">
        <link href="<?php echo APP_DIR . 'stylesheet/style.v2.css'?>" rel="stylesheet" type="text/css" />
        <script src="https://cdn.tiny.cloud/1/5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
        <script type="text/javascript" src="<?php echo APP_DIR . 'js/script.js' ?>"></script>
    </head>

    <body>
        <div id="container">
