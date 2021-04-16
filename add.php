<?php

session_start();
if (isset($_SESSION["username"])) {
    if (isset($_POST["add"])) {
        require_once "config/db.php";
        require_once "functions/post_functions.php";
        insert_post($_POST["post_title"], $_POST["post_content"], $_SESSION["user_id"], $db);
        header("Location: admin_feed.php?msg=post_added");
    }
} else {
    header("Location: .");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container">

        <ul class="nav justify-content-end">
        <?php 
            if($_SESSION["permission_level"] == "admin") {
                echo '
                    <li class="nav-item">
                    <a class="nav-link" href="admin_feed.php">Admin Feed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="feed.php">Regular Feed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="add_user.php">New User</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="users_list.php">User\'s List</a>
                    </li>
                ';
            }
        ?>
            
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>
        <form action="add.php" method="post">
            <fieldset>
                <legend>Add A Post</legend>

                <input class="form-control" type="text" name="post_title" placeholder="Title Here" aria-label="Title Here">

                <br>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="post_content" style="height: 100px"></textarea>
                    <label>Content</label>

                </div>
                <br>
                <input type="submit" value="add" name="add" class="btn btn-primary">
            </fieldset>
        </form>

    </div>
</body>

</html>