<?php require_once('../layout/token.php'); ?>
<?php if(isset($_SESSION['usernameAdmin'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php require_once('../layout/header.php'); ?>
</head>
<body>
       <!-- Pre-loader start -->
    <div class="theme-loader">
        <div class="loader-track">
            <div class="loader-bar"></div>
        </div>
    </div>
    <!-- Pre-loader end -->
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
                                            <div class="card-header">
                                            <h3><i class="ti-email"></i> Pesan Masuk</h3>
                                            <span>Tempat di mana users mengirim pesan dari halaman <code>hubungi kami</code> atau <code>contact us.</code></span>
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table" id="tabelPesan">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Dari</th>
                                                                <th>Email</th>
                                                                <th>Isi</th>
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
<?php require_once('../layout/custom_javascript.php'); ?>
<script type="text/javascript" src="messages.js"></script>
<?php else: ?>
<?php header('location: ../users/login'); ?>
<?php endif; ?>