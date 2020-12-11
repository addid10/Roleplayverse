<?php require_once('../layout/token.php'); ?>
<?php if(isset($_SESSION['usernameMember'])): ?>
<?php header('location: ../'); ?>
<?php else: ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Sign Up :: Roleplayverse</title>
	<meta property="og:image" content="../ovakun/aovchan/aman/banner2.png">
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>

    <!-- Contact -->
    <section id="contact" class="section-half login-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="pb-4 pt-5 text-center">
                        <h2 class="text-white"><img src="../ovakun/aovchan/aman/fav.png" class="pr-3" width="65px">Sign Up</h2>
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
                    <form id="registForm" method="POST" class="contact-form">
                        <div class="single-input">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <input class="form-control" id="firstname" type="text" name="fname" placeholder="Nama Depan" required maxlength="20">
                                </div>
                                <div class="form-group col-md-6">
                                    <input class="form-control" id="lastname" type="text" name="lname" placeholder="Nama Belakang" required maxlength="20">
                                </div>
                            </div>
                        </div>
                        <div class="single-input mb-10">
                            <input class="form-control" id="username" type="text" name="username" placeholder="Username" required maxlength="20" pattern="[0-9A-Za-z]+">
                            <div id="usernameStatus"></div>
                        </div>
                        <div class="single-input color-2 mb-10">
                            <input class="form-control" id="email" type="email" name="email" placeholder="Email" maxlength="40" required>
                            <div id="emailStatus"></div>
                        </div>
                        <div class="single-input color-2 mb-10">
                            <input class="form-control" id="password" type="password" name="password" placeholder="Password" required minLength="8" maxlength="16">
                            <div id="passwordStatus"></div>
                            <small class="form-text text-white">Panjang karakter harus 8-16 karakter.</small>
                        </div>
                        <div class="single-input color-2 mb-10">
                            <input class="form-control" id="confirmPassword" type="password" placeholder="Confirm Password" required minLength="8" maxlength="16">
                            <div id="confirmStatus"></div>
                        </div>
                        <div class="single-input color-2 mb-10">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="agreement" name="agreement" value="1" required>
                                <label class="custom-control-label text-white" for="agreement">Dengan mencentang ini, Anda menyetujui 
                                    <a class="text-white registration" href="https://www.roleplayverse.site/news/terms_of_services">Syarat, Ketentuan, Kebijakan dan Peraturan</a> dari kami selama berada di website ini.</label>
                            </div>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" required>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center text-white">
                                Daftar<span class="lnr lnr-arrow-right"></span></button>
                        </div>
                        <div class="d-flex justify-content-start">
                            <p class="text-white mt-30 mb-10">Sudah mendaftar? 
                                <a class="text-white registration" href="../users/login"><b>Masuk sekarang!</b></a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <?php require_once('../layout/token_ajax.php'); ?>

    <!-- Javascript for Users page -->
    <script src="users.js"></script>
</body>

</html>
<?php endif ?>