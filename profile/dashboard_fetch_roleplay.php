<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST['id'])) {
        $id	   = $_POST['id'];
        $data  = '';

		$statement = $connection->prepare(
			"SELECT * FROM roleplay_characters 
            JOIN roleplay USING(roleplay_id) 
            JOIN characters USING(character_id) WHERE character_id=:id"
		);
		
		$statement->bindParam("id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $data .= '
        <div class="roleplay-information table-responsive">
            <table class="table table-characters table-hover">
                <tr>
                    <th>Image</th>
                    <th>Roleplay</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>';

        foreach ($result as $row) {
            $data .= '
            
                <tr>
                    <td width="3%"><img class="roleplay-characters" src="../assets/img/roleplay/'.$row->roleplay_cover.'"></td>
                    <td>'.$row->roleplay_name.'</td>
                    <td>'.$row->role.'</td>
                    <td width="5%"><button type="button" id="'.$row->roleplay_characters_id.'" class="btn hor-grd btn-danger closed">&times;</button></td>
                </tr>
            ';
        }

        $data .= '
            </table>
        </div>';
        
        echo json_encode($data);
	}
}
?>