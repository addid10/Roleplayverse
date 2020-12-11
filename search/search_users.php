<?php 
    if(isset($_GET['q'])) {
        $resultUsers = $connection->prepare(
            "SELECT * FROM users JOIN profile USING(users_id) WHERE active=1 AND 
            fullname RLIKE :like LIMIT :limit
        ");

        $resultUsers->bindParam("like", $search);
        $resultUsers->bindParam("limit", $limit);
        $resultUsers->execute();
        $rowUsers = $resultUsers->fetchAll();
    }
?>