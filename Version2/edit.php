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
        <form action="edit.php" method="post">
            <label> Title</label>
            <input type="text" name="post_title" value="<?php echo $row["post_title"] ?>">
            <br>
            <label> Content</label>
            <textarea type="text" name="post_content" rows="10" cols="25">  <?php echo $row["post_content"] ?></textarea>
            <br>
            <input type="hidden" name="post_id" value="<?php echo $row["post_id"] ?>">
            <input type="submit" name="update" class="btn btn-secondary">
        </form>
        <div class="option-admin-feed col-2">
            <div class="option-card">
                <a href="logout.php">Log Out</a>

            </div>
        </div>
    </div>
</body>

</html>