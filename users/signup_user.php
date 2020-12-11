<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    if(isset($_POST['fname']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
        require_once('../database/db.php');
        
        if(preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])) {
        //Variable dari Form
        $firstname  = $_POST['fname'];
        $lastname   = $_POST['lname'];
        $username   = strtolower($_POST['username']);
        $email      = $_POST['email'];
        $password   = $_POST['password'];
        $agree      = $_POST['agreement'];
        $role       = 1; //Member
        
        //Variable lain yang berkaitan
        $newPassword = password_hash($password, PASSWORD_DEFAULT);
        $token       = crypt($username, "roleplayVerse");
        $create      = date("y-m-d");
        $active      = 1;

        //Validasi username
        $usernameValidation = $connection->prepare(
            "SELECT COUNT(username) from users where username=:username");
        $usernameValidation->bindParam("username", $username);
        $usernameValidation->execute();
        $countUsername = $usernameValidation->fetchColumn();

        if($countUsername == "1"){
            echo 'signup?status=Username tidak tersedia!';
            exit;
        }
        else {
            //Validasi Email
            $emailValidation = $connection->prepare(
                "SELECT COUNT(email) from users where email=:email");
            $emailValidation->bindParam("email", $email);
            $emailValidation->execute();
            $countEmail = $emailValidation->fetchColumn();

            if($countEmail == "1"){
                echo 'signup?status=Email tidak tersedia!';
                exit;
            }
            else {
                //Input data users ke database
                $add = $connection->prepare(
                    "INSERT INTO users (role_id, username, email, password, active, create_at, verify_token, agreement) 
                    VALUES (:role, :username, :email, :password, :active, :create_at, :token, :agree)"
                );
    
                $add->bindParam("role", $role);
                $add->bindParam("username", $username);
                $add->bindParam("email", $email);
                $add->bindParam("password", $newPassword);
                $add->bindParam("active", $active);
                $add->bindParam("create_at", $create);
                $add->bindParam("token", $token);
                $add->bindParam("agree", $agree);

                $result = $add->execute();
                if($result){
                    /* Cek ID Terakhir */
                    $id       = $connection->lastInsertId();
                    $fullname = $firstname.' '.$lastname;

                    $profile = $connection->prepare(
                        "INSERT INTO profile (users_id, fullname) 
                        VALUES (:id, :fullname)"
                    ); 
                    $profile->bindParam("id", $id);
                    $profile->bindParam("fullname", $fullname);
                    $session = $profile->execute();

                    if($session){
                        $_SESSION['usernameMember'] = $username;
                        $_SESSION['userAccountId']  = $id;

                        
                        /*Lokasi*/
                        echo '../profile/'.$username;
                        exit;
                    }
                }
            }
        }
        }
    }
}

?>