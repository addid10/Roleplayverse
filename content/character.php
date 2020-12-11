<?php
require_once('../database/db.php');

$chara = $connection->prepare("SELECT * FROM characters WHERE active=1 ORDER BY character_fullname ASC");
$chara->execute();
$resultChara = $chara->fetchAll(PDO::FETCH_OBJ);

?>