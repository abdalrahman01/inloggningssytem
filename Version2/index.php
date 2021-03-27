<?php


session_start();
if(isset($_SESSION["username"])){
    redirect_to_home($_SESSION["permission_level"]);

}

require_once "functions/functions.php";
require_once "config/db.php";

if(isset($_POST["login"])){
    check_credintials($_POST["username"], $_POST["password"], $db);
    redirect_to_home($_SESSION["permission_level"]);
}


function redirect_to_home($permission_level) {
    if($permission_level == "admin") {
        header("Location: admin_feed.php");

    }
    if($permission_level == "user") {
        header("Location: feed.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging In</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container a-grid">
        <form action="." method="post" class="login-form">
            <input type="text" name="username" placeholder="Username">
            <br>
            <input type="password" name="password" placeholder="password">
            <br>
            <input type="submit" value="Log in" name="login">
        </form>
    </div>
</body>
</html>