<?php require_once('../layout/token.php'); ?>
<?php if(isset($_SESSION['usernameMember'])): ?>
<?php header('location: ../'); ?>
<?php else: ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Login :: Roleplayverse</title>
	<meta property="og:image" content="../ovakun/aovchan/aman/banner2.png">
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>

    <!-- Login -->
    <section id="contact" class="section-full login-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="pb-4 pt-5 text-center">
                        <h2 class="text-white"><img src="../ovakun/aovchan/aman/fav.png" class="pr-2" width="60px">Login</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <?php if(isset($_GET['status'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="fa fa-exclamation-circle pr-1"></i> <?= $_GET['status']; ?>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-30">
                    <form id="loginForm" method="POST" class="contact-form">
                        <div class="single-input mb-10">
                            <input id="username" type="text" name="username" placeholder="Username" required maxlength="20"
                                value="<?php if(isset($_COOKIE['user_login'])){ echo $_COOKIE['user_login'];} ?>" pattern="[0-9A-Za-z]+">
                        </div>
                        <div class="single-input color-2 mb-10">
                            <input id="password" type="password" name="password" placeholder="Password" required maxlength="16"
                            value="<?php if(isset($_COOKIE['user_pwd'])){ echo $_COOKIE['user_pwd'];} ?>">
                        </div>
                        <div class="single-input color-2 mb-10">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe" name="remember" value="1"
                                <?php if(isset($_COOKIE['user_login'])){ echo "checked" ; } ?>>
                                <label class="custom-control-label text-white" for="rememberMe">Remember Me</label>
                            </div>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" required>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center text-white">
                                Masuk<span class="lnr lnr-arrow-right"></span></button>
                        </div>
                        <div class="d-flex justify-content-start">
                            <p class="text-white mt-30 mb-10">Belum mendaftar? 
                                <a class="text-white registration" href="../users/signup"><b>Daftar sekarang!</b></a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>

    <!-- Javascript for Users page -->
    <script src="users.js"></script>
</body>
</html>
<?php endif ?>