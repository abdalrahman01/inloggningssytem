<?php

session_start();
if (isset($_SESSION["username"])) {
    header("Location: .");
}



if (isset($_POST["register"])) {
    require_once "functions/user_functions.php";
    require_once "config/db.php";   
   
    // kolla om username finns redan
    if (username_exist($_POST["username"], $db)) {
        header("Location: register.php?msg=username-already-exists");
    }

    // kolla om lösenorden är samma i både fälten 

    if($_POST["password1"] == $_POST["password2"]) {
        
        add_user($_POST["username"], $_POST["password1"], "user", $db);
        header("Location: .?msg=Log-in");
    } else {
        header("Location: register.php?msg=passwords-not-the-same");
        
    }
    
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
                <input type="password" class="form-control" name="password1" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label>Confrim Password</label>
                <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
            </div>
            <br>
            <?php 
            if(isset($_GET["msg"])){
                require_once "functions/alert-handler.php";
                switch ($_GET["msg"]) {
                    case 'passwords-not-the-same':
                        make_alert("danger", "Passwords are not the same!" );
                        break;
                    case 'username-already-exists':
                        make_alert("danger", "Username already exists!" );
                        break;
                    
                  
                }
            }
        ?>
            <input type="submit" value="Register" name="register" class="btn btn-primary">
            <br>
            <span>Do you already have an account?</span> <a href=".">Log in</a>

        </form>
    </div>
</body>

</html>