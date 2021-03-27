<?php

require_once "config\\db.php";

$sql = "SELECT posts.post_id, posts.post_title, posts.post_content, posts.date, users.username 
        FROM posts INNER JOIN users ON users.user_id = posts.post_creator 
        WHERE users.user_id = :user_id";
$stmt = $db-> prepare($sql);
$stmt -> bindValue(":user_id", $_SESSION["user_id"]);
$stmt->execute();


