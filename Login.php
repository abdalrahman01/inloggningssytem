<?php
require_once "./functions/check_credintials.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>
    <div class="container">
        <form action="Login.php" method="post">

            <fieldset>
                <legend>Log In</legend>

                <label for="username">Username</label>
                <input type="text" name="username" required>
                <br>
                <label for="password">Password</label>
                <input type="text" name="password" required>
                <br>
                <input type="submit" value="Log in" name="login">

            </fieldset>


        </form>
    </div>
</body>

</html>