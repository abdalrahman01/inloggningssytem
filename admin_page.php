<?php

session_start();

if ($_SESSION["permission_level"] != "admin") {
    header("Location: Login.php");
}

require_once "functions/select_all.php";
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

    <hr>

    <?php
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<h2>' . $row["post_title"] . '</h2>' . 
                '<p>' . $row["post_content"] .  '</p>' . 
                '<h4>' . $row["date"] . ' | ' . $row["username"] . '</h4>' . 
                '<form action="edit.php" method="post">' . 
                '<input type="hidden" name="id" value="'. $row["post_id"] .'">' . 
                '<input type="submit" value="edit" name="edit">' . 
                ' </form>' ;
            }
        }
    ?>
    <h2>Title</h2>
    <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam deleniti doloremque aut pariatur saepe officiis ab et, molestiae esse rem, atque laboriosam autem dolor exercitationem? Inventore!</p>
    <h4>yy/mm/dd | writer</h4>
    <form action="edit.php" method="post">
        <input type="hidden" name="id" value="id">
        <input type="submit" value="edit" name="edit">
    </form>

</body>

</html>