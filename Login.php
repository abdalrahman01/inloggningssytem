<?php 

if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
</head>

<body>
    <form action="Login.php" method="post">

        <fieldset>
            <legend>Log In</legend>

            <label for="username">Username</label>
            <input type="text" name="username" required>
            <br>
            <label for="password">Password</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="Log in">

        </fieldset>


    </form>
</body>

</html>