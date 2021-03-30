<?php

session_start();
if (!isset($_SESSION["username"])) {
    header("Location: .");
}

require_once "config/db.php";
require_once "functions/post_functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/grid.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="posts col-9">

                <?php

                $stmt = select_all_posts($db);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $post_id = $row["post_id"];
                        echo ' <div class="post"> <h2>' . $row["post_title"] . '</h2>' .
                            '<p>' . $row["post_content"] .  '</p>' .
                            '<h4>' . $row["date"] . ' | ' . $row["username"] . '</h4> </div>';
                    }
                }
                ?>

            </div>
            <div class="option-admin-feed col-2">
                <div class="option-card">
                    <a href="logout.php">Log Out</a>

                </div>
            </div>
        </div>
    </div>

</body>

</html>