<?php
    function roleplay_list($id) {
        require('../database/db.php');

        $list = $connection->prepare("SELECT * FROM roleplay_characters JOIN roleplay USING(roleplay_id) 
        WHERE character_id=:id AND roleplay_active=1 ORDER BY roleplay_date ASC");
        $list->bindParam("id", $id);
        $list->execute();

        $roleplayList = $list->fetchAll();
        foreach ($roleplayList as $row){
            echo '
            <a class="roleplay-list" href="../roleplay_stories/'.$row['roleplay_id'].'">
                '.$row['roleplay_name'].'
            </a><br>
            ';
        }
    }
?>
