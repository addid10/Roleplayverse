<?php
    session_start();

    if(isset($_SESSION['usernameMember'])){
        unset($_SESSION['usernameMember']);
        unset($_SESSION['userAccountId']);
    
        header('location: https://www.roleplayverse.fufcadays.site/users/login'); 
        exit; 
    }
    else{
        header('location: https://www.roleplayverse.fufcadays.site/'); 
    }
?>