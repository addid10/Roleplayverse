<?php require_once('../layout/token.php'); ?>
<?php require_once('roleplay.roleplay.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Roleplay List :: Roleplayverse</title>
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-full gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="product-area-title text-center">
                        <p class="text-uppercase">Roleplayverse</p>
                        <h2 class="h1">Roleplay List</h2>
                        <h2>Semua Roleplay yang ada di Roleplayverse.site</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php foreach($resultRoleplay as $row): ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="single-publish">
                        <div class="top">
                            <h6 class="text-uppercase text-center"><a href="../roleplay_stories/<?= $row->roleplay_id ?>">
                                <?php if(strlen($row->roleplay_name)<=38): ?>
                                <?= $row->roleplay_name; ?></a></h6>
                                <?php else: ?>
                                <?= $row->roleplay_other_name ?></a></h6>
                                <?php endif ?>
                            <div class="d-flex justify-content-center chapter-bg">
                                <div href="#"><span class="badge badge-other"><?= $row->roleplay_status ?></span></div>
                                <div class="ml-2 chapter"><?php if(!empty($row->roleplay_chapters)){echo $row->roleplay_chapters.' chapters';}else{ echo "None"; } ?></div>
                                <?php if($row->multiverse==1): ?>
                                <div class="ml-2"><i class="fa fa-check-circle verified"></i></div>
                                <?php endif ?>
                            </div>
                            <div class="d-flex justify-content-center genre-bg">
                                <span class="text-center genre"><?= $row->roleplay_genres ?></span>
                            </div>
                        </div>
                        <img src="../aovchan/picture/roleplay/<?= $row->roleplay_cover ?>" class="img-fluid" alt="">
                        <p class="mt-2"><?php $synopsis = $row->universe_synopsis; $sub_synopsis = explode("<br>", $synopsis); echo $sub_synopsis[0]; ?></p>
                        <a href="../roleplay_stories/<?=$row->roleplay_id?>" class="details-btn d-flex justify-content-center align-items-center"><span class="details">Details</span><span
                                class="lnr lnr-arrow-right"></span></a>
                        <div class="down">
                            <div class="d-flex bd-highlight pl-2 pr-2 pt-2 roleplay-date">
                                <div class="bd-highlight"><?= $row->roleplay_type ?>, <?= $row->roleplay_date ?></div>
                                <div class="ml-auto bd-highlight">Ranked<b> #<?= $roleplayRanking ?></b></div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php $roleplayRanking++ ?>
                <?php endforeach ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>

    <!-- Javascript for Users page -->
</body>

</html>