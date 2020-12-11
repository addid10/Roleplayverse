<?php
    $member = $connection->prepare(
        "SELECT * FROM affiliation_member JOIN characters USING(character_id)
        WHERE affiliation_id=:id AND position NOT IN(:position) AND active=1
    ");
    $member->bindParam("id", $id);
    $member->bindParam("position", $position);
    $member->execute();
    $memberRow = $member->fetchAll();
?>