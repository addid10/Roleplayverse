<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');
	require_once('dashboard_function.php');

	if(isset($_SESSION["userAccountId"]) && isset($_POST['fullname']) && isset($_POST['nickname']) && isset($_POST['gender']) && isset($_POST['first_appearance']) && isset($_POST['quotes'])) {
        $pattern = '/^[<>$#=]+$/';
        if(preg_match($pattern, $_POST['fullname']) || preg_match($pattern, $_POST['nickname']) || preg_match($pattern, $_POST['first_appearance']) || preg_match($pattern, $_POST['quotes'])
         || preg_match($pattern, $_POST['source']) || preg_match($pattern, $_POST['school']) || preg_match($pattern, $_POST['storyline']) || preg_match($pattern, $_POST['personality'])
          || preg_match($pattern, $_POST['appearance'])){
              echo 5;
        } else {
            
    		$author 	 = $_SESSION['userAccountId'];
    		$source  	 = $_POST['source'];
    		$fullname    = $_POST['fullname'];
    		$nickname  	 = $_POST['nickname'];
    		$gender  	 = $_POST['gender'];
    		$debut       = $_POST['first_appearance'];
    		$quotes      = $_POST['quotes'];
    		$race     	 = $_POST['race'];
    		$age     	 = $_POST['age'];
    		$school      = $_POST['school'];
    		$partner     = $_POST['partner'];
    		$storyline   = $_POST['storyline'];
    		$personality = $_POST['personality'];
    		$appearance  = $_POST['appearance'];
    		$active		 = 1;
    		date_default_timezone_set("Asia/Jakarta");
    		$date        = date('Y-m-d H:i:s');
    
    		//Add
    		if($_POST["operation"] == "Add") {
    
    			$image = '';
    			if($_FILES["faceclaim"]["name"] != '') {
    				$image = upload_faceclaim();
    			}
    
    			$add = $connection->prepare(
    			"INSERT INTO characters (character_fullname, character_nickname, faceclaim, faceclaim_source, 
    			character_gender, first_appearance, quotes, race_id, character_age, partner_id,
    			background, personality, appearance, author, school, active, create_at) 
    			VALUES (:fullname, :nickname, :image, :source, :gender, :debut, :quotes, :race, :age, :partner, 
    			:storyline, :personality, :appearance, :author, :school, :active, :date)
    			");
    
    			$add->bindParam("fullname", $fullname);
    			$add->bindParam("nickname", $nickname);
    			$add->bindParam("image", $image);
    			$add->bindParam("source", $source);
    			$add->bindParam("gender", $gender);
    			$add->bindParam("debut", $debut);
    			$add->bindParam("quotes", $quotes);
    			$add->bindParam("race", $race);
    			$add->bindParam("age", $age);
    			$add->bindParam("partner", $partner);
    			$add->bindParam("storyline", $storyline);
    			$add->bindParam("personality", $personality);
    			$add->bindParam("appearance", $appearance);
    			$add->bindParam("author", $author);
    			$add->bindParam("school", $school);
    			$add->bindParam("active", $active);
    			$add->bindParam("date", $date);
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
    			$id = $_POST['character_id'];
    
    			/* Foto */
    			if($_FILES["faceclaim"]["name"] != '') {
    				$image    = upload_faceclaim();
    				$oldImage = get_image_character_name($id);
    
    				if($image != $oldImage) {
    					unlink("../assets/img/oc/profile/".$oldImage);
    				}
    
    			} else {
    				$image = $_POST["hidden_foto"];
    			}
    
    			$update = $connection->prepare(
    				"UPDATE characters SET 
    				character_fullname = :fullname, 
    				character_nickname = :nickname,
    				faceclaim    	   = :image,
    				faceclaim_source   = :source,
    				character_gender   = :gender,
    				first_appearance   = :debut,
    				quotes    		   = :quotes,
    				race_id            = :race,
    				character_age      = :age,
    				partner_id  	   = :partner,
    				background    	   = :storyline,
    				personality        = :personality,
    				appearance         = :appearance,
    				author			   = :author,
    				school			   = :school
    				WHERE character_id = :id"
    			);
    			
    			$update->bindParam("id", $id);
    			$update->bindParam("fullname", $fullname);
    			$update->bindParam("nickname", $nickname);
    			$update->bindParam("image", $image);
    			$update->bindParam("source", $source);
    			$update->bindParam("gender", $gender);
    			$update->bindParam("debut", $debut);
    			$update->bindParam("quotes", $quotes);
    			$update->bindParam("race", $race);
    			$update->bindParam("age", $age);
    			$update->bindParam("partner", $partner);
    			$update->bindParam("storyline", $storyline);
    			$update->bindParam("personality", $personality);
    			$update->bindParam("appearance", $appearance);
    			$update->bindParam("author", $author);
    			$update->bindParam("school", $school);
    			$update->bindParam("id", $id);
    			$update->execute();
    
                if ($update) {
                    if($image == "default.png") {
                        echo 1;
                    }
                }
                
    		}
        }
	}
}
?>