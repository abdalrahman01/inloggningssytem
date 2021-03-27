<?php

    require_once "functions/functions.php";
    require_once "config/db.php";

    if(isset($_POST["id"])) {
        $row = select_post_by_id($_POST["post_id"], $db);
    } elseif(isset($_POST["update"])) {
        update_post($_POST["post_title"], $_POST["post_content"], $_POST["post_id"], $db);
        header("Location: admin_page.php");
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
    <title>Edit | post_id</title>
</head>
<body>
    <form action="edit.php" method="post">
        <label> Title</label>
        <input type="text" name="post_title" value="<?php echo $row["post_title"] ?>">
        <br>
        <label> Content</label>
        <input type="text" name="post_content" value="<?php echo $row["post_content"] ?>">
        <br>
        <input type="hidden" name="post_id" value="<?php echo $row["post_id"] ?>">
        <input type="submit" name="update">
    </form>
</body>
</html>