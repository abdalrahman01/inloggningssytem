<?php

session_start();
if (!isset($_SESSION["permission_level"]) && !$_SESSION["permission_level"] == "admin") {
    header("Location: .");
}

require_once "config/db.php";
require_once "functions/user_functions.php";

if (isset($_POST["delete_user"])) {
    delete_user($_POST["user_id"], $db);
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <div class="container">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Permission Level</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $stmt = select_all_usernames($_SESSION["user_id"], $db);

                if ($stmt->rowCount() > 0) {
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        $username = $row["username"];
                        $user_id =  $row["user_id"];
                        echo '<tr>
                <td>' . $username . '</td>
                <td>' . $row["permission_name"] . '</td>
                <td> 
                    <form action="users_list.php" method="post">
                         <input type="hidden" name="user_id" value="' . $user_id . '">
                        <input type="submit" value="Delete" name="delete_user">
                    </form>
                    <a href="edit_user.php?user_id='.$user_id.'"> Edit </a> </td>
                </tr>';
                    }
                }
                ?>

            </tbody>
        </table>
        <div class="option-admin-feed col-2">
            <div class="option-card">
                <a href="logout.php">Log Out</a>

            </div>
        </div>
    </div>

</body>

</html>