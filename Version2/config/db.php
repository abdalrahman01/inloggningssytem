<?php
try {
    $db = new PDO('mysql:host=127.0.0.1;dbname=inloggning;charset=utf8','root','');
} catch (Exception $e) {
    header("Location: help.html#connection_denied");
}   
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

