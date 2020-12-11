<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {
    require_once('../database/db.php');

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = strtolower($_POST['username']);
        $password = $_POST['password'];
        $role     = '3';

        /* Validasi Akun */
        $validation = $connection->prepare(
            "SELECT users_id, password, role_id, active, COUNT(*) as count_users FROM users 
            WHERE username=:username AND role_id=:role");
        
        $validation->bindParam("username", $username);
        $validation->bindParam("role", $role);

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
                    $_SESSION['usernameAdmin']   = $username;
                    $_SESSION['adminAccountId']  = $id;

                    if(isset($_POST["remember"])){
                        $remember = $_POST["remember"];
                        
                        if ($remember==1){
                            setcookie ("admin_login", $username, time()+ (10 * 365 * 24 * 60 * 60));
                            setcookie ("admin_pwd", $password, time()+ (10 * 365 * 24 * 60 * 60));
                        }
                    }
                    else {
                        if(isset($_COOKIE["admin_login"])) {
                            setcookie ("admin_login", "");
                        }
                        if(isset($_COOKIE["admin_pwd"])) {
                            setcookie ("admin_pwd", "");
                        }
                    }
                    
                    echo '../';
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