<?php
require_once('../database/db.php');

$author = $connection->prepare("SELECT * FROM users WHERE active=1 ORDER BY username ASC");
$author->execute();
$resultAuthor = $author->fetchAll(PDO::FETCH_OBJ);

?>