<?php 
    $check = $connection->prepare(
        "SELECT COUNT(*) FROM characters WHERE author=:id AND active=1 
    ");
    $check->bindParam("id", $id);
    $check->execute();
    $checking = $check->fetchColumn();
?>