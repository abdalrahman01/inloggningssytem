<?php 
require_once "config/db.php"; 
require_once "functions/functions.php"; 
session_start();
if (isset($_SESSION["permission_level"]) && $_SESSION["permission_level"] == "admin"){
    if(isset($_POST["add"])) {
        insert_post($_POST["post_title"], $_POST["post_content"], $_SESSION["user_id"], $db);
        header("Location: admin_page.php");
    }
} else {
    header("Location: Login.php?" .  $_SESSION["permission_level"] );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add</title>
</head>

<body>
    <form action="add.php" method="post">
        <fieldset>
            <legend>Add A Post</legend>
            <label>Title</label>
            <input type="text" name="post_title">
            <br> <br>
            <label>content</label>
            <textarea name="post_content" cols="30" rows="10"></textarea>
            <br> <br>
            <input type="submit" value="add" name="add">
        </fieldset>
    </form>
</body>

</html>