<?php
session_start();
require_once "functions/user_functions.php";
require_once "config/db.php";
if (isset($_GET["user_id"]) && ($_SESSION["permission_level"] == "admin")) {

    $stmt = select_user_by_id($_GET["user_id"], $db);
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} elseif (isset($_POST["update"]) && ($_SESSION["permission_level"] == "admin")) {
    if ($_POST["password1"] == $_POST["password2"]) {
        update_user($_POST["user_id"], $_POST["username"], $_POST["password1"], $_POST["permission_level"], $db);
        header("Location: users_list.php?msg=user_edited", $http_response_header = 200);
    } else {
        header("Location: edit_user.php");
    }
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
    <title>Edit User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">


        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="admin_feed.php">Admin Feed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="feed.php">Regular Feed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="add.php">New Post</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="users_list.php">User's List</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Log Out</a>
            </li>
        </ul>

        <div class="row">
            <form method="post" action="edit_user.php">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" placeholder="Enter username" value='<?php echo $row["username"]; ?>' required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password1" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label>Confrim Password</label>
                    <input type="password" class="form-control" name="password2" placeholder="Confirm Password" required>
                </div>
                <br>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="permission_level" value="admin" <?php echo ($row["permission_name"] == "admin") ? "checked" : ""; ?> required>
                    <label class="form-check-label">
                        Admin
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="permission_level" value="user" <?php echo ($row["permission_name"] == "user") ? "checked" : ""; ?>>
                    <label class="form-check-label">
                        User
                    </label>
                </div>
                <input type="hidden" name="user_id" value='<?php echo $_GET["user_id"]; ?>'>
                <input type="submit" value="update" name="update" class="btn btn-primary">
            </form>
        </div>
    </div>
</body>

</html>