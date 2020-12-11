<?php
    $fetch = $connection->prepare(
        "SELECT COUNT(*) FROM favorites WHERE character_id=:id
    "); 
    $fetch->bindParam('id', $id);
    $fetch->execute();
    $countFavorites = $fetch->fetchColumn();
?>