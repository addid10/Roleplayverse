<?php
  session_start();
  if(isset($_SESSION['usernameAdmin'])) {
    unset($_SESSION['usernameAdmin']);
    unset($_SESSION['adminAccountID']);

    header('Location: ../users/login');
  }
?>