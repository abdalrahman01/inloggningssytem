<?php


session_start();
if (isset($_SESSION["username"])) {
    redirect_to_home($_SESSION["permission_level"]);
}

require_once "functions/user_functions.php";
require_once "config/db.php";

if (isset($_POST["login"])) {
    check_credintials($_POST["username"], $_POST["password"], $db);
    redirect_to_home($_SESSION["permission_level"]);
}


function redirect_to_home($permission_level)
{
    if ($permission_level == "admin") {
        header("Location: admin_feed.php");
    }
    if ($permission_level == "user") {
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
    <div class="container center">
       
        <form method="post" action=".">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required>
            </div>
            <br>
            <?php 
            if(isset($_GET["msg"]) && $_GET["msg"] == "wrong_username_or_password"){
                echo '
                <div class="alert alert-danger" role="alert">
                    Wrong Username or password
                </div>';
            }
        ?>
            <input type="submit" value="Log in" name="login" class="btn btn-primary">
            <span>Or register</span> <a href="register.php">Register me</a>

        </form>
    </div>
</body>

</html>