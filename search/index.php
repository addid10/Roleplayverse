<?php require_once('../layout/token.php'); ?>
<?php require_once('../database/db.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta property="og:image" content="ovakun/aovchan/aman/banner2.png">
    <?php if(isset($_GET['q'])): ?>
    <?php $search = addslashes($_GET['q']); ?>
    <title>Search "<?= $search ?>" - Roleplayverse</title>
    <?php endif ?>
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group row mt-2">
                        <label class="col-lg-12 col-md-12 col-sm-12 group">Filter:</label>
                        <form method="GET" style="display: contents;">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <input class="form-control" type="text" name="q" value="<?= $search ?>">
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select id="character-group" class="form-control group-by" name="filter">
                                <option value="all" <?php if(isset($_GET['filter'])){ if($_GET['filter']=="all"){ echo "selected"; } } ?>>All</option>
                                <option value="characters" <?php if(isset($_GET['filter'])){ if($_GET['filter']=="characters"){ echo "selected"; } } ?>>Characters</option>
                                <option value="roleplays" <?php if(isset($_GET['filter'])){ if($_GET['filter']=="roleplays"){ echo "selected"; } } ?>>Roleplays</option>
                                <option value="users" <?php if(isset($_GET['filter'])){ if($_GET['filter']=="users"){ echo "selected"; } } ?>>Users</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 pl-0">
                                <button type="submit" class="btn btn-rate p-2">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="sm-hidden">
                        <a class="sidebar-ova" href="https://www.facebook.com/AoVRoleplay/"><img class="sidebar-aov"
                                src="../aovchan/picture/iklan/aov.jpg"></a>
                        <div class="mt-3 d-flex justify-content-center character-title">
                            <span class="pt-1">Featured Roleplay Stories</span>
                        </div>
                        <div class="roleplay-information">
                            <table class="table table-awards table-borderless">
                                <tr>
                                    <td width="20%"><img class="roleplay-awards" src="../aovchan/picture/roleplay/perfection.jpg"></td>
                                    <td width="80%"><a href="../roleplay_stories/9000001">Perfection Universe</a><br>Multiverse</td>
                                </tr>
                            </table>
                        </div>
                        <img class="sidebar-aov" src="../aovchan/picture/iklan/aov.png">
                        <div class="mt-3 d-flex justify-content-center character-title">
                            <span class="pt-1">Featured Character</span>
                        </div>
                        <div class="roleplay-information">
                            <table class="table table-awards table-borderless">
                                <tr>
                                    <td width="20%"><img class="roleplay-awards" src="../aovchan/picture/character/frenchie.jpg"></td>
                                    <td width="80%"><a href="../character/8000002">Frenchie Napoleon</a><br>Perfection Universe</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="topchart-area-title">
                        <p>Roleplayverse Search</p>
                        <h2 id="search-title">Search Results for "<?= $search ?>"</h2>
                    </div>
                    <?php if(isset($_GET['q']) && isset($_GET['filter']) && $_GET['filter']=="all"): ?>
                        <?php $limit = 10; ?>
                        <div id="search-characters">
                            <h3 class="mt-4">Characters</h3>
                            <div class="roleplay-information top-characters">
                                <div class="table-responsive">
                                    <table class="table table-characters table-striped">
                                        <tr>
                                            <th colspan="2">Character Name</th>
                                            <th>Roleplay Series</th>
                                            <th>Score</th>
                                        </tr>
                                        <?php require_once('search_characters.php'); ?>
                                        <?php foreach($rowChara as $chara): ?>
                                        <tr>
                                            <td width="5%">
                                                <a class="d-block" href="../character/<?= $chara['character_id'] ?>">
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/character/<?= $chara['faceclaim'] ?>">
                                                </a>
                                            </td>
                                            <td width="43%" class="pl-0">
                                                <a class="d-block" href="../character/<?= $chara['character_id'] ?>">
                                                    <span class="chara-fullname"><?= $chara['character_fullname'] ?></span>
                                                </a>
                                            </td>
                                            <td width="42%"><?php require_once('../chart/characters.roleplay.php'); roleplay_list($chara['character_id']) ?></td>
                                            <td width="10%" class="text-left"><i class="fa fa-star topchart-score"></i> <?= round($chara['average'],2) ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="search-roleplay">
                            <h3 class="mt-4">Roleplay Stories</h3>
                            <div class="roleplay-information top-characters">
                                <div class="table-responsive">
                                    <table class="table table-characters table-striped">
                                        <tr>
                                            <th colspan="2">Roleplay Stories Name</th>
                                            <th class="text-left">Aov-chan Score</th>
                                        </tr>
                                        <?php require_once('search_roleplays.php'); ?>
                                        <?php foreach($rowRp as $roleplay): ?>
                                        <tr>
                                            <td width="5%">
                                                <a class="d-block" href="../roleplay_stories/<?= $roleplay['roleplay_id'] ?>">
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/roleplay/<?= $roleplay['roleplay_cover'] ?>">
                                                </a>
                                            </td>
                                            <td width="75%" class="pl-0">
                                                <a class="d-block" href="../roleplay_stories/<?= $roleplay['roleplay_id'] ?>">
                                                    <span><?= $roleplay['roleplay_name'] ?></span>
                                                </a>
                                            </td>
                                            <td width="20%" class="text-left"><i class="fa fa-star topchart-score"></i>
                                                <?= $roleplay['roleplay_score'] ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="search-users">
                            <h3 class="mt-4">Users</h3>
                            <div class="roleplay-information top-characters">
                                <div class="table-responsive">
                                    <table class="table table-characters table-striped">
                                        <tr>
                                            <th colspan="2">Username</th>
                                            <th>Joined</th>
                                        </tr>
                                        <?php require_once('search_users.php'); ?>
                                        <?php foreach($rowUsers as $user): ?>
                                        <tr>
                                            <td width="5%">
                                                <a class="d-block" href="../profile/<?= $user['username'] ?>">
                                                    <?php if(empty($user['picture']) || $user['picture']=="default.png" ): ?>
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/profile/member.png">
                                                    <?php else: ?>
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/profile/<?= $user['picture'] ?>">
                                                    <?php endif ?>
                                                </a>
                                            </td>
                                            <td width="75%" class="pl-0">
                                                <a class="d-block" href="../profile/<?= $user['username'] ?>">
                                                    <span><?= $user['fullname'] ?></span>
                                                </a>
                                            </td>
                                            <?php require_once('../content/function.php'); ?>
                                            <td width="20%"><?= date_converted($user['create_at']) ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if(isset($_GET['q']) && isset($_GET['filter']) && $_GET['filter']=="characters"): ?>
                        <?php $limit = 18446744073709; ?>
                        <div id="search-characters">
                            <h3 class="mt-4">Characters</h3>
                            <div class="roleplay-information top-characters">
                                <div class="table-responsive">
                                    <table class="table table-characters table-striped">
                                        <tr>
                                            <th colspan="2">Character Name</th>
                                            <th>Roleplay Series</th>
                                            <th>Score</th>
                                        </tr>
                                        <?php require_once('search_characters.php'); ?>
                                        <?php foreach($rowChara as $chara): ?>
                                        <tr>
                                            <td width="5%">
                                                <a class="d-block" href="../character/<?= $chara['character_id'] ?>">
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/character/<?= $chara['faceclaim'] ?>">
                                                </a>
                                            </td>
                                            <td width="43%" class="pl-0">
                                                <a class="d-block" href="../character/<?= $chara['character_id'] ?>">
                                                    <span class="chara-fullname"><?= $chara['character_fullname'] ?></span>
                                                </a>
                                            </td>
                                            <td width="42%"><?php require_once('../chart/characters.roleplay.php'); roleplay_list($chara['character_id']) ?></td>
                                            <td width="10%" class="text-left"><i class="fa fa-star topchart-score"></i> <?= round($chara['average'],2) ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    <?php if(isset($_GET['q']) && isset($_GET['filter']) && $_GET['filter']=="roleplays"): ?>
                        <?php $limit = 18446744073709; ?>
                        <div id="search-roleplay">
                            <h3 class="mt-4">Roleplay Stories</h3>
                            <div class="roleplay-information top-characters">
                                <div class="table-responsive">
                                    <table class="table table-characters table-striped">
                                        <tr>
                                            <th colspan="2">Roleplay Stories Name</th>
                                            <th class="text-center">Aov-chan Score</th>
                                        </tr>
                                        <?php require_once('search_roleplays.php'); ?>
                                        <?php foreach($rowRp as $roleplay): ?>
                                        <tr>
                                            <td width="5%">
                                                <a class="d-block" href="../roleplay_stories/<?= $roleplay['roleplay_id'] ?>">
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/roleplay/<?= $roleplay['roleplay_cover'] ?>">
                                                </a>
                                            </td>
                                            <td width="75%" class="pl-0">
                                                <a class="d-block" href="../roleplay_stories/<?= $roleplay['roleplay_id'] ?>">
                                                    <span><?= $roleplay['roleplay_name'] ?></span>
                                                </a>
                                            </td>
                                            <td width="20%" class="text-center"><i class="fa fa-star topchart-score"></i>
                                                <?= $roleplay['roleplay_score'] ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                    
                    <?php if(isset($_GET['q']) && isset($_GET['filter']) && $_GET['filter']=="users"): ?>
                        <?php $limit = 18446744073709; ?>
                        <div id="search-users">
                            <h3 class="mt-4">Users</h3>
                            <div class="roleplay-information top-characters">
                                <div class="table-responsive">
                                    <table class="table table-characters table-borderless">
                                        <tr>
                                            <th colspan="2">Username</th>
                                            <th>Joined</th>
                                        </tr>
                                        <?php require_once('search_users.php'); ?>
                                        <?php foreach($rowUsers as $user): ?>
                                        <tr>
                                            <td width="5%">
                                                <a class="d-block" href="../profile/<?= $user['username'] ?>">
                                                    <?php if(empty($user['picture']) || $user['picture']=="default.png" ): ?>
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/profile/member.png">
                                                    <?php else: ?>
                                                    <img class="roleplay-topchart mr-2" src="../aovchan/picture/profile/<?= $user['picture'] ?>">
                                                    <?php endif ?>
                                                </a>
                                            </td>
                                            <td width="75%" class="pl-0">
                                                <a class="d-block" href="../profile/<?= $user['username'] ?>">
                                                    <span><?= $user['fullname'] ?></span>
                                                </a>
                                            </td>
                                            <?php require_once('../content/function.php'); ?>
                                            <td width="20%"><?= date_converted($user['create_at']) ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/modal.php'); ?>
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <?php require_once('../layout/token_ajax.php'); ?>
    <script src="search.js"></script>

    <!-- Javascript for Users page -->
</body>

</html>