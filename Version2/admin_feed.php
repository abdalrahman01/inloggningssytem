<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: .");
}

require_once "config/db.php";
require_once "functions/post_functions.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION["username"]?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

</head>

<body>

    <div class="container">
        <ul class="nav justify-content-end">
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
                <a class="nav-link" href="users_list.php">User's List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
        <br>
        <br>
        <div class="row">
            <div class="posts col-12">
                <?php
                $stmt = select_all_posts($db);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_creator = $row["username"];
                        $post_content = $row["post_content"];
                        $post_created_date = $row["date"];
                        echo "
                            <div class='post'>
                                <h2> $post_title <span class='badge bg-dark'> by $post_creator</span></h2>
                                <p> $post_content </p>
                                <span> created $post_created_date </span>
                            </div>
                        
                            <div class='row'>
                                <div class='col-1'>
                                     <form action='edit.php' method='post'>
                                        <input type='hidden' name='post_id' value='$post_id '>
                                        <input type='submit' value='Edit' name='id' class='btn btn-secondary'>
                                    </form> 
                                </div>
                                <div class='col-1'>
                                    <form action='delete.php' method='post'>
                                        <input type='hidden' name='post_id' value='$post_id'>
                                        <input type='submit' value='Delete' name='id' class='btn btn-danger'>
                                    </form>
                                </div>
                             </div>
                             <hr>";
                    }
                }
                ?>
            </div>
        </div>
    </div>





</body>

</html>