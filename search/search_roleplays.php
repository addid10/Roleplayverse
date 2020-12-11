<?php 
    if(isset($_GET['q'])) {

        $resultRp = $connection->prepare(
            "SELECT * FROM roleplay WHERE roleplay_active=1 AND roleplay_name RLIKE :like ORDER BY roleplay_score DESC LIMIT :limit
        ");

        $resultRp->bindParam("like", $search);
        $resultRp->bindParam("limit", $limit);
        $resultRp->execute();
        $rowRp = $resultRp->fetchAll();


    }
?>