<?php


if (isset($_POST['id'])) {
    require_once "config\\db.php";
    
    $sql = 'SELECT * FROM posts WHERE post_id = :id';
    $stmt = $db -> prepare($sql);
    $stmt->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
   
}