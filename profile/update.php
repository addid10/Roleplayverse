<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');
    require_once('../content/function.php');


    if(isset($_POST["name"]) && isset($_POST['phone']) && isset($_POST['location']) && isset($_POST['gender']) && preg_match('/^[a-zA-Z0-9\s-?!]+$/', $_POST['location']) && preg_match('/^[a-zA-Z0-9\s-?!]+$/', $_POST['name'])) {

        $image    = '';
        $id       = $_SESSION['userAccountId'];
        $name     = $_POST['name'];
        $phone    = $_POST['phone'];
        $location = $_POST['location'];
        $gender   = $_POST['gender'];


        if($_FILES["picture"]["name"] != '') {
            $image    = upload_photo();
            $oldImage = get_picture_name($id);

            if($image != $oldImage) {
                unlink("../assets/img/users/profile/".$oldImage);
            }

        } else {
            $image = $_POST["hidden_foto"];
        }

        $update = $connection->prepare(
            "UPDATE profile SET 
            fullname    = :name, 
            phone       = :phone,
            location    = :location,
            gender      = :gender,
            picture     = :image
            WHERE users_id = :id"
        );
        
        $update->bindParam("gender", $gender);
        $update->bindParam("name", $name);
        $update->bindParam("phone", $phone);
        $update->bindParam("location", $location);
        $update->bindParam("image", $image);
        $update->bindParam("id", $id);
        $update->execute();
        
        if ($update) {
            if($image == "default.png") {
                echo 1;
            }
        }
    }
}
?>