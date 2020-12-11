<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if(isset($_POST['id'])){
        require_once('../database/db.php');

        $id     = $_POST['id'];

        $score  = $connection->prepare("SELECT (((COUNT(characters_rate_id)/(COUNT(characters_rate_id)+5))*AVG(rate))+((5/(COUNT(characters_rate_id)+5))*(SELECT AVG(RATE) FROM characters_rate))) as rate FROM characters_rate WHERE character_id=:id"); 
        $score->bindParam('id', $id);
        $score->execute();
        $total  = $score->fetch();
        $result = round($total['rate'],2);

        echo json_encode($result);
    }
        
}
?>