<?php

require_once "functions/functions.php";
require_once "config/db.php";

if(isset($_POST["login"])){
    check_credintials($_POST["username"], $_POST["password"], $db);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container loginform">
        <form action="Login.php" method="post" class="login">

            <fieldset>
                <legend>Log In</legend>

                <label for="username">Username</label>
                <input type="text" name="username" required>
                <br>
                <label for="password">Password</label>
                <input type="text" name="password" required>
                <br>
                <input type="submit" value="Log in" name="login" class="login_btn">

            </fieldset>


        </form>
    </div>
</body>

</html>