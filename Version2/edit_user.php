<?php 
session_start();
if(isset($_GET["user_id"]) && ($_SESSION["permission_level"] == "admin")) {
    require_once "functions/user_functions.php";
    require_once "config/db.php";
    $stmt = select_user_by_id($_GET["user_id"], $db);
    if($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        foreach ($row as $key => $value) {
            echo "$key  $value <br>";
        }
    }
}