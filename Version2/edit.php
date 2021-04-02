<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: .");
}
require_once "functions/post_functions.php";
require_once "config/db.php";

if (isset($_POST["id"])) {
    $row = select_post_by_id($_POST["post_id"], $db);
} elseif (isset($_POST["update"])) {
    update_post($_POST["post_title"], $_POST["post_content"], $_POST["post_id"], $db);
    header("Location: admin_feed.php");
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
    <title>Edit |<?php echo $row["post_id"] ?></title>
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
                <a class="nav-link" href="add_user.php">New User</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users_list.php">User's List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>


        <form action="edit.php" method="post">
            <fieldset>
                <legend>Edit</legend>

                <input class="form-control" type="text" name="post_title" placeholder="Title Here" aria-label="Title Here" value="<?php echo $row["post_title"] ?>">

                <br>
                <div class="form-floating">
                    <textarea class="form-control" placeholder="Leave a comment here" name="post_content" style="height: 100px"><?php echo $row["post_content"] ?></textarea>
                    <label>Content</label>

                </div>
                <br>
                <input type="hidden" name="post_id" value="<?php echo $row["post_id"] ?>">

                <input type="submit" name="update" class="btn btn-secondary" value="Update">
            </fieldset>
        </form>


    </div>
</body>

</html>