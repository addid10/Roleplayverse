<?php require_once('../layout/token.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Top Characters Roleplayverse</title>
    <?php require_once('../layout/head.php'); ?>
    <link rel="shortcut icon" href="img/medal.png">
    <meta property="og:image" content="img/medal.png">
	<meta name="description" content="United Colosseum">
    <?php require_once('../database/db.php'); ?>
<style>
    .roleplay-information img.roleplay-topchart {
        width:55px;
    }
    .chara-fullname {
        font-size:120%;
    }

    .ranked-number span {
        font-size:28px;
    }
    /* .table-characters tr{
        background: linear-gradient(#000, #000);
    }
    .table-characters tr:nth-child(2){
        background: linear-gradient(#FFD700, #f0cc09);
    }
    .table-characters tr:nth-child(3){
        background: linear-gradient(#b0b0b0, #a7a7a7);
    }
    .table-characters tr td,
    .table-characters tr td a {
        color: #FFF !important;
    }

    .table-characters tr:nth-child(4){
        background: linear-gradient(#cd7f32, #ec9b4c)
    } */
</style>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <div class="topchart-area-title">
                        <p>Roleplayverse Charts</p>
                        <h2 id="topchart-title">Top Male United Colosseum Characters</h2>
                        <p id="topchart-subtitle" class="mute">Top 10 as rated by -</p>
                    </div>
                    <div class="row">
                        <form method="GET" style="display: contents;">
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select id="character-group" class="form-control group-by" name="chapter">
                                    <option value="3" selected disabled>Choose Chapter</option>
                                    <option value="3" <?php if(isset($_GET['chapter']) && $_GET['chapter'] == "3"){ echo "selected"; } ?>>Chapter 3</option>
                                    <option value="2" <?php if(isset($_GET['chapter']) && $_GET['chapter'] == "2"){ echo "selected"; } ?>>Chapter 2</option>
                                    <option value="1" <?php if(isset($_GET['chapter']) && $_GET['chapter'] == "1"){ echo "selected"; } ?>>Chapter 1</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <select id="character-group" class="form-control group-by" name="for">
                                    <option value="female" selected disabled>Choose Gender</option>
                                    <option value="female" <?php if(isset($_GET['for']) && $_GET['for'] == "female"){ echo "selected"; } ?>>Female</option>
                                    <option value="male" <?php if(isset($_GET['for']) && $_GET['for'] == "male"){ echo "selected"; } ?>>Male</option>
                                </select>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4">
                                <button type="submit" class="btn btn-rate p-2">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="roleplay-information top-characters">
                        <div class="table-responsive" id="rank-characters">
                        <?php if(isset($_GET['for']) && isset($_GET['chapter'])): ?>
                        <?php
                            $for = $_GET['for'];
                            $chapter = $_GET['chapter'];
                            $query = "";
                            $query .= "SELECT * FROM colosseum_rankings ";

                            if($for == "female" && $chapter == 1){
                                $query .= "WHERE chapter=1 AND gender='female'";
                            } else if ($for == "male" && $chapter == 1){
                                $query .= "WHERE chapter=1 AND gender='male'";
                            } else if ($for == "female" && $chapter == 2){
                                $query .= "WHERE chapter=2 AND gender='female'";
                            } else if ($for == "male" && $chapter == 2){
                                $query .= "WHERE chapter=2 AND gender='male'";
                            } else if ($for == "female" && $chapter == 3){
                                $query .= "WHERE chapter=3 AND gender='female'";
                            } else if ($for == "male" && $chapter == 3){
                                $query .= "WHERE chapter=3 AND gender='male'";
                            } else if ($for == "female" && $chapter == 4){
                                $query .= "WHERE chapter=4 AND gender='female'";
                            } else if ($for == "male" && $chapter == 4){
                                $query .= "WHERE chapter=4 AND gender='male'";
                            }

                            $query .= "ORDER BY ranking ASC";
                            $rankings = $connection->prepare($query);
                            $rankings->execute();
                            $ranking = $rankings->fetchAll(PDO::FETCH_OBJ);

                        ?>
                            <table class="table table-characters table-stripped" id="table-rate-characters">
                                <tr>
                                    <th>Rank</th>
                                    <th colspan="2">Character Name</th>
                                    <th>Information</th>
                                </tr>
                                <?php foreach($ranking as $row): ?>
                                <tr>
                                    <td width="10%" class="text-center ranked-number"><span><?= $row->ranking ?></span></td>
                                    <td width="5%">
                                        <a class="d-block" href="#">
                                            <img class="roleplay-topchart  mr-2" src="img/ocs/<?= $row->photo ?>">
                                        </a>
                                    </td>
                                    <td width="50%" class="pl-0">
                                        <a class="d-block" href="#">
                                            <span class="chara-fullname"><?= $row->fullname ?></span>
                                        </a>
                                    </td>
                                    <td width="15%" class="text-center">
                                        <img src="img/c-<?= $row->info ?>.png" alt="" width="60px">
                                        <div style="font-size:15px;"><b><?= $row->info_symbol ?></b></div>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            </table>
                            <?php endif ?>
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