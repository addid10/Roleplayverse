<?php require_once('../layout/token.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Emperor Xuan :: Tournament</title>
    <?php require_once('../layout/head.php'); ?>
    <link rel="stylesheet" href="venobox/venobox.css">
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>

    <!-- Content -->
    <section class="section-half mt-3 overlay-bg pb-0">
        <div class="section-title text-center pb-3">
            <h2>XUAN TOURNAMENT</h2>
            <h3><i>Click on the button</i></h3>
        </div>
        <div class="d-flex justify-content-center">
            <a href="https://www.youtube.com/watch?v=qHfsgJoUWqQ" class="d-block venobox play-btn" data-vbtype="video"
                data-autoplay="true"></a>
        </div>
    </section>
    <div id="carouselExampleControls" class="carousel slide carousel-fade" data-ride="carousel" data-interval="2000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="tournament/Eighth-finals-01.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-02.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-03.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-04.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-05.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-06.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-07.png">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="tournament/Eighth-finals-08.png">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <script src="venobox/venobox.min.js"></script>
</body>
<script>
    $('.venobox').venobox({
        bgcolor: '',
        overlayColor: 'rgba(60, 64, 143, 0.95)',
        closeBackground: '',
        closeColor: '#fff'
    });
</script>

</html>