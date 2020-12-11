<?php
    $category = $connection->prepare("SELECT * FROM category");
    $category->execute();
    $list = $category->fetchAll(PDO::FETCH_OBJ);
?>