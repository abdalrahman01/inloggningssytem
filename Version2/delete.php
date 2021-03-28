<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: .");
}   

require_once "config/db.php";
require_once "functions/post_functions.php"; 



if (isset($_POST["id"])) {
    $row = select_post_by_id($_POST["post_id"], $db);

    // header("Location: s" );
} elseif (isset($_POST["confirm_delete"])) {
    delete_post_by_id($_POST["post_id"], $db);
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
    <title>Document</title>
</head>

<body>
    <ul>

        <?php
        foreach ($row as $k => $v) {
            echo " <li> $k: $v </li>";
        }
        // echo  $row["post_title"];

        echo '<form action="delete.php" method="post">
            <input type="hidden" name="post_id" value="' . $row["post_id"] . '">
            <input type="submit" value="Confirm Delete" name="confirm_delete">            
        </form>';
        ?>
    </ul>
</body>

</html>