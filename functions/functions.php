<?php

/**
 * check_credintials
 *
 * @param  string $username
 * @param  string $password
 * @param  mixed $db
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
            header("Location: .");
        } else {
            // skicka tillbaks till index.php med ett fel meddelende 
            header("Location: ./?msg=wrong_password");
        }
    } else {
        // skicka tillbaks till index.php med ett fel meddelende 
        header("Location: ./?msg=user_not_found");
    }
}

/**
 * delete_post_by_id
 *
 * @param  mixed $id
 * @param  mixed $db
 * @return void
 */
function delete_post_by_id($id, $db){
    $sql = "DELETE FROM posts WHERE posts.post_id = :post_id";
    $stmt = $db -> prepare($sql);
    $stmt->bindValue(":post_id", $id);
    $stmt -> execute();
}

/**
 * select_all_posts
 *
 * @param  mixed $db
 * @return object
 */
function select_all_posts($db){
    $sql = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date, users.username 
    FROM posts INNER JOIN users ON users.user_id = posts.post_creator";
    $stmt = $db-> prepare($sql);
    $stmt->execute();
    return $stmt;
}

/**
 * select_post_by_id
 *
 * @param  mixed $id
 * @param  mixed $db
 * @return void
 */
function select_post_by_id($id, $db){
   
    $sql = 'SELECT * FROM posts WHERE post_id = :id';
    $stmt = $db -> prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;        
} 

/**
 * update_post
 *
 * @param  mixed $post_title
 * @param  mixed $post_content
 * @param  mixed $post_id
 * @param  mixed $db
 * @return void
 */
function update_post($post_title, $post_content, $post_id, $db){
    
    $sql = "UPDATE posts SET posts.post_title = :post_title, posts.post_content = :post_content WHERE posts.post_id = :post_id";
   
    $stmt = $db -> prepare($sql);
    $stmt->bindValue(":post_title", $post_title);
    $stmt->bindValue(":post_content", $post_content);
    $stmt->bindValue(":post_id", $post_id);
    $stmt->execute();

}

/**
 * insert_post
 *
 * @param  mixed $post_title
 * @param  mixed $post_content
 * @param  mixed $post_creator
 * @param  mixed $db
 * @return void
 */
function insert_post($post_title, $post_content, $post_creator, $db) {
    $sql = "INSERT INTO posts (post_creator, post_title, post_content, posts.date) VALUES (:post_creator, :post_title, :post_content, NOW())";
    $stmt = $db -> prepare($sql);
    $stmt->bindValue(":post_title", $post_title);
    $stmt->bindValue(":post_content", $post_content);
    $stmt->bindValue(":post_creator", $post_creator);
    $stmt->execute();
   
}