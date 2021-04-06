<?php

session_start();
if (!isset($_SESSION["permission_level"]) && !$_SESSION["permission_level"] == "admin") {
    header("Location: .");
}

require_once "config/db.php";
require_once "functions/user_functions.php";

if (isset($_POST["delete_user"])) {
    $user_id = $_POST["user_id"];
   
    switch ($_POST["permission_level"]) {
        case 'admin':
            delete_admin($user_id, $db);
            header("Location: users_list.php?msg=admin_deleted");
            break;
        case 'user':
            delete_user($user_id, $db);
            header("Location: users_list.php?msg=user_deleted");
            break;
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
                <a class="nav-link" href="add_user.php">New User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
        <div class="row">
        <?php 
            if(isset($_GET["msg"])){
                switch ($_GET["msg"]) {
                    case 'user_deleted':
                        echo '
                            <div class="alert alert-danger" role="alert">
                                User Deleted!
                            </div>';
                        break;
                    case 'admin_deleted':
                        echo '
                            <div class="alert alert-danger" role="alert">
                                Admin Deleted!
                            </div>';
                        break;
                }
            }
        ?>
        </div>
        <table class='table table-hover'>
            <thead>
                <tr>

                    <th scope='col'>Username</th>
                    <th scope='col'>Permission Level</th>
                    <th scope='col'>Option</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = select_all_usernames($_SESSION["user_id"], $db);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $username = $row["username"];
                        $user_id =  $row["user_id"];
                        $permission_level = $row["permission_name"];
                        echo "
                    
                            <tr>
                                <td>$username</td>
                                <td>$permission_level</td>
                                <td>
            
                                    <div class='row'>
                                        <div class='col-6'>
                                            <form action='users_list.php' method='post'>
                                                <input type='hidden' name='user_id' value='$user_id'>
                                                <input type='hidden' name='permission_level' value='$permission_level'>
                                                <input type='submit' name='delete_user' value='Delete' class='btn btn-danger'>
                                            </form>
                                        </div>
                                        <div class='col-6'>
                                            <a href='edit_user.php?user_id=$user_id '> Edit </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        ";
                      
                    }
                }
                ?>
            </tbody>
        </table>
        


</body>

</html>