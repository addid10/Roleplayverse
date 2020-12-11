<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');

    if(isset($_POST['id']))
    {
        $data  = array();
        $id    = $_POST['id'];

        $statement = $connection->prepare(
        "SELECT race_description, race_name FROM race WHERE race_id=:id
        ");

        $statement->bindParam("id", $id);
        $statement->execute();
        $result = $statement->fetch();

        $data['description'] = $result['race_description'];
        $data['name'] = $result['race_name'];

        echo json_encode($data);
    }
}
?>