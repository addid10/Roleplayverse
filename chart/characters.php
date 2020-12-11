<?php require_once('../layout/token.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Top Characters Roleplayverse</title>
	<meta property="og:image" content="ovakun/aovchan/aman/banner.jpg">
    <?php require_once('../layout/head.php'); ?>
    <?php require_once('../database/db.php'); ?>
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
                        <label class="col-lg-12 col-md-12 col-sm-12 group">Group by:</label>
                        <form method="GET" style="display: contents;">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <select id="character-group" class="form-control group-by" name="by">
                                    <option value="rate" <?php if(isset($_GET['by'])){ if($_GET['by']=="rate"){echo "selected";}}?>>Top Characters</option>
                                    <option value="favorites" <?php if(isset($_GET['by'])){ if($_GET['by']=="favorites"){echo "selected";}}?>>Top Favorites</option>
                                    <option value="newest" <?php if(isset($_GET['by'])){ if($_GET['by']=="newest"){echo "selected";}}?>>Newest</option>
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
                        <p>Roleplayverse Charts</p>
                        <?php if(isset($_GET['by']) && $_GET['by'] == "favorites"): ?>
                            <h2 id="topchart-title">Top Favorited Characters</h2>
                            <p id="topchart-subtitle" class="mute">Top 100 as favorited by Roleplayverse Users</p>
                        <?php elseif(isset($_GET['by']) && $_GET['by'] == "newest"): ?>
                            <h2 id="topchart-title">Newest Characters</h2>
                            <p id="topchart-subtitle" class="mute">Newest Characters by Roleplayverse Users</p>
                        <?php else: ?>
                            <h2 id="topchart-title">Top Rated Characters</h2>
                            <p id="topchart-subtitle" class="mute">Top 100 as rated by Roleplayverse Users</p>
                        <?php endif ?>
                    </div>
                    <div class="roleplay-information top-characters">
                        <div class="table-responsive" id="rank-characters">
                            <table class="table table-characters table-striped" id="table-rate-characters">
                                <?php if(isset($_GET['by']) && $_GET['by'] == "favorites"): ?>
                                    <tr>
                                        <th>Rank</th>
                                        <th colspan="2">Character Name</th>
                                        <th>Roleplay Series</th>
                                        <th>Favorited</th>
                                    </tr>
                                    <?php require_once('characters.count.favorite.php'); ?>
                                    <?php require_once('characters.favorite.php'); ?>
                                    <?php foreach($topFavorites as $row): ?>
                                    <tr>
                                        <td width="5%" class="text-center ranked-number"><span><?= $rankingFavorite ?></span></td>
                                        <td width="5%">
                                            <a class="d-block" href="../character/<?=$row['character_id']?>">
                                                <img class="roleplay-topchart mr-2" src="../aovchan/picture/character/<?= $row['faceclaim'] ?>">
                                            </a>
                                        </td>
                                        <td width="45%" class="pl-0">
                                            <a class="d-block" href="../character/<?=$row['character_id']?>">
                                                <span class="chara-fullname"><?= $row['character_fullname'] ?></span>
                                            </a>
                                        </td>
                                        <td width="40%"><?php require_once('characters.roleplay.php'); roleplay_list($row['character_id']) ?></td>
                                        <td width="5%" class="text-left"><?= $row['favorited'] ?></td>
                                    </tr>
                                    <?php $rankingFavorite++; ?>
                                    <?php endforeach ?>

                                <?php elseif(isset($_GET['by']) && $_GET['by'] == "newest"): ?>
                                    <tr>
                                        <th>No.</th>
                                        <th colspan="2">Character Name</th>
                                        <th>Roleplay Series</th>
                                        <th>Score</th>
                                    </tr>
                                    <?php require_once('characters.newest.php'); ?>
                                    <?php foreach($newest as $row): ?>
                                    <tr>
                                        <td width="5%" class="text-center ranked-number"><span><?= $number ?></span></td>
                                        <td width="5%">
                                            <a class="d-block" href="../character/<?=$row['character_id']?>">
                                                <img class="roleplay-topchart mr-2" src="../aovchan/picture/character/<?= $row['faceclaim'] ?>">
                                            </a>
                                        </td>
                                        <td width="42%" class="pl-0">
                                            <a class="d-block" href="../character/<?=$row['character_id']?>">
                                                <span class="chara-fullname"><?= $row['character_fullname'] ?></span>
                                            </a>
                                        </td>
                                        <td width="38%"><?php require_once('characters.roleplay.php'); roleplay_list($row['character_id']) ?></td>
                                        <td width="10%" class="text-left"><i class="fa fa-star topchart-score"></i> <?= round($row['average'],2) ?></td>
                                    </tr>
                                    <?php $number++; ?>
                                    <?php endforeach ?>
                                <?php else: ?>
                                    <tr>
                                        <th>Rank</th>
                                        <th colspan="2">Character Name</th>
                                        <th>Roleplay Series</th>
                                        <th>Score</th>
                                    </tr>
                                    <?php require_once('characters.rate.php'); ?>
                                    <?php foreach($topRate as $row): ?>
                                    <tr>
                                        <td width="5%" class="text-center ranked-number"><span><?= $ranking ?></span></td>
                                        <td width="5%">
                                            <a class="d-block" href="../character/<?=$row['character_id']?>">
                                                <img class="roleplay-topchart mr-2" src="../aovchan/picture/character/<?= $row['faceclaim'] ?>">
                                            </a>
                                        </td>
                                        <td width="42%" class="pl-0">
                                            <a class="d-block" href="../character/<?=$row['character_id']?>">
                                                <span class="chara-fullname"><?= $row['character_fullname'] ?></span>
                                            </a>
                                        </td>
                                        <td width="38%"><?php require_once('characters.roleplay.php'); roleplay_list($row['character_id']) ?></td>
                                        <td width="10%" class="text-left"><i class="fa fa-star topchart-score"></i> <?= round($row['average'],2) ?></td>
                                    </tr>
                                    <?php $ranking++; ?>
                                    <?php endforeach ?>
                                <?php endif ?>
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
    <script src="chart.js"></script>

    <!-- Javascript for Users page -->
</body>

</html>