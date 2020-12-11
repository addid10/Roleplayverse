<?php session_start();
if(!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = base64_encode(openssl_random_pseudo_bytes(32));
}
?>

<?php if(isset($_SESSION['usernameAdmin'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Awards :: Roleplayverse</title>
<?php require_once('../layout/header.php'); ?>
</head>
<body>
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <nav class="navbar header-navbar pcoded-header">
               <?php require_once('../layout/navigation.php'); ?>
           </nav>
            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <?php require_once('../layout/menu.php'); ?>
                    </nav>
                    <div class="pcoded-content">
                        <div class="pcoded-inner-content">
                            <img src="../../../assets/img/comingsoon.png" class="w-100 mt-5">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php require_once('../layout/javascript.php'); ?>
<?php require_once('../layout/token_ajax.php'); ?>
<?php require_once('../layout/custom_javascript.php'); ?>
<?php else: ?>
<?php header('location: ../users/login'); ?>
<?php endif; ?>