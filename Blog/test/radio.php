<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo $_POST['submit'];
    echo $_POST['delete'];
    echo $_POST['yes'];
    echo $_POST['no'].val;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Radio</title>
</head>

<body>
<form action="" method="post" name="delete">
    <input type="radio" value="YES" name="radio"/>
    <input type="radio" value="NO" name="radio" checked/>
    <button type="submit">Submit</button>
</form>
</body>
</html>