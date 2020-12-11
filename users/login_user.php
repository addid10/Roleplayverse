<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');

    if(isset($_POST['username']) && isset($_POST['password']) && preg_match('/^[a-zA-Z0-9]+$/', $_POST['username'])){
        $username = strtolower($_POST['username']);
        $password = $_POST['password'];

        /* Validasi Akun */
        $validation = $connection->prepare(
            "SELECT users_id, password, active, COUNT(*) as count_users FROM users 
            WHERE username=:username");
        
        $validation->bindParam("username", $username);
        $validation->execute();
        $row = $validation->fetch();

        /* Nilai User dalam Database */
        $id     = $row['users_id'];
        $pass   = $row['password'];
        $active = $row['active'];
        $count  = $row['count_users'];

        if($count == 1) {
            if($active == 1){
                if(password_verify($password, $pass) == $password){
                    $_SESSION['usernameMember']   = $username;
                    $_SESSION['userAccountId']    = $id;

                    if(isset($_POST["remember"])){
                        $remember = $_POST["remember"];
                        
                        if ($remember==1){
                            setcookie ("user_login", $username, time()+ (10 * 365 * 24 * 60 * 60));
                            setcookie ("user_pwd", $password, time()+ (10 * 365 * 24 * 60 * 60));
                        }
                    }
                    else {
                        if(isset($_COOKIE["user_login"])) {
                            setcookie ("user_login", "");
                        }
                        if(isset($_COOKIE["user_pwd"])) {
                            setcookie ("user_pwd", "");
                        }
                    }
                    
                    echo '../profile/'.$username;
                    exit;
                }
                echo 'login?status=Username atau password salah!';
                exit;
            }
            echo 'login?status=Akun kamu telah diblokir!';
            exit;
        }
        echo 'login?status=Username atau password salah!';
        exit;
    }
}
?>