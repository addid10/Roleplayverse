<?php require_once('../layout/token.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Multiverse</title>
    <?php require_once('../layout/head.php'); ?>
    <link rel="stylesheet" href="assets/css/multiverse.css">

</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>

    <!-- Content -->
    <section class="section-half mt-3 overlay-bg pb-0">
        <div class="section-title text-center pb-3">
            <h2>Multiverse</h2>
            <div class="row mr-0 ml-0">
                <div class="col-md-6 mx-auto">
                    <p class="roleplay-paragraph">Multiverse (Universes) merupakan himpunan atau kumpulan dari berbagai alam semesta
                        (universe) yang bisa
                        saling terhubung melalui ruang-waktu. Setiap Universe memiliki karakteristik tersendiri dengan
                        waktu,
                        besaran, luas, muatan, massa, dan lainnya yang berbeda. Tiap-tiap Universe juga memiliki sistem
                        dan
                        aturan yang berbeda sehingga tidak dapat disatukan.

                    </p>
                    <p class="roleplay-paragraph">
                    Dalam fiksi ini, Multiverse diketahui terbagi menjadi tiga kumpulan utama yang saling terhubung, yaitu: Bubble, Parallel, dan Paradox. Berfokus pada 26 universe dalam satu multiverse yang memiliki sistem hierarkis. Yang teratas adalah yang terbaik!
                    </p>

                </div>

            </div>
            <h3 id="startThisStory">Mulai Cerita!</h3>
            <h5 id="labelStory"><i>Click on the button</i></h5>
        </div>
        <div class="mb-5 d-flex justify-content-center">
            <a id="start" class="d-block play-btn"></a>
        </div>
    </section>

    <!-- Music -->
    <audio preload="auto" src="assets/music/warning.mp3" id="warning"></audio>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <script src="assets/js/multiverse.js"></script>
</body>

</html>