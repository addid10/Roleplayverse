<?php require_once('../layout/token.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>My Stats</title>
    <?php require_once('../layout/head.php'); ?>
    <link rel="stylesheet" href="css/colosseum.css">
</head>

<body class="login-area">
    <div id="top"></div>

    <section class="section-half">
        <div class="container">
            <div class="row" id="yourCanvas">
                <div class="col-lg-6">
                    <link href="https://fonts.googleapis.com/css?family=Orbitron" rel="stylesheet">
                    <div class="id-card-wrapper">
                        <div class="id-card">
                            <div class="profile-row">
                                <div class="dp">
                                    <div class="dp-arc-outer"></div>
                                    <div class="dp-arc-inner"></div>
                                    <img src="">
                                </div>
                                <div class="desc">
                                    <h1>Tony Stark</h1>
                                    <p>Strength: Ironman Suit</p>
                                    <p>Weakness: None</p>
                                    <p>Known as: Iron Man</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <canvas id="atalieBau" width="500" height="500"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/javascript.php'); ?>
    <script src="js/colosseum.js"></script>
    <!-- Javascript for Users page -->
</body>

</html>