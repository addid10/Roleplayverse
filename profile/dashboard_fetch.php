<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if(isset($_SESSION['usernameMember'])) {
        require_once('../database/db.php');
        require_once('dashboard_function.php');
    
        $getCharacter   = '';
        $id             = $_SESSION['userAccountId'];
        $fetchCharacter = array();
        $getCharacter .= "SELECT * FROM characters WHERE active=1 AND author=:id ";
    
        if(isset($_POST["search"]["value"]))
        {
            $getCharacter .= 'AND character_fullname RLIKE :search ';
        }
        if(isset($_POST["order"]))
        {
            $getCharacter .= 'ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
        }
        else
        {
            $getCharacter .= 'ORDER BY character_fullname ASC ';
        }
        if($_POST["length"] != -1)
        {
            $getCharacter .= 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
        }
    
    
        $statement = $connection->prepare($getCharacter);
        $statement->bindParam("search", $_POST["search"]["value"]);
        $statement->bindParam("id", $id);
        $statement->execute();
        $result    = $statement->fetchAll();
        $data      = array();
        $rowCount  = $statement->rowCount();
        foreach($result as $row)
        {
            $sub_array = array();
    
            $sub_array[] = '<a target="_blank" href="../character/'.$row["character_id"].'">'.$row['character_fullname'].'</a>';
            $sub_array[] = favorites($row["character_id"]);
            if(!empty(score($row['character_id']))){
                $sub_array[] = round(score($row["character_id"]),2);
            } else { 
                $sub_array[] = '<span class="badge badge-pill badge-danger">Belum Dinilai</span>';
            }
            $sub_array[] = '<button type="button" id="'.$row["character_id"].'" class="btn btn-primary roleplay">Roleplay</button>';
            $sub_array[] = '<button type="button" id="'.$row["character_id"].'" class="btn btn-info update">Update</button>';
            $sub_array[] = '<button type="button" id="'.$row["character_id"].'" class="btn btn-danger delete">Delete</button>';
            $data[] = $sub_array;
        }
        $fetchCharacter = array(
            "draw"				=>	intval($_POST["draw"]),
            "recordsTotal"		=> 	$rowCount,
            "recordsFiltered"	=>	get_total_oc_records($id),
            "data"				=>	$data
        );
        echo json_encode($fetchCharacter);

    }
}
?>


