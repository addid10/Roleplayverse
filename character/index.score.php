<?php
    $score = $connection->prepare("SELECT (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) as rate FROM characters_rate WHERE character_id=:id"); 
    $score->bindParam('id', $id);
    $score->execute();
    $total = $score->fetch();
?>