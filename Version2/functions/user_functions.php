<?php 
/**
 * check_credintials
 *
 * @param  string $username
 * @param  string $password
 * @param  mixed $db PDO
 * @return void
 */
function check_credintials($username, $password, $db)
{

    // kolla först om username finns i databasen
    $sql = "SELECT * FROM users INNER JOIN permissions ON users.permission_level = permissions.permission_id
    WHERE users.username = :username";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(":username", $username);
    $stmt->execute();
    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($password == $row["user_password"]) {
            //pass
            // start a sessions 
            session_start();
            $_SESSION["user_id"]  = $row["user_id"];
            $_SESSION["username"]  = $username;
            $_SESSION["permission_level"]  = $row["permission_name"];
        } else {
            // skicka tillbaks till index.php med ett fel meddelende 
            header("Location: ./?msg=wrong_password");
        }
    } else {
        // skicka tillbaks till index.php med ett fel meddelende 
        header("Location: ./?msg=user_not_found");
    }
}
