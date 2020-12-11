<?php require_once('../layout/token.php'); ?>
<?php if(isset($_SESSION['usernameAdmin'])): ?>

<!DOCTYPE html>
<html lang="en">
<head>
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
                            <div class="main-body">
                                <div class="page-wrapper">
                                    <div class="page-body">
                                        <div class="card">
                                            <div class="card-header text-right">
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table" id="listAllUsers">
                                                        <thead>
                                                            <tr>
                                                                <th>Username</th>
                                                                <th>Bergabung</th>
                                                                <th>Email</th>
                                                                <th>Posisi</th>
                                                                <th>Blokir</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript" src="users.js"></script>
<?php require_once('../layout/custom_javascript.php'); ?>
<?php else: ?>
<?php header('location: ../users/login'); ?>
<?php endif; ?>