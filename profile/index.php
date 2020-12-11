<?php require_once('../layout/token.php'); ?>

<?php if(isset($_GET['name'])): ?>
<?php /*Ambil Karakter*/ require_once('index.detail.php'); ?>
<?php if($row['count']== 1): ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta property="og:title" content="<?= $row['fullname'] ?>">
	<meta name="keywords" content="<?= $row['fullname'] ?>">
    <?php require_once('../content/function.php'); ?>
	<?php if(get_picture_name($row['users_id']) == "default.png" || empty(get_picture_name($row['users_id']))): ?>
	<meta property="og:image" content="../aovchan/picture/profile/member.png"> 
    <?php else: ?>
	<meta property="og:image" content="../aovchan/picture/profile/<?= $row['picture'] ?>"> 
    <?php endif ?>
    <title><?= $row['fullname'] ?>'s Profile</title>
    <?php require_once('../layout/head.php'); ?>
    <?php require_once('../layout/sweetalert.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <?php $id = $row['users_id']; ?>
    <?php require_once('index.check.characters.php'); ?>
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
                                    <h6><?= $row['location'] ?></h6>
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
                                        <div class="ml-2 profile-score-title"><?= date_convert($row['create_at']) ?></div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mt-1 profile-navs">
                <ul class="nav nav-pills mb-0" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="pill" href="#my-profile" role="tab">
                            <i class="fa fa-user" aria-hidden="true"></i> My Profile</a>
                    </li>
                    <?php if($_SESSION['usernameMember']): ?>
                        <?php if($_SESSION['userAccountId']==$id): ?>
                            <li class="nav-item ml-auto">
                                <a class="nav-link settings-link" id="<?= $id ?>" data-toggle="pill" href="#settings" role="tab">
                                    <i class="fa fa-cog" aria-hidden="true"></i> Settings</a>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="my-profile" role="tabpanel">
                    <div class="row">
                        <div class="col-lg-4 col-md-4">
                            <?php if($checking >= 1): ?>
                            <div class="mt-1 mb-0 pt-2 text-center roleplay-header">My Statistic</div>
                            <div class="roleplay-information mt-0 mb-2">
                                <canvas id="pieChart"></canvas>
                            </div>
                            <div class="mb-0">
                                <div class="d-flex bd-highlight mb-3">
                                    <div class="bd-highlight">
                                        <span class="information-question">Score Average:</span>
                                        <?php require_once('index.total.score.php'); ?>
                                        <span class="information-answer ml-1"><?= round($avgRating['rated'],2) ?></span>
                                    </div>
                                    <div class="ml-auto bd-highlight">
                                        <span class="information-question">Total Favorites:</span>
                                        <?php require_once('index.total.favorite.php'); ?>
                                        <span class="information-answer ml-1">
                                            <?php 
                                                if(!empty($totalFavorited['total_favorite'])){
                                                    echo $totalFavorited['total_favorite'];
                                                } else {
                                                    echo 0;
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <?php endif ?>
                            <button class="btn btn-rate mt-2" data-toggle="modal" data-target="#scoreModal">Rated List <i class="fa fa-thumbs-up" aria-hidden="true"></i></button>
                            <?php require_once('index.featured.character.php'); ?>
                            <div class="mt-1 mb-0 pt-2 text-center roleplay-header">Featured Character</div>
                            <div class="roleplay-information mt-0 p-0">
                                <table class="table table-fcharacter table-borderless">
                                    <?php if($checking >= 1): ?>
                                    <tr>
                                        <td width="30%"><img src="../aovchan/picture/character/<?= $charaFeatured['faceclaim'] ?>"><img class="crown-characters"
                                                src="../ovakun/aovchan/aman/crown.png"></td>
                                        <td><a href="../character/<?= $charaFeatured['character_id'] ?>"><?= $charaFeatured['character_fullname'] ?></a><br>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                            <br>
                                            <?= round($charaFeatured['average'],2) ?>
                                        </td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                        <td class="p-1 pr-2 pl-2">Belum memiliki karakter.</td>
                                    </tr>
                                    <?php endif ?>
                                </table>
                            </div>
                            <div class="mt-2 mb-0 pt-2 text-center roleplay-header">Favorites</div>
                            <div class="roleplay-information mt-0 p-0">
                                <table class="table table-roleplay-character table-borderless mb-0">
                                <?php require_once('index.favorited.php'); ?>
                                <?php if ($checked > 0): ?>
                                <?php foreach($list as $data): ?>
                                    <tr>
                                        <td width="3%"><img class="roleplay-topchart" src="../aovchan/picture/character/<?= $data['faceclaim'] ?>"></td>
                                        <td width="90%"><a href="../character/<?= $data['character_id'] ?>"><?= $data['character_fullname'] ?></a><br>
                                        <?= $data['roleplay_name'] ?></td>
                                    </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="p-1 pr-2 pl-2">Belum menambahkan satupun karakter favorite.</td>
                                    </tr>
                                <?php endif ?>
                                </table>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="d-flex bd-highlight">
                                <div class="w-100 bd-highlight">
                                    <div class="mt-1 mb-0 pt-2 pb-0 text-center roleplay-header">My Characters</div>
                                </div>
                                <?php if($_SESSION['usernameMember']): ?>
                                    <?php if($_SESSION['userAccountId']==$id): ?>
                                        <div class="mt-2 flex-shrink-1 bd-highlight">
                                            <a href="dashboard" class="btn btn-add text-white">My Dashboard <i class="fa fa-info-circle"></i></a>
                                        </div>
                                    <?php endif ?>
                                <?php endif ?>
                            </div>
                            <div class="roleplay-information mt-0 p-0">
                                <div class="table-responsive">
                                    <table class="table table-list-characters table-hover">
                                        <tr>
                                            <th width="5%">Rank</th>
                                            <th width="43%" colspan="2">Name</th>
                                            <th width="40%">Roleplay</th>
                                            <th width="12%" class="text-center">Score</th>
                                        </tr>
                                        <?php if($checking >= 1): ?>
                                            <?php require_once('index.mycharacters.php'); ?>
                                            <?php require_once('../chart/characters.roleplay.php'); ?>
                                            <?php foreach($characters as $chara): ?>
                                            <tr>
                                                <td><?= $chara['rank'] ?></td>
                                                <td width="4%">
                                                    <img class="mr-2" src="../aovchan/picture/character/<?= $chara['faceclaim'] ?>">
                                                </td>
                                                <td width-"40%" class="pl-0">
                                                   <a href="../character/<?= $chara['character_id'] ?>"><?= $chara['character_fullname'] ?></a>
                                                </td>
                                                <td><?= roleplay_list($chara['character_id']) ?></td>
                                                <td class="text-left">
                                                    <i class="fa fa-star" aria-hidden="true"></i> <?= round($chara['score'],2) ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="4" class="p-1 pr-2 pl-2"><h4>Belum memiliki karakter.</h4></td>
                                            </tr>
                                        <?php endif ?>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <?php if($_SESSION['usernameMember']): ?>
                    <?php if($_SESSION['userAccountId']==$id): ?>
                        <div class="tab-pane fade settings-navs" id="settings" role="tabpanel">
                            <div class="row mt-3">
                                <div class="col-lg-3 col-md-3">
                                    <div class="nav flex-column nav-pills" role="tablist">
                                        <a class="nav-link active" data-toggle="pill" href="#change-profile" role="tab">
                                            Edit Profile
                                        </a>
                                        <a class="nav-link" data-toggle="pill" href="#change-password" role="tab">
                                            <i class="fa fa-key" aria-hidden="true"></i>
                                            Change Password
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-9 col-md-9">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="change-profile" role="tabpanel">
                                            <form class="row" id="change-profiles">
                                                <div class="col-lg-8 col-md-8">
                                                    <div class="form-group row">
                                                        <label for="myName" class="col-sm-3 col-form-label">My Name</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="myName" name="name"
                                                            value="<?= $row['fullname'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Username</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" id="userName" disabled style="cursor: not-allowed;"
                                                            value="<?= $row['username'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label class="col-sm-3 col-form-label">Email</label>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" id="email" disabled style="cursor: not-allowed;"
                                                            value="<?= $row['email'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="phoneNumber" class="col-sm-3 col-form-label">Phone
                                                            Number</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="phoneNumber" name="phone"
                                                                maxlength="13" value="<?= $row['phone'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="location" class="col-sm-3 col-form-label">Location</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" id="location" name="location"
                                                                maxlength="100" value="<?= $row['location'] ?>" required pattern="[a-zA-Z0-9\s-?!]+">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="phoneNumber" class="col-sm-3 col-form-label">Gender</label>
                                                        <div class="col-sm-9 mt-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="genderMale"
                                                                    value="M" <?php if($row['gender']=="M"){ echo "checked";} ?> required>
                                                                <label class="form-check-label" for="genderMale">Male</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="gender" id="genderFemale"
                                                                    value="F" <?php if($row['gender']=="F"){ echo "checked";} ?> required>
                                                                <label class="form-check-label" for="genderFemale">Female</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4">
                                                    <div class="text-center">
                                                    <?php if(get_picture_name($row['users_id']) == "default.png" || empty(get_picture_name($row['users_id']))): ?>
                                                        <img class="change-photo" src="../aovchan/picture/profile/member.png">
                                                    <?php else: ?>
                                                        <img class="change-photo" src="../aovchan/picture/profile/<?= $row['picture'] ?>">
                                                    <?php endif ?>
                                                        <p>Ukuran maks. 1 MB<br>Format .PNG, .JPEG, .JPG</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="file" class="form-control-file" id="picture" name="picture">
                                                        <input type="hidden" class="form-control-file" name="hidden_foto" value="<?= $row['picture'] ?>">
                                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group col-lg-12 col-md-12">
                                                    <button type="submit" class="btn btn-favorites">Change Profile</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="change-password" role="tabpanel">
                                            <form id="change-passwords">
                                                <div class="form-group row">
                                                    <label for="oldPassword" class="col-sm-3 col-form-label">Password Lama</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="old-password" name="old_password" required minLength="8" maxlength="16">
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="form-group row">
                                                    <label for="newPassword" class="col-sm-3 col-form-label">Password Baru</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="new-password" name="new_password" required minLength="8" maxlength="16">
                                                        <div id="password-status"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <label for="confirmPassword" class="col-sm-3 col-form-label">Konfirmasi
                                                        Password Baru</label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" id="confirm-password" required minLength="8" maxlength="16">
                                                        <div id="confirm-status"></div>
                                                        <small class="form-text">Panjang karakter harus 8-16 karakter.</small>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" required>
                                                    <button type="submit" class="btn btn-favorites"><i class="fa fa-key"
                                                            aria-hidden="true"></i> Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                <?php endif ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/modal.php'); ?>
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <?php require_once('../layout/token_ajax.php'); ?>
    <script src="../ovakun/aovchan/private/mdb.min.js"></script>
    <script src="profile.js"></script>

    <!-- Javascript for Users page -->
</body>
<?php require_once('index.statistic.php'); ?>
<script>
    //pie
    let ten = '<?= $stats["ten"] ?>';
    let nine = '<?= $stats["nine"] ?>';
    let eight = '<?= $stats["eight"] ?>';
    let seven = '<?= $stats["seven"] ?>';
    let six = '<?= $stats["six"] ?>';
    let five = '<?= $stats["five"] ?>';
    let four = '<?= $stats["four"] ?>';
    let three = '<?= $stats["three"] ?>';
    let two = '<?= $stats["two"] ?>';
    let one = '<?= $stats["one"] ?>';

    let ctxP = $("#pieChart").get(0).getContext("2d");
    let myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
            labels: ["10", "9", "8", "7", "6", "5", "4", "3", "2", "1"],
            datasets: [{
                data: [ten, nine, eight, seven, six, five, four, three, two, one],
                backgroundColor: ["#14cdd2", "#0069a9", "#1966d0", "#2a3ea1", "#7439b2", "#a971e3",
                    "#c93dee", "#ee3de7", "#e70c70", "#df4646"
                ],
                hoverBackgroundColor: ["#27ebf0", "#198bd0", "#006bff", "#646fa3", "#8d57c5", "#b997dd", 
                    "#e476e5", "#f969f3", "#ff3b94", "#ff7979"
                ]
            }]
        },
        options: {
            responsive: true,
        }
    });
</script>
</html>
<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>


<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>