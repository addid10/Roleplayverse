<?php
session_start();
if (isset($_POST['csrf_token']) && $_POST['csrf_token'] === $_SESSION['csrf_token']) {

    if(isset($_POST['password'])){
        $password = $_POST['password'];

        if($password == "lievemanis123") {
            
            echo 'nordlicher';
            $_SESSION['coloseum_name'] = "Nordlicher";
            $_SESSION['coloseum_code'] = $password;
        } else if ($password == "k0leseumz") {
            
            echo 'ccc';
            $_SESSION['coloseum_name'] = "CCC";
            $_SESSION['coloseum_code'] = $password;
        }
    }
}
?>