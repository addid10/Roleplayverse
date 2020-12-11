<?php

    $roleplay = $connection->prepare(
        "SELECT * FROM roleplay_characters JOIN roleplay USING(roleplay_id) WHERE character_id=:id AND roleplay_active=1 ORDER BY roleplay_date"
    );
    $roleplay->bindParam("id", $id);
    $roleplay->execute();
    $resultRoleplay = $roleplay->fetchAll();

?>