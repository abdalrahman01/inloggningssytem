<?php
if(isset($_POST["update"])) {
    require_once "config\\db.php";

    $sql = "UPDATE posts SET posts.post_title = :post_title, posts.post_content = :post_content WHERE posts.post_id = :post_id";
   
    $stmt = $db -> prepare($sql);
    $stmt->bindValue(":post_title", $_POST["post_title"]);
    $stmt->bindValue(":post_content", $_POST["post_content"]);
    $stmt->bindValue(":post_id", $_POST["post_id"]);
    $stmt->execute();

    header("Location: admin_page.php");
}

