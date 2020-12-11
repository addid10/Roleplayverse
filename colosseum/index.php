<?php require_once('../layout/token.php'); ?>
<?php 
if(isset($_SESSION['coloseum_name'])) {
    if($_SESSION['coloseum_name'] == "Nordlicher"){
        header('location: nordlicher');
        exit;
    } 
    
    if($_SESSION['coloseum_name'] == "CCC") {
        header('location: ccc');
        exit;
    }
} 
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Colosseum Information Center</title>
    <link rel="shortcut icon" href="img/logo.png">
    <meta property="og:image" content="img/logo.png">
	<meta name="description" content="United Colosseum">
    <?php require_once('../layout/head.php'); ?>
    <link rel="stylesheet" href="css/colosseum.css">
</head>

<body>
    <div id="top"></div>

    <section id="contact" class="section-full">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mx-auto" >
                    <div class="pb-4 text-center">
                        <div class="title-content">
                            <h2 class="text-white text-uppercase">Information Center</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-30">
                    <form id="loginForm" method="POST" class="contact-form">
                        <div class="single-input color-2 mb-10">
                            <label class="text-uppercase text-white">Enter Your Password</label>
                            <input id="password" type="password" name="password" required maxlength="16">
                        </div>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" required>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center text-center text-white w-100">
                                Enter<span class="lnr lnr-arrow-right"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Audio -->
    <audio preload="auto" src="music/countdown.mp3" id="countdown"></audio>

    <!-- Footer -->
    <?php require_once('../layout/javascript.php'); ?>
    <script src="js/login.js"></script>

    <!-- Javascript for Users page -->
</body>

</html>