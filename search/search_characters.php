<?php 
    if(isset($_GET['q'])) {

        $resultChara = $connection->prepare(
            "SELECT *, (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) as average FROM characters 
            LEFT JOIN characters_rate USING(character_id)
            WHERE active=1 AND character_fullname RLIKE :like
            GROUP BY character_id ORDER BY average DESC LIMIT :limit
        ");
        $resultChara->bindParam("like", $search);
        $resultChara->bindParam("limit", $limit);
        $resultChara->execute();
        $rowChara = $resultChara->fetchAll();


    }
?>