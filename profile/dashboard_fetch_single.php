<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST["id"])) {

		$id 	 = $_POST['id'];
		$result  = array();

		/* Ambil Data */
		$statement = $connection->prepare(
			"SELECT * FROM characters WHERE character_id=:id"
		);
		$statement->bindParam("id", $id);
		$statement->execute();
		$fetchData = $statement->fetchAll();
		
		/* Masukkan ke dalam Array */
		foreach($fetchData as $row) {
			$result["fullname"]    = $row["character_fullname"];
			$result["nickname"]    = $row["character_nickname"];
			$result["source"]      = $row["faceclaim_source"];
			$result["gender"]  	   = $row["character_gender"];
			$result["debut"]       = $row["first_appearance"];
			$result["quotes"]      = $row["quotes"];
			$result["race"]		   = $row["race_id"];
			$result["age"]	 	   = $row["character_age"];
			$result["partner"]     = $row["partner_id"];
			$result["storyline"]   = $row["background"];
			$result["personality"] = $row["personality"];
			$result["appearance"]  = $row["appearance"];
			$result["school"]      = $row["school"];

			if($row['faceclaim'] != '') {
				$result["faceclaim"] = 
				'<img src="../assets/img/oc/profile/'.$row["faceclaim"].'" class="img-thumbnail w-50">
				<input type="hidden" name="hidden_foto" value="'.$row["faceclaim"].'">';
			}
			else {
				$result['faceclaim'] = '<input type="hidden" name="hidden_foto" value="">';
			}
		}
		echo json_encode($result);
	}
}
?>