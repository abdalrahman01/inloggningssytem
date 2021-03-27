<?php

session_start();
if(!isset($_SESSION["username"])) {
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
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <a href="logout.php">Log Out</a>
    <?php

    $stmt = select_all_posts($db);
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $post_id = $row["post_id"];
            echo '<h2>' . $row["post_title"] . '</h2>' .
                '<p>' . $row["post_content"] .  '</p>' .
                '<h4>' . $row["date"] . ' | ' . $row["username"] . '</h4>';
        }
    }
    ?>
</body>

</html>