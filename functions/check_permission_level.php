<?php
require_once "../config/db.php";


$sql = "SELECT * FROM permissions WHERE 1";
$stmt = $db -> prepare($sql);
$stmt->execute();

function isAdmin($permssion_level){
    return 0;
}