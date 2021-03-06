<?php

/**
 * delete_post_by_id
 *
 * @param  string $id
 * @param  mixed $db PDO
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
 * @param  mixed $db PDO
 * @return object
 */
function select_all_posts($db){
    $sql = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date, users.username 
    FROM posts INNER JOIN users ON users.user_id = posts.post_creator";
    $stmt = $db-> prepare($sql);
    $stmt->execute();
    return $stmt;
}

function select_all_posts_for_user($user_id, $db) {
    $sql = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date 
    FROM posts WHERE posts.post_creator = :user_id";
    $stmt = $db-> prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->execute();
    return $stmt;
}

/**
 * select_post_by_id
 *
 * @param  string $id
 * @param  mixed $db PDO
 * @return array
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
 * @param  string $post_title
 * @param  string $post_content
 * @param  string $post_id
 * @param  mixed $db PDO
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
 * @param  string $post_title
 * @param  string $post_content
 * @param  string/int $post_creator
 * @param  mixed $db PDO
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
