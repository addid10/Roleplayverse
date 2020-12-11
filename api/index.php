<?php
    require_once('../database/db.php');
    
    $roleplayCharacters = $connection->prepare("SELECT character_fullname, character_nickname, character_gender, school, faceclaim FROM `characters` LIMIT 100");
    $roleplayCharacters->execute();
    
    $characters = $roleplayCharacters->fetchAll(PDO::FETCH_OBJ);
    
    $result = array();
    $i = 0;
    foreach($characters as $character){
        $result[$i]["fullname"]  = $character->character_fullname;
        $result[$i]["nickname"]  = $character->character_nickname;
        $result[$i]["gender"]    = $character->character_gender;
        $result[$i]["school"]    = $character->school;
        $result[$i]["faceclaim"] = $character->faceclaim;
        $i++;
    }
    
    
    echo json_encode(['response' => $result]);
?>