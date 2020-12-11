<?php require_once('../layout/token.php'); ?>

<?php if(isset($_SESSION['usernameMember'])): ?>
<?php $name = $_SESSION['usernameMember']; ?>
<?php /*Ambil Karakter*/ require_once('dashboard_detail.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title><?= $row['fullname'] ?>'s Profile</title>
    <?php require_once('../layout/head.php'); ?>
	<meta property="og:image" content="../ovakun/aovchan/aman/banner2.png">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css"/>
    <?php require_once('../layout/sweetalert.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <?php $id = $row['users_id']; ?>
    <?php require_once('../content/function.php'); ?>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div class="row roleplayer-profile">
                <div class="col-lg-12 col-md-12">
                    <div class="mt-1 d-flex bd-highlight roleplayer-foto">
                        <div class="w-50 bd-highlight profile-foto">
                            <div class="profile-image-profile">
                                <?php if(get_picture_name($row['users_id']) == "default.png" || empty(get_picture_name($row['users_id']))): ?>
                                <img class="thumbnail" src="../aovchan/picture/profile/member.png">
                                <?php else: ?>
                                <img class="thumbnail" src="../aovchan/picture/profile/<?= $row['picture'] ?>">
                                <?php endif ?>
                                <span class="change"></span>
                                <div class="profile-name">
                                    <h3><?= $row['fullname'] ?> 
                                        <?php if($row['role_id'] != 1): ?>
                                        <span class="badge badge-success">Admin</span>
                                        <?php endif ?>
                                    </h3>
                                    <h6>
                                        <?= $row['location'] ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="p-5 w-50 flex-shrink-1 bd-highlight profile-stats">
                            <table class="table table-borderless table-stats w-100">
                                <tr>
                                    <td width="50%">
                                        <div class="ml-2 profile-score-title">Gender</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="ml-2 profile-score-title">
                                            <?php if($row['gender']=="M"): ?>
                                            <i class="fa fa-male"></i> Male
                                            <?php elseif($row['gender']=="F"): ?>
                                            <i class="fa fa-female"></i> Female
                                            <?php else: ?>
                                            <i class="fa fa-magnet"></i>w<i class="fa fa-magnet"></i>
                                            <?php endif ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="50%">
                                        <div class="ml-2 profile-score-title">Joined</div>
                                    </td>
                                    <td class="text-center">
                                        <div class="ml-2 profile-score-title">
                                            <?= date_convert($row['create_at']) ?>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card-header text-right">
                        <button class="btn btn-favorites btn-round" id="addButton" data-toggle="modal" data-target="#charaModal">Tambah
                            Karakter</button>
                    </div>
                    <div class="roleplay-information pl-2 pr-2">
                        <div class="table-responsive">
                                <table class="table table-hover" id="charaTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Favorites</th>
                                            <th>Scores</th>
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
    </section>

    <!-- Footer -->
    <?php require_once('../layout/modal.php'); ?>
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <?php require_once('../layout/token_ajax.php'); ?>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>	
    <script src="dashboard.js"></script>

    <!-- Javascript for Users page -->
</body>
</html>
<?php else: ?>
<?php header('location: ../users/login'); ?>
<?php endif ?>