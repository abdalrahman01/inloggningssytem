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
    <title><?php echo $_SESSION["username"] ?></title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <ul class="nav justify-content-end">
            <?php echo ($_SESSION["permission_level"] == "admin") ? '<li class="nav-item">
                <a class="nav-link" href="admin_feed.php">Go Back To Admin Feed</a>
            </li> ' : ""; ?>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>

        </ul>
        <div class="row">
            <div class="posts col-9">

                <?php

                $stmt = select_all_posts($db);
                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $post_id = $row["post_id"];
                        $post_title = $row["post_title"];
                        $post_creator = $row["username"];
                        $post_content = $row["post_content"];
                        $post_created_date = $row["date"];
                        echo "    <h2> $post_title <span class='badge bg-dark'>$post_creator</span></h2>
                                <p> $post_content </p>
                                <span> created $post_created_date </span>
                                <hr>
                        ";
                    }
                }
                ?>

            </div>
        </div>
    </div>

</body>

</html>