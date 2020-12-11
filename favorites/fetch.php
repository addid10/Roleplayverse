<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if(isset($_POST['id'])){
        require_once('../database/db.php');

        $id    = $_POST['id'];

        $fetch = $connection->prepare("SELECT COUNT(*) FROM favorites WHERE character_id=:id"); 
        $fetch->bindParam('id', $id);
        $fetch->execute();
        $result = $fetch->fetchColumn();

        echo json_encode($result);
    }
        
}
?>