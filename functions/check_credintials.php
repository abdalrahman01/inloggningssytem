<?php
require_once "../config/db.php";

$username = $_POST["username"];
$password = $_POST["password"];



// kolla först om username finns i databasen
$sql = "SELECT * FROM users INNER JOIN passwords ON users.user_id = passwords.user_id
INNER JOIN permissions ON users.permission_level = permissions.permission_id
WHERE users.user_id = :user_id";


$stmt = $db->prepare($sql);
$stmt->bindValue(":username", $username);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_id = $row["user_id"];
    if ($row["password"] == $password) {
        //pass
        // start a sessions 
        session_start();
        $_SESSION["user_id"]  = $user_id;
        $_SESSION["username"]  = $username;
        $_SESSION["permission_name"]  = $row["permission_name"];
        header("Loaction: admin_page.php");
    } else {

        // skicka tillbaks till index.php med ett fel meddelende 
        header("Location: ./?msg=wrong_password");
    }
} else {
    // skicka tillbaks till index.php med ett fel meddelende 
    header("Location: ./?msg=user_not_found");
}
