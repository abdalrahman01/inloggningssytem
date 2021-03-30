<?php
 $db = new PDO(
    'mysql:host=127.0.0.1;dbname=inloggning;charset=utf8',
    'root',
    ''
);

// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
// $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// den gör att PDO tolkar inte queries innan dem skickas 
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
