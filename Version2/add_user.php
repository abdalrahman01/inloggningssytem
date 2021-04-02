<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: .");
}

if (isset($_POST["add_user"])) {

    if (($_POST["password1"] == $_POST["password2"]) && isset($_POST["permission_level"])) {
        require_once "config/db.php";
        require_once "functions/user_functions.php";
        add_user($_POST["username"], $_POST["password1"], $_POST["permission_level"], $db);
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="admin_feed.php">Admin Feed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="feed.php">Regular Feed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add.php">New Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users_list.php">User's List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
   
        <div class="row">
           <form action="add_user.php" method="post">
           <div class="input-group mb-3">
                <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username">
            </div>
            <div class="input-group mb-3">
                <input type="password" name="password1" class="form-control" placeholder="Passowrd" aria-label="password">
            </div>
            <div class="input-group mb-3">
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" aria-label="Confirm Password">
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="permission_level" value="admin">
                <label class="form-check-label">
                    Admin
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="permission_level" value="user">
                <label class="form-check-label">
                    User
                </label>
            </div>
            <input type="submit" value="Add user" name="add_user" class="btn btn-primary">
            
           </form>
        </div>
    </div>

</body>

</html>