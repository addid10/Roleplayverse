<?php 
    require_once('../database/db.php');
    $position = "Leader";

    $team = $connection->prepare(
        "SELECT affiliation_id, affiliation_name, affiliation_description, character_fullname, faceclaim 
        FROM affiliation JOIN affiliation_member USING(affiliation_id) 
        JOIN characters USING(character_id) WHERE position=:position"
    );
    $team->bindParam("position", $position);
    $team->execute();

    $rows = $team->fetchAll(PDO::FETCH_OBJ);

?>