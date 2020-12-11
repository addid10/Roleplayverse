<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST['id'])) {
		$id	    = $_POST['id'];
		$fetch  = array();

		$statement = $connection->prepare(
			"SELECT * FROM characters WHERE character_id=:id"
		);
		
		$statement->bindParam("id", $id);
        $statement->execute();
        $result    = $statement->fetch();

        $fetch['name'] 		  = $result['character_fullname'];
		$fetch['id']   		  = $result['character_id'];
		$fetch['contributor'] = $result['character_contributor'];
		$fetch['attraction']  = $result['character_attraction'];
        
        echo json_encode($fetch);
	}
}
?>