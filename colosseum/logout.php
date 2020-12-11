<?php
    session_start();

    if(isset($_SESSION['coloseum_name'])){
        unset($_SESSION['coloseum_name']);
        unset($_SESSION['coloseum_code']);
    
        header('location: ../colosseum'); 
        exit; 
    }
    else{
        header('location: ../colosseum'); 
    }
?>