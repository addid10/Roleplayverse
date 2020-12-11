<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST['id'])) {
		
		$id	   = $_POST['id'];
		$image = get_image_roleplay_name($id);

		if($image != '') {
			unlink("../../../assets/img/roleplay/".$image);
		}
		$statement = $connection->prepare(
			"UPDATE roleplay SET roleplay_active=0 WHERE roleplay_id=:id"
		);
		
		$statement->bindParam("id", $id);
		$result = $statement->execute();
	}
}
?>