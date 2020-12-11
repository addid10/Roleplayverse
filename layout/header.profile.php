<?php
if(isset($_SESSION['userAccountId']) && isset($_SESSION['usernameMember'])) {
    $userId = $_SESSION['userAccountId'];
    $pictures = $connection->prepare("SELECT picture FROM profile WHERE users_id=:id");
    $pictures->bindParam("id", $userId);
    $pictures->execute();
    $picture = $pictures->fetch();
}
?>