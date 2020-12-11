<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST["id"])) {
		$id 	 = $_POST['id'];
		$result  = array();

		/* Ambil Data */
		$statement = $connection->prepare(
			"SELECT * FROM news WHERE news_id=:id"
		);
		$statement->bindParam("id", $id);
		$statement->execute();
		$fetchData = $statement->fetchAll();
		
		/* Masukkan ke dalam Array */
		foreach($fetchData as $row) {
			$result["title"]	= $row["title"];
			$result["contents"] = $row["contents"];
			$result["category"] = $row["category_id"];
			$result["users"] 	= $row["users_id"];
			
			if($row['photos'] != '') {
				$result["photos"] = 
				'<img src="../../../assets/img/news/'.$row["photos"].'" class="img-thumbnail w-50">
				<input type="hidden" name="hidden_foto" value="'.$row["photos"].'">';
			}
			else {
				$result['photos'] = '<input type="hidden" name="hidden_foto" value="">';
			}
		}
		echo json_encode($result);
	}
}
?>