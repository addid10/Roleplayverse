<?php
require_once('../database/db.php');

$roleplay = $connection->prepare("SELECT * FROM roleplay WHERE roleplay_active=1 ORDER BY roleplay_name ASC");
$roleplay->execute();
$resultRoleplay = $roleplay->fetchAll(PDO::FETCH_OBJ);

?>