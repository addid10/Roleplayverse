<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('../function/function.php');

	if(isset($_POST["roleplay_name"]) && isset($_POST['othername']) && isset($_POST['release_date']) && isset($_POST['creators']) && isset($_POST['roleplay_type']) && isset($_POST['source'])) {

		$name 		= $_POST['roleplay_name'];
		$othername  = $_POST['othername'];
		$date      	= $_POST['release_date'];
		$creator  	= $_POST['creators'];
		$type  	   	= $_POST['roleplay_type'];
		$source     = $_POST['source'];
		$active     = 1;
		$synopsis  	= $_POST['synopsis'];

		if ($source == "Fandom") {
			$sourceNew = $_POST['fandom'];
		} else {
			$sourceNew = "Original";
		}

		if(isset($_POST['chapters']) && isset($_POST['genres']) && isset($_POST['multiverse'])) {
			$chapters  	= $_POST['chapters'];
			$multiverse = $_POST['multiverse'];
			$status  	= $_POST['roleplay_status'];
			$genres		= '';

			foreach ($_POST['genres'] as $row) {
				$genres .= $row . ', ';
			}

			$genres 	= substr($genres, 0, -2);

			if($multiverse == 1) {
				$ranking 		= $_POST['multiverse_ranking'];
				$condition 		= $_POST['condition'];
				$year 			= $_POST['multiverse_year'];
				$characteristic = $_POST['characteristic'];
				$worlds 		= $_POST['worlds'];
			}
		} else {
			$chapters  		= '';
			$multiverse 	= '';
			$genres			= '';
			$status			= '';
			$ranking 		= '';
			$condition 		= '';
			$year 			= '';
			$characteristic = '';
			$worlds 		= '';
		}

		//Add
		if($_POST["operation"] == "Add") {

			$image = '';
			if($_FILES["cover"]["name"] != '') {
				$image = upload_roleplay_cover();
			}

			$add = $connection->prepare(
			"INSERT INTO roleplay (roleplay_name, roleplay_other_name, roleplay_type, roleplay_chapters, 
			roleplay_status, roleplay_source, roleplay_creator, roleplay_genres, multiverse, universe_ranking,
			universe_year, universe_world, universe_condition, universe_characteristic, universe_synopsis, 
			roleplay_cover, roleplay_date, roleplay_active) 
			VALUES (:name, :othername, :type, :chapters, :status, :source, :creator, :genres, :multiverse, :ranking, 
			:year, :worlds, :condition, :characteristic, :synopsis, :image, :date, :active)
			");

			$add->bindParam("name", $name);
			$add->bindParam("othername", $othername);
			$add->bindParam("date", $date);
			$add->bindParam("creator", $creator);
			$add->bindParam("type", $type);
			$add->bindParam("source", $sourceNew);
			$add->bindParam("chapters", $chapters);
			$add->bindParam("synopsis", $synopsis);
			$add->bindParam("multiverse", $multiverse);
			$add->bindParam("genres", $genres);
			$add->bindParam("ranking", $ranking);
			$add->bindParam("condition", $condition);
			$add->bindParam("year", $year);
			$add->bindParam("characteristic", $characteristic);
			$add->bindParam("worlds", $worlds);
			$add->bindParam("image", $image);
			$add->bindParam("status", $status);
			$add->bindParam("active", $active);
			$add->execute();
			
			if ($add) {
                if($image == "default.png") {
                    echo 1;
                }
            }
		}

		//Edit
		if($_POST["operation"] == "Edit")
		{
			$image = '';
			$id = $_POST['roleplay_id'];

			/* Foto */
			if($_FILES["cover"]["name"] != '') {
				$image    = upload_roleplay_cover();
				$oldImage = get_image_roleplay_name($id);

				if($image != $oldImage) {
					unlink("../../../assets/img/roleplay/".$oldImage);
				}

			} else {
				$image = $_POST["hidden_foto"];
			}

			$update = $connection->prepare(
				"UPDATE roleplay SET 
				roleplay_name	 		= :name, 
				roleplay_other_name 	= :othername,
				roleplay_type    		= :type,
				roleplay_chapters       = :chapters,
				roleplay_status      	= :status,
				roleplay_source  		= :source,
				roleplay_creator    	= :creator,
				roleplay_genres         = :genres,
				multiverse      		= :multiverse,
				universe_ranking  		= :ranking,
				universe_year    		= :year,
				universe_world          = :worlds,
				universe_condition      = :condition,
				universe_characteristic	= :characteristic,
				universe_synopsis		= :synopsis,
				roleplay_cover		 	= :image,
				roleplay_date		 	= :date
				WHERE roleplay_id 		= :id"
			);
			
			$update->bindParam("id", $id);
			$update->bindParam("name", $name);
			$update->bindParam("othername", $othername);
			$update->bindParam("date", $date);
			$update->bindParam("creator", $creator);
			$update->bindParam("type", $type);
			$update->bindParam("source", $sourceNew);
			$update->bindParam("chapters", $chapters);
			$update->bindParam("synopsis", $synopsis);
			$update->bindParam("multiverse", $multiverse);
			$update->bindParam("genres", $genres);
			$update->bindParam("ranking", $ranking);
			$update->bindParam("condition", $condition);
			$update->bindParam("year", $year);
			$update->bindParam("characteristic", $characteristic);
			$update->bindParam("worlds", $worlds);
			$update->bindParam("image", $image);
			$update->bindParam("status", $status);
			$update->execute();

            if ($update) {
                if($image == "default.png") {
                    echo 1;
                }
            }

		}
	}
}
?>