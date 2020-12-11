<?php require_once('../layout/token.php'); ?>
<?php if (isset($_SESSION['usernameAdmin'])): ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Characters :: Roleplayverse</title>
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
                                            <div class="card-header text-right">
                                                <button class="btn btn-primary btn-round" id="addButton" data-toggle="modal" data-target="#charaModal">Tambah Karakter</button>     
                                            </div>
                                            <div class="card-block table-border-style">
                                                <div class="table-responsive">
                                                    <table class="table" id="charaTable">
                                                        <thead>
                                                            <tr> 
                                                                <th>Name</th>
                                                                <th>Favorites</th>
                                                                <th>Scores</th>
                                                                <th width="10%">Admin Score</th>
                                                                <th width="10%">Roleplay</th>
                                                                <th width="10%">Update</th>
                                                                <th width="10%">Delete</th>
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
<?php require_once('../layout/modal.php'); ?>
<?php require_once('../layout/javascript.php'); ?>
<?php require_once('../layout/token_ajax.php'); ?>
<?php require_once('../layout/custom_javascript.php'); ?>

<script type="text/javascript" src="character.js"></script>

<?php else: ?>
<?php header('location: ../users/login'); ?>
<?php endif; ?>