<?php
require_once('../database/db.php');

$race = $connection->prepare("SELECT * FROM race ORDER BY race_name ASC");
$race->execute();
$resultRace = $race->fetchAll(PDO::FETCH_OBJ);

?>