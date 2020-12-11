<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST["id"])) {

		$id 	 = $_POST['id'];
		$result  = array();

		/* Ambil Data */
		$statement = $connection->prepare(
			"SELECT * FROM affiliation WHERE affiliation_id=:id"
		);
		$statement->bindParam("id", $id);
		$statement->execute();
		$fetchData = $statement->fetchAll();
		
		/* Masukkan ke dalam Array */
		foreach($fetchData as $row) {
			$result["name"]        = $row["affiliation_name"];
			$result["description"] = $row["affiliation_description"];
		}
		echo json_encode($result);
	}
}
?>