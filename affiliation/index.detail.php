<?php
    $id = addslashes($_GET['id']);
    require_once('../database/db.php');

    $affiliation = $connection->prepare("SELECT *, COUNT(*) as count FROM affiliation WHERE affiliation_id=:id");
    $affiliation->bindParam("id", $id);
    $affiliation->execute();
    $row = $affiliation->fetch();
?>