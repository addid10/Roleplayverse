<?php
require_once('../database/db.php');

$category = $connection->prepare("SELECT * FROM category ORDER BY category_name ASC");
$category->execute();
$resultCategory = $category->fetchAll(PDO::FETCH_OBJ);

?>