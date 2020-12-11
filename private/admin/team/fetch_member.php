<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
	require_once('../database/db.php');

	if(isset($_POST['id'])) {
        $id	   = $_POST['id'];
        $data  = '';

		$statement = $connection->prepare(
			"SELECT * FROM affiliation_member 
            JOIN affiliation USING(affiliation_id) 
            JOIN characters USING(character_id) WHERE affiliation_id=:id ORDER BY position"
		);
		
		$statement->bindParam("id", $id);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_OBJ);

        $data .= '
        <div class="roleplay-information">
            <table class="table table-characters table-hover">
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Action</th>
                </tr>';

        foreach ($result as $row) {
            $data .= '
                <tr>
                    <td width="3%"><img class="roleplay-characters" src="../../../assets/img/oc/profile/'.$row->faceclaim.'"></td>
                    <td>'.$row->character_fullname.'</td>
                    <td>'.$row->position.'</td>
                    <td><button type="button" id="'.$row->affiliation_member_id.'" class="btn hor-grd btn-danger closed">&times;</button></td>
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