<?php

    $affiliation = $connection->prepare(
        "SELECT * FROM affiliation JOIN affiliation_member USING(affiliation_id) WHERE character_id=:id"
    );
    $affiliation->bindParam("id", $id);
    $affiliation->execute();
    $resultAff = $affiliation->fetchAll();

?>