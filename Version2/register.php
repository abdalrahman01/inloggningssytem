<?php

session_start();
if (isset($_SESSION["username"])) {
    header("Location: .");
}



if (isset($_POST["register"])) {
    foreach ($_POST as $k => $v) {
        echo "$k: $v <br> ";
    }
    // kolla om lösenorden är samma i både fälten 

    if($_POST["password1"] == $_POST["password2"]) {
        require_once "functions/user_functions.php";
        require_once "config/db.php";   
        add_user($_POST["username"], $_POST["password1"], "user", $db);
        header("Location: .?msg=Log-in");
    } else {
        header("Location: register.php?msg=passwords-not-the-same");
        
    }
    
    // if ($_POST["password1"] == $_POST["passowrd2"]) {
    //     require_once "functions/user_functions.php";
    //     require_once "config/db.php";
    //     add_user($_POST["username"], $_POST["passowrd1"], "user", $db);
    //     header("Location: .");
    // } else {
    //     header("Location: register.php?error=passwords-not-the-same" . $_POST["username"] . " " . $_POST["passowrd"]);
    // }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container center">
        <form method="post" action="register.php">
            <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="text" class="form-control" name="password1" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>Confrim Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
            </div>
            <br>
            <input type="submit" value="Register" name="register" class="btn btn-primary">
            <br>
            <span>Do you already have an account?</span> <a href=".">Log in</a>

        </form>
    </div>
</body>

</html>