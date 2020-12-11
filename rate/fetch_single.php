<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if(isset($_POST['id']) && isset($_SESSION['userAccountId'])){
        require_once('../database/db.php');

        $id     = $_POST['id'];
        $user   = $_SESSION['userAccountId'];
        $result = array();

        $score  = $connection->prepare("SELECT * FROM characters_rate WHERE character_id=:id AND users_id=:user"); 
        $score->bindParam('id', $id);
        $score->bindParam('user', $user);
        $score->execute();
        $rate   = $score->fetch(); 
        

        if(!empty($rate['rate'])){
            $result['action'] = "Edit";
            $result['rate'] = $rate['rate'];
            $result['id'] = $rate['characters_rate_id'];
        } else {
            $result['action'] = "Add";
            $result['rate'] = 0;
        }

        echo json_encode($result);
    }
        
}
?>