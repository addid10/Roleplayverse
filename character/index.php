<?php require_once('../layout/token.php'); ?>

<?php if(isset($_GET['id'])): ?>
<?php /*Ambil Karakter*/ require_once('index.detail.php'); ?>
<?php if($row['count']== 1): ?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head> 
	<meta property="og:title" content="<?= $row['character_fullname']; ?>">
	<meta name="keywords" content="<?= $row['character_fullname'] ?>">
	<meta property="og:image" content="../aovchan/picture/character/<?= $row['faceclaim']; ?>">
    <title>
        <?= $row['character_fullname']; ?>
    </title>
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div class="mt-1 d-flex bd-highlight character-title">
                <div class="bd-highlight">
                    <h4 class="mt-2 mr-2">
                        <?= $row['character_fullname']; ?>
                    </h4>
                </div>
                <div class="ml-auto bd-highlight">
                    <h6 class="mt-2 pt-1 mr-2"><i class="fa fa-info-circle"></i> Report</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="character-information">
                        <img class="img-character" src="../aovchan/picture/character/<?= $row['faceclaim']; ?>">
                    </div>
                    <p class="mb-0 copyright">Faceclaim &copy;
                        <?= $row['faceclaim_source']; ?>
                    </p>
                    <div class="character-information">
                        <p class="mt-2 character-quotes text-center">
                            <i class="fa fa-quote-left"></i> <i><?= $row['quotes']; ?>.</i>
                        </p>
                    </div>
                    <button id="<?= $row['character_id']; ?>" class="btn btn-favorites favorites">
                        <?php require_once('index.favorite.php'); ?>
                        <?php if(isset($_SESSION['usernameMember']) && $favorited==1): ?>
                            <i class="fa fa-heart"></i> <span class="text-favorite">Favorited</span>
                        <?php else: ?>
                            <i class="fa fa-heart"></i> <span class="text-favorite">Add to My Favorites!</span>
                        <?php endif ?>
                    </button>
                    <div class="roleplay-information">
                        <div class="row">
                            <div class="col-12">
                                <div class="ml-3 mr-3 mb-0 header">
                                    <span class="information-header">Roleplay Stories</span>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-roleplay-character table-borderless">
                                    <?php require_once('index.roleplay.php'); ?>
                                    <?php foreach($resultRoleplay as $roleplay): ?>
                                    <tr>
                                        <td width="3%"><img class="roleplay-topchart" src="../aovchan/picture/roleplay/<?= $roleplay['roleplay_cover'] ?>"></td>
                                        <td width="90%"><a href="../roleplay_stories/<?= $roleplay['roleplay_id'] ?>"><?= $roleplay['roleplay_name'] ?></a><br><?= $roleplay['role'] ?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="mt-1">
                        <div class="played-by">
                            <span class="pt-1 text-black"><i class="fa fa-info-circle"></i> Played by <a class="text-white" href="../profile/<?=username($row['author'])?>"><span class="badge badge-primary"><?= author_name($row['author']); ?> </span></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="mt-1">
                                <table class="table table-borderless table-roleplay-score text-center">
                                    <tr>
                                        <td class="badge-chara" width="25%">
                                            <span>Rate</span>
                                        </td>
                                        <td class="badge-chara" width="25%">
                                            <span>Kontributor
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Dinilai oleh Super Admin">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td class="badge-chara" width="25%">
                                            <span>Attraction
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Dinilai oleh Super Admin">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td class="badge-chara" width="25%">
                                            <span>Your Rate</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="aov-score" id="character-score">
                                            <?php require_once('index.score.php'); ?>
                                            <?php if(!empty($total['rate'])): ?>
                                                <?= round($total['rate'],2); ?>
                                            <?php else: ?>
                                                —
                                            <?php endif ?>
                                        </td>
                                        <td class="aov-score"><?= $row['character_contributor'] ?></td>
                                        <td class="aov-score"><?= $row['character_attraction'] ?></td>
                                        <td class="aov-score">
                                            <button class="btn btn-rate-score" id="<?= $row['character_id'] ?>" data-toggle="modal" data-target="#rate-modal"><i
                                                    class="fa fa-plus"></i> Rate</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="roleplay-statistic">
                                <table class="table table-borderless mb-0 text-center table-ranked">
                                    <tr>
                                        <td class="ranked">
                                            <?php require_once('index.ranking.php'); ?>
                                            <span class="pr-2">RANKED #<?=$ranking['rank'] ?></span>
                                        </td>
                                        <td class="ranked">
                                            <?php require_once('index.count.favorites.php'); ?>
                                            <span>Favorites <span id="total-favorites"><?= $countFavorites ?></span></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="ranked" colspan="2">
                                            <?php if(!empty($total['rate'])): ?>
                                                <?php 
                                                    if($total['rate']==10) {
                                                        echo '<span class="badge badge-success">Perfect!</span>';
                                                    } else if ($total['rate']>=9) {
                                                        echo '<span class="badge badge-other">Awesome!</span>';
                                                    } else if ($total['rate']>=8) {
                                                        echo '<span class="badge badge-primary">Great!</span>';
                                                    } else if ($total['rate']>=7) {
                                                        echo '<span class="badge badge-primary">Looks Good!</span>';
                                                    } else if ($total['rate']>=6) {
                                                        echo '<span class="badge badge-info">Not Bad</span>';
                                                    } else if ($total['rate']>=5) {
                                                        echo '<span class="badge badge-info">Need Development</span>';
                                                    } else if ($total['rate']>=4) {
                                                        echo '<span class="badge badge-danger">Boring</span>';
                                                    } else if ($total['rate']>=3) {
                                                        echo '<span class="badge badge-danger">Bad</span>';
                                                    } else if ($total['rate']>=2) {
                                                        echo '<span class="badge badge-secondary">Horrible</span>';
                                                    } else if ($total['rate']>=1 || $total['rate']<=1) {
                                                        echo '<span class="badge badge-dark">GTFO!</span>';
                                                    }
                                                ?>
                                            <?php else: ?>
                                                —
                                            <?php endif ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            
                            <div class="mt-1">
                                <div class="mt-1 d-flex justify-content-center character-title">
                                    <span class="pt-1">Affiliation</span>
                                </div>
                                <div class="roleplay-information mt-0 p-0">
                                    <table class="table table-awards table-hover">
                                        <?php require_once('index.affiliation.php'); ?>
                                        <?php foreach($resultAff as $data): ?>
                                        <tr>
                                            <td width="75%"><a href="../affiliation/<?=$data['affiliation_id']?>"><?= $data['affiliation_name'] ?></a></td>
                                            <td width="25%"><?= $data['position'] ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="mt-1">
                                <table class="table table-borderless table-roleplay-score">
                                    <tr>
                                        <th colspan="2" class="biography text-center">Short Biography</th>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>Nickname / Alias</span>
                                        </td>
                                        <td class="biography-a">
                                            <?= $row['character_nickname'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>Gender</span>
                                        </td>
                                        <td class="biography-a">
                                            <?php 
                                            if($row['character_gender']=="M"){
                                                echo "Male";
                                            } else {
                                                echo "Female";
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>First Appearance</span>
                                        </td>
                                        <td class="biography-a">
                                            <?= $row['first_appearance'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>Age</span>
                                        </td>
                                        <td class="biography-a">
                                            <?= $row['character_age'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>Race
                                                <a href="#" data-toggle="tooltip" data-placement="bottom" title="Ras atau Kasta dari Karakter">
                                                    <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                </a>
                                            </span>
                                        </td>
                                        <td class="biography-a">
                                            <?= $row['race_name'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>School</span>
                                        </td>
                                        <td class="biography-a">
                                            <?= $row['school'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="biography-q">
                                            <span>Partner</span>
                                        </td>
                                        <td class="biography-a"><a class="text-white" href="../character/<?=$row['partner_id']?>">
                                                <?= partner_name($row['partner_id']) ?></a></td>
                                    </tr>
                                </table>
                            </div>
                            <!-- 
                            <div class="mt-1">
                                <div class="mt-1 d-flex justify-content-center character-title">
                                    <span class="pt-1">Awards</span>
                                </div>
                                <div class="roleplay-information">
                                    <table class="table table-awards table-borderless">
                                        <tr>
                                            <td><img class="roleplay-awards"></td>
                                            <td><a href="#">18 of the Scariest OC Faces Ever</a><br>Nomination</td>
                                        </tr>
                                    </table>
                                </div>
                            </div> -->
                        </div>
                        <div class="col-12">
                            <div class="mt-2 storyline">
                                <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#storyline" role="tab"
                                            aria-selected="true">Storyline</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="storyline" role="tabpanel">
                                        <p><?= $row['background']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 storyline">
                                <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#personality" role="tab"
                                            aria-selected="true">Personality </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#apperance" role="tab"
                                            aria-selected="true">Tranformation Apperance</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="personality" role="tabpanel">
                                        <p><?= $row['personality']; ?></p>
                                    </div>
                                    <div class="tab-pane fade" id="apperance" role="tabpanel">
                                        <p><?= $row['appearance']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-12">
                            <span class="text-right mt-3" style="display:block;font-size:12px;"><i class="fa fa-info-circle" aria-hidden="true"></i> Only Admin</span>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#relationship" role="tab"
                                        aria-selected="true">Relationship</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#power" role="tab" aria-selected="false">Power
                                        & Abilities</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#battles" role="tab" aria-selected="false">Battles</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#stats" role="tab" aria-selected="false">Stats</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="relationship" role="tabpanel">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="roleplay-information">
                                                <table class="table table-characters table-borderless">
                                                    <tr>
                                                        <td width="3%"><img class="roleplay-characters"></td>
                                                        <td width="20%"><a href="#">Louise Mahatampan</a><br>Wife</td>
                                                        <td class="text-justify">Keberadaan alam semesta dengan tingkat
                                                            diskriminasi paling tinggi. Alam semesta yang
                                                            berpenghasilan karena telah mengedepankan sisi penampilan
                                                            fisik, di mana telah diteruskan secara turun-temurun selama
                                                            berabad-abad lamanya.
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width="3%"><img class="roleplay-characters"></td>
                                                        <td width="20%"><a href="#">Louise Mahatampan</a><br>Wife</td>
                                                        <td class="text-justify">Keberadaan alam semesta dengan tingkat
                                                            diskriminasi paling tinggi. Alam semesta yang
                                                            berpenghasilan karena telah mengedepankan sisi penampilan
                                                            fisik, di mana telah diteruskan secara turun-temurun selama
                                                            berabad-abad lamanya.
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="power" role="tabpanel">
                                    <div class="roleplay-information">
                                        <table class="table table-characters table-borderless">
                                            <tr>
                                                <td width="3%"><img class="roleplay-powers"></td>
                                                <td width="20%"><a href="#">Fire Manipulation</a><br>Manipulation</td>
                                                <td class="text-justify">Keberadaan alam semesta dengan tingkat
                                                    diskriminasi paling tinggi. Alam semesta yang
                                                    berpenghasilan karena telah mengedepankan sisi penampilan
                                                    fisik, di mana telah diteruskan secara turun-temurun selama
                                                    berabad-abad lamanya.
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="battles" role="tabpanel">
                                    <div class="roleplay-information">
                                        <table class="table table-awards table-borderless" style="width:100%">
                                            <tr>
                                                <th class="text-center">Fight</th>
                                                <th class="text-center">Outcome</th>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Frenchie vs.
                                                    <img class="roleplay-versus">Louise</td>
                                                <td class="text-center">Win</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="stats" role="tabpanel">
                                    <div class="roleplay-information">
                                        <table class="table table-borderless table-stats" style="width:100%">
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Power
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Seberapa kuat karakter tersebut dari segi offensive, defensive, & support.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Strategy
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Kemampuan untuk merencakan sesuatu sebagai langkah selanjutnya.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Speech
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Kemampuan karakter berbicara kepada umum, mengungkapkan gagasan, dan menyampaikan pendapatnya.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Knowledge
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pengetahuan seputar dunia.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Leadership
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Kemampuan karakter dalam melakukan kepemimpinan.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Social Intelligence
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Kemampuan karakter untuk bersosialisai kepada orang lain.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td width="25%">
                                                    <div class="ml-2 title-stats">
                                                        Competency
                                                        <a href="#" data-toggle="tooltip" data-placement="bottom" title="Pengetahuan, skill, dan pengalaman dalam melakukan hal yang diperlukan.">
                                                            <i class="fa fa-info-circle" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <div class="progress">
                                                        <div class="progress-bar" role="progressbar" style="width: 25%;"
                                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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
    <script src="character.js"></script>

    <!-- Javascript for Users page -->
</body>

</html>
<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>


<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>