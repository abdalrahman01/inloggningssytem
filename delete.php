<?php

session_start();

if (!isset($_SESSION["permission_level"])) {
    header("Location: .");
}

require_once "config/db.php";
require_once "functions/post_functions.php";



if (isset($_POST["id"])) {
    $row = select_post_by_id($_POST["post_id"], $db);

    // header("Location: s" );
} elseif (isset($_POST["confirm_delete"])) {
    delete_post_by_id($_POST["post_id"], $db);
    $redirect_to = ($_SESSION["permission_level"] == "admin") ? "admin_feed" : "feed";
    header("Location: $redirect_to.php?msg=post_deleted");
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
    <title>Delete A Post</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="contaier">
        <div class="row">
            <div class="col-12">
                <ul>

                    <?php
                    $post_id = $row["post_id"];
                    $post_title = $row["post_title"];
                    $post_content = $row["post_content"];
                    $post_created_date = $row["date"];
                    echo "    
                        <h2> $post_title</h2>
                        <p> $post_content </p>
                        <span> created $post_created_date </span>
                        <hr>
                        <form action='delete.php' method='post'>
                        <input type='hidden' name='post_id' value=' $post_id '>
                        <input type='submit' value='Confirm Delete' name='confirm_delete' class='btn btn-danger'>            
                        </form>
                        ";

                    ?>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>