<?php require_once("../layout/token.php");?>
<?php if (isset($_SESSION['usernameAdmin'])): ?>
<?php header('location: ../home');?>
<?php else: ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login :: Roleplayverse</title>
    <?php require_once("../layout/header.php");?>
</head>

<body class="fix-menu ">
    <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->

    <section class="login p-fixed d-flex text-center bg-primary common-img-bg">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="login-card card-block auth-body mr-auto ml-auto">
                        <div class="auth-box">
                            <div class="row m-b-20">
                                <div class="col-md-12">
                                    <div class="label-main">
                                        <?php if(isset($_GET['status'])): ?>
                                        <?php $status = $_GET['status']; ?>
                                        <label class="label label-danger">
                                            <?= $status ?>
                                        </label>
                                        <?php endif ?>
                                    </div>
                                    <h3 class="text-center txt-primary">
                                        <img src="../../../ovakun/aovchan/aman/fav.png" width="10%" class="mr-1">
                                        Login:: Admin
                                    </h3>
                                </div>
                            </div>
                            <hr />
                            <form id="loginForm" method="POST">
                                <div class="input-group">
                                    <input id="username" name="username" type="text" class="form-control" placeholder="Username"
                                        maxlength="20" value="<?php if(isset($_COOKIE['admin_login'])){ echo $_COOKIE['admin_login'];} ?>"
                                        required>
                                    <span class="md-line"></span>
                                </div>
                                <div class="input-group">
                                    <input id="password" name="password" type="password" class="form-control"
                                        placeholder="Password" maxlength="16" value="<?php if(isset($_COOKIE['admin_pwd'])){ echo $_COOKIE['admin_pwd'];} ?>">
                                    <span class="md-line"></span>
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>"
                                        required>
                                </div>
                                <div class="row m-t-25 text-left">
                                    <div class="col-sm-7 col-xs-12">
                                        <div class="checkbox-fade fade-in-primary">
                                            <label>
                                                <input type="checkbox" name="remember" value="1" <?php
                                                    if(isset($_COOKIE['admin_login'])){ echo "checked" ; } ?>>
                                                <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                                <span class="text-inverse">Remember me</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row m-t-30">
                                    <div class="col-md-12">
                                        <button id="loginButtonAdmin" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php require_once('../layout/javascript.php'); ?>
    <?php require_once('../layout/custom_javascript.php'); ?>
    <?php require_once('../layout/token.php'); ?>
    <script src="users.js"></script>
</body>

</html>
<?php endif; ?>