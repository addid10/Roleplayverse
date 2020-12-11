<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST['id'])) {
		$fetch = array();
		$id	   = $_POST['id'];

		$statement = $connection->prepare(
			"SELECT * FROM roleplay WHERE roleplay_id=:id"
		);
		
		$statement->bindParam("id", $id);
        $statement->execute();
        $result    = $statement->fetch();

        $fetch['name']  = $result['roleplay_name'];
        $fetch['id']    = $result['roleplay_id'];
        $fetch['score'] = $result['roleplay_score'];
        
        echo json_encode($fetch);
	}
}
?>