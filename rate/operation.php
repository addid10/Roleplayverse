<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

	if(isset($_SESSION["userAccountId"]) && isset($_POST['score']) && isset($_POST['character'])) {
        require_once('../database/db.php');

		$user   	 = $_SESSION['userAccountId'];
        $chara       = $_POST['character'];
        
        
        if($chara==8000020) {
            $score       = 10;
        } else {
            $score  	 = $_POST['score'];
        }

		//Add
		if($_POST['operation'] == "Add") {
		    
		    $check = $connection->prepare(
		        "SELECT COUNT(*) FROM characters_rate WHERE users_id=:user AND character_id=:chara
		    ");
			$check->bindParam("chara", $chara);
		    $check->bindParam("user", $user);
		    $check->execute();
		    $countCheck = $check->fetchColumn();
		    
		    if($countCheck == 0) {

    			$add = $connection->prepare(
    			"INSERT INTO characters_rate (rate, users_id, character_id)
    			VALUES (:score, :user, :chara)
    			");
    
    			$add->bindParam("score", $score);
    			$add->bindParam("user", $user);
    			$add->bindParam("chara", $chara);
                $add->execute();
                
                echo 0;
		        
		    }
		}

		//Edit
		if($_POST["operation"] == "Edit")
		{
			$id = $_POST['id'];

			$update = $connection->prepare(
				"UPDATE characters_rate SET 
				rate = :rate
				WHERE characters_rate_id = :id"
			);
			
			$update->bindParam("id", $id);
			$update->bindParam("rate", $score);
			$update->execute();

            echo 0;
		}
	} else {
        echo 1;
    }
}
?>