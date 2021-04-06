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

        if ($password == $row["password"]) {
            //pass
            // start a sessions 
            session_start();
            $_SESSION["user_id"]  = $row["user_id"];
            $_SESSION["username"]  = $username;
            $_SESSION["permission_level"]  = $row["permission_name"];
        } else {
            // skicka tillbaks till index.php med ett fel meddelende 
            header("Location: ./?msg=wrong_username_or_password");
        }
    } else {
        // skicka tillbaks till index.php med ett fel meddelende 
        header("Location: ./?msg=wrong_username_or_password");
    }
}


function add_user($username, $password, $permisssion_level ,$db) {
    $sql = "INSERT INTO `users` (`username`, `password`, `permission_level`) VALUES (:username, :password, :permission_level)";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", $password);
    if($permisssion_level=="admin") {
        $permisssion_level = 1;
    } elseif ($permisssion_level == "user") {
        $permisssion_level = 2;
    }
    $stmt->bindValue(":permission_level", $permisssion_level);
    $stmt->execute();
}

function select_all_usernames($admin_id, $db) {
    $sql = "SELECT users.user_id, users.username, permissions.permission_name FROM users INNER JOIN permissions ON users.permission_level = permissions.permission_id WHERE NOT users.user_id = :admin_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":admin_id", $admin_id);
    $stmt->execute();
    return $stmt;    
}

function delete_user($user_id, $db){
    $sql = "DELETE FROM users WHERE user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":user_id", $user_id);
    $stmt->execute();

}

function select_user_by_id($user_id, $db) {
    $sql = "SELECT users.username, users.password, permissions.permission_name FROM users INNER JOIN permissions ON users.permission_level = permissions.permission_id WHERE users.user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":user_id", $user_id);
    $stmt->execute();
    return $stmt;  
}

function update_user($user_id, $username, $password, $permisssion_level, $db) {
    $sql = "UPDATE users SET users.username = :username, users.password= :password, users.permission_level = :permission_level WHERE users.user_id = :user_id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":user_id", $user_id);
    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":password", $password);
    // $permisssion_level == "admin"? 1 : 2 >> betyder att if ($permisssion_level == "admin") {return 1;} else {return 2;};
    $stmt->bindValue(":permission_level", $permisssion_level == "admin"? 1 : 2 );
    $stmt->execute();
}

function delete_admin($user_id,$db){
    $sql1 = "DELETE
            FROM
                posts
            WHERE
                posts.post_creator = :post_creator;
           ";
    $sql2 ="DELETE
            FROM
                users
            WHERE
                users.user_id = :user_id;
    ";
    $stmt = $db->prepare($sql1);
    $stmt->bindValue(":post_creator", $user_id);
    $stmt->execute();
    $stmt = $db->prepare($sql2);
    $stmt->bindValue(":user_id", $user_id);
    $stmt->execute();
}