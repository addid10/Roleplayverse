<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if(isset($_SESSION['userAccountId']) && isset($_POST['id'])){
        require_once('../database/db.php');
        require_once('../content/function.php');

        $id   = $_POST['id'];
        $user = $_SESSION['userAccountId'];


        $count = favorites($id, $user);
        if($count == 0){
            $add = $connection->prepare(
                "INSERT INTO favorites (character_id, users_id) VALUES(:id, :user)
            ");
            $add->bindParam("id", $id);
            $add->bindParam("user", $user);
            $add->execute();
            echo 2;
            exit;
        }
        else {
            $delete = $connection->prepare(
                "DELETE FROM favorites WHERE character_id=:id AND users_id=:user
            ");
            $delete->bindParam("id", $id);
            $delete->bindParam("user", $user);
            $delete->execute();
            echo 0;
            exit;
        }
    } else {
        echo 1;
        exit;
    }
}
?>