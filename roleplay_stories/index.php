<?php require_once('../layout/token.php'); ?>

<?php if(isset($_GET['id'])): ?>
<?php /*Ambil Roleplay*/ require_once('roleplay.detail.php'); ?>
<?php if($row['count']== 1): ?>


<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta property="og:title" content="<?= $row['roleplay_name'] ?>">
	<meta name="keywords" content="<?= $row['roleplay_name'] ?>">
	<meta property="og:image" content="../aovchan/picture/roleplay/<?= $row['roleplay_cover'] ?>">
    <title><?= $row['roleplay_name'] ?></title>
    <?php require_once('../layout/head.php'); ?> 
</head>

<body>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div id="roleplaySlider" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="d-flex justify-content-center">
                            <img class="d-block banner-roleplay" src="../aovchan/picture/roleplay/<?= $row['roleplay_cover'] ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="d-flex justify-content-center">
                <h2 class="mt-3 roleplay-title text-uppercase">
                    <?= $row['roleplay_name'] ?>
                </h2>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-7">
                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="information-tab" data-toggle="tab" href="#information" role="tab"
                                aria-controls="information" aria-selected="true">Information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#gallery" role="tab"
                                aria-controls="gallery" aria-selected="false">Gallery</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#arcs" role="tab"
                                aria-controls="arcs" aria-selected="false">List of Arcs</a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="information-tab">
                            <div class="row">
                                <div class="col-lg-5 col-md-5">
                                    <div class="roleplay-information">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 header">
                                                    <span class="information-header">Title</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mb-0 ">
                                                    <span class="information-question">Full Title:</span>
                                                    <span class="information-answer"><?= $row['roleplay_name'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mb-0 ">
                                                    <span class="information-question">Alternative Title:</span>
                                                    <span class="information-answer"><?= $row['roleplay_other_name'] ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 header">
                                                    <span class="information-header">Information</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Type:</span>
                                                    <span class="information-answer"><?= $row['roleplay_type'] ?></span>
                                                </div>
                                            </div>
                                            <?php if($row['roleplay_type']=="Roleplay Story"): ?>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Chapters:</span>
                                                    <span class="information-answer"><?= $row['roleplay_chapters'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Status:</span>
                                                    <span class="information-answer"><?= $row['roleplay_status'] ?></span>
                                                </div>
                                            </div>
                                            <?php endif ?>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Release Date:</span>
                                                    <span class="information-answer"><?= date_convert($row['roleplay_date']) ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Source:</span>
                                                    <span class="information-answer"><?= $row['roleplay_source'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Creators:</span>
                                                    <span class="information-answer"><?= $row['roleplay_creator'] ?></span>
                                                </div>
                                            </div>
                                            <?php if($row['roleplay_type']=="Roleplay Story"): ?>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Genres:</span>
                                                    <span class="information-answer"><?= $row['roleplay_genres'] ?></span>
                                                </div>
                                            </div>
                                            <?php endif ?>
                                        </div>
                                        <?php if($row['multiverse']==1): ?>
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 header">
                                                    <span class="information-header">Multiverse Information</span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">King's name:</span>
                                                    <span class="information-answer level"><a></a></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Ranking:</span>
                                                    <span class="information-answer level"><?= $row['universe_ranking'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Years:</span>
                                                    <span class="information-answer"><?= $row['universe_year'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Worlds:</span>
                                                    <span class="information-answer"><?= $row['universe_world'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Condition:</span>
                                                    <span class="information-answer">
                                                        <?php if ($row['universe_condition']==1): ?>
                                                            <span class="badge badge-success">Active</span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger">Non-active</span>
                                                        <?php endif ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="ml-3 mr-3 mb-0 ">
                                                    <span class="information-question">Characteristic:</span><br>
                                                    <span class="information-answer">
                                                        <?= $row['universe_characteristic'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif?>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7">
                                    <div class="synopsis">
                                        <div class="mt-2">
                                            <p>
                                                <?= $row['universe_synopsis'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="gallery" role="tabpanel">
                            <img src="../ovakun/aovchan/aman/comingsoon.png" width="100%">
                        </div>
                        <div class="tab-pane fade" id="arcs" role="tabpanel">
                            <img src="../ovakun/aovchan/aman/comingsoon.png" width="100%">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="roleplay-statistic">
                                <div class="d-flex bd-highlight">
                                    <div class="mr-auto bd-highlight" style="width: 150px;">
                                        <table class="table table-borderless table-score text-center">
                                            <tr>
                                                <td class="badge-aov text-right">
                                                    <img class="aov-chan" src="../ovakun/aovchan/aman/aov.png">
                                                    <span class="pr-2">Aov-chan Score</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="aov-score"><?= $row['roleplay_score'] ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="bd-highlight">
                                        <table class="table table-borderless table-popularity text-center">
                                            <tr>
                                                <td class="badge-normal">Ranked
                                                </td>
                                                <!-- 
                                                <td class="badge-normal">
                                                    Favorites
                                                </td> -->
                                            </tr>
                                            <tr>
                                                <?php require_once('roleplay.ranking.php'); ?>
                                                <td class="normal-score">#<?=$ranking['rank']?></td>
                                                <!-- 
                                                <td class="normal-score">180</td> -->
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mt-3">
                                <span class="information-header">
                                    <h4 class="text-uppercase">LIST OF CHARACTERS</h4>
                                </span>
                            </div>
                        </div>
                    </div>
                    <ul class="nav nav-tabs mt-3" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#hero" role="tab" aria-selected="true">Main</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#support" role="tab" aria-selected="false">Support</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#guest" role="tab" aria-selected="false">Guest</a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="hero" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="roleplay-information p-0">
                                        <table class="table table-characters table-borderless mt-2 mb-2">
                                            <?php require_once('roleplay.characters.main.php'); ?>
                                            <?php foreach($mainRow as $row): ?>
                                            <tr>
                                                <td width="3%"><img class="roleplay-characters" src="../aovchan/picture/character/<?= $row['faceclaim'] ?>"></td>
                                                <td><a href="../character/<?=$row['character_id']?>"><?= $row['character_fullname'] ?></a><br>Main</td>
                                                <td class="text-right">
                                                    <?php if($row['character_gender']== "M"){
                                                        echo "Male";
                                                    } else {
                                                        echo "Female";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="support" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="roleplay-information p-0">
                                        <table class="table table-characters table-borderless mt-2 mb-2">
                                            <?php require_once('roleplay.characters.support.php'); ?>
                                            <?php foreach($supportRow as $row): ?>
                                            <tr>
                                                <td width="3%"><img class="roleplay-characters" src="../aovchan/picture/character/<?= $row['faceclaim'] ?>"></td>
                                                <td><a href="../character/<?=$row['character_id']?>"><?= $row['character_fullname'] ?></a><br>Supporting</td>
                                                <td class="text-right">
                                                    <?php if($row['character_gender']== "M"){
                                                        echo "Male";
                                                    } else {
                                                        echo "Female";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="guest" role="tabpanel">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="roleplay-information p-0">
                                        <table class="table table-characters table-borderless mt-2 mb-2">
                                            <?php require_once('roleplay.characters.guest.php'); ?>
                                            <?php foreach($guestRow as $row): ?>
                                            <tr>
                                                <td width="3%"><img class="roleplay-characters" src="../aovchan/picture/character/<?= $row['faceclaim'] ?>"></td>
                                                <td><a href="../character/<?=$row['character_id']?>"><?= $row['character_fullname'] ?></a><br>Guest</td>
                                                <td class="text-right">
                                                    <?php if($row['character_gender']== "M"){
                                                        echo "Male";
                                                    } else {
                                                        echo "Female";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php endforeach ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>

    <!-- Javascript for Users page -->
</body>

</html>
<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>


<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>