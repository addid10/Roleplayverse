<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST["id"])) {

		$id 	 = $_POST['id'];
		$result  = array();

		/* Ambil Data */
		$statement = $connection->prepare(
			"SELECT * FROM roleplay WHERE roleplay_id=:id"
		);
		$statement->bindParam("id", $id);
		$statement->execute();
		$fetchData = $statement->fetchAll();
		
		/* Masukkan ke dalam Array */
		foreach($fetchData as $row) {

			$result["name"]  	 = $row["roleplay_name"];
			$result["othername"] = $row["roleplay_other_name"];
			$result["type"]    	 = $row["roleplay_type"];
			$result["chapters"]  = $row["roleplay_chapters"];
			$result["status"]    = $row["roleplay_status"];
			$result["source"]    = $row["roleplay_source"];
			$result["creators"]  = $row["roleplay_creator"];
			$result["genres"]    = explode(', ',$row["roleplay_genres"]);
			$result["verse"]	 = $row["multiverse"];
			$result["ranking"]   = $row["universe_ranking"];
			$result["year"]      = $row["universe_year"];
			$result["world"]     = $row["universe_world"];
			$result["condition"] = $row["universe_condition"];
			$result["character"] = $row["universe_characteristic"];
			$result["synopsis"]  = $row["universe_synopsis"];
			$result["date"]      = $row["roleplay_date"];

			if($row['roleplay_cover'] != '') {
				$result["cover"] = 
				'<img src="../../../assets/img/roleplay/'.$row["roleplay_cover"].'" class="img-thumbnail w-50">
				<input type="hidden" name="hidden_foto" value="'.$row["roleplay_cover"].'">';
			}
			else {
				$result['cover'] = '<input type="hidden" name="hidden_foto" value="">';
			}
		}
		echo json_encode($result);
	}
}
?>