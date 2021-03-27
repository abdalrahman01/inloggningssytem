<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: .");
}

require_once "config/db.php";
require_once "functions/functions.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
</head>

<body>

    <a href="logout.php">Logout!</a>
    <a href="add.php">ADD A POST</a>
    <a href="add_user.php">ADD A USer</a>

    <hr>

    <?php
        $stmt = select_all_posts($db);
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $post_id = $row["post_id"];
                echo '<h2>' . $row["post_title"] . '</h2>' . 
                '<p>' . $row["post_content"] .  '</p>' . 
                '<h4>' . $row["date"] . ' | ' . $row["username"] . '</h4>' . 
                '<form action="edit.php" method="post">' . 
                '<input type="hidden" name="post_id" value="'. $post_id .'">' . 
                '<input type="submit" value="edit" name="id">' . 
                ' </form>' ;
                echo '<form action="delete.php" method="post">
                <input type="hidden" name="post_id" value="'. $post_id .'">
                <input type="submit" name="id" value="Delete">
            </form>';
            }
        }
    ?>
</body>

</html>
