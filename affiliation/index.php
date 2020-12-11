<?php require_once('../layout/token.php'); ?>

<?php if(isset($_GET['id'])): ?>
<?php /*Afiliasi*/ require_once('index.detail.php'); ?>
<?php if($row['count']== 1): ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta property="og:title" content="<?= $row['affiliation_name'] ?>">
	<meta name="keywords" content="<?= $row['affiliation_name'] ?>">
	<meta property="og:image" content="../ovakun/aovchan/aman/banner.jpg"> 
    <title>
        <?= $row['affiliation_name'] ?>
    </title>
    <?php require_once('../layout/head.php'); ?>
    <?php require_once('../layout/sweetalert.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>

    <section id="team" class="section-half team-bg">
        <div class="container">
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <h2 class="text-uppercase">
                            <?= $row['affiliation_name'] ?>
                        </h2>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>
            <?php require_once('index.leader.php'); ?>
            <?php if(isset($leaderRow['counts']) && $leaderRow['counts']==1): ?>
            <div class="row">
                <div class="col-6 col-md-2 col-lg-2 mx-auto">
                    <div class="single-team-member">
                        <div class="member-image">
                            <a class="d-block" href="../character/<?= $leaderRow['character_id'] ?>"><img src="../aovchan/picture/character/<?= $leaderRow['faceclaim'] ?>" alt=""></a>
                        </div>
                        <div class="member-text">
                            <h4>
                            <a href="../character/<?= $leaderRow['character_id'] ?>"><?php $name = preg_split('/(,| s)/', $leaderRow['character_nickname'] ); echo $name[0];?></a>
                            </h4>
                            <p><?= $leaderRow['position'] ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <div class="row">
                <?php require_once('index.member.php'); ?>
                <?php foreach($memberRow as $data): ?>
                        <div class="col-6 col-md-2 col-lg-2">
                            <div class="single-team-member">
                                <div class="member-image">
                                    <a class="d-block" href="../character/<?= $data['character_id'] ?>"><img src="../aovchan/picture/character/<?=$data['faceclaim']?>" alt=""></a>
                                </div>
                                <div class="member-text">
                                    <h4><a href="../character/<?= $data['character_id'] ?>"><?= $data['character_nickname'] ?></a></h4>
                                    <p><?=$data['position']?></p>
                                </div>
                            </div>
                        </div>
                <?php endforeach ?>
            </div>
            <div class="row mt-4">
                <div class="col-12 text-justify description">
                    <!-- Heading Text  -->
                    <div class="section-heading">
                        <div class="line-shape"></div>
                        <h5 class="text-white mt-2 mb-2">
                            <?= $row['affiliation_description'] ?>
                        </h5>
                        <div class="line-shape"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <?php require_once('../layout/token_ajax.php'); ?>

    <!-- Javascript for Users page -->
</body>

</html>
<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>


<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>