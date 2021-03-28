<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: .");
}

if (isset($_POST["add_user"])) {

    if ($_POST["password1"] == $_POST["password2"]) {
        require_once "config/db.php";
        require_once "functions/functions.php";
        add_user($_POST["username"], $_POST["password1"],$_POST["permission_level"],$db);
        header("Location: admin_feed.php");
    } else {
        header("Location: add_user.php?error=passwords_dont_match");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="add_user.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <br>
        <input type="password" name="password1" placeholder="Password">
        <br>
        <input type="password" name="password2" placeholder="confirm password">
        <br>
        <label for="permission_level">Choose Permission Level</label> <br>
        <input type="radio" name="permission_level" value="admin"> <span>Admin</span> <br>
        <input type="radio" name="permission_level" value="user"> <span>User</span> <br>
        <input type="submit" value="Add user" name="add_user">
    </form>
</body>

</html>