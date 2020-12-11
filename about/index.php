<?php require_once('../layout/token.php'); ?>
<?php require_once('../database/db.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Tentang Kami :: About Us</title>
	<meta property="og:image" content="../ovakun/aovchan/aman/banner2.png">
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <!-- Content -->

    <section id="team" class="section-half mt-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="product-area-title text-center pb-2">
                        <p class="text-uppercase">Creative Team</p>
                        <h2 class="h1">Team yang membuat RoleplayVerse.site bisa ada <br></h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="single-member">
                        <div class="thumb relative about-aov">
                            <div class="overlay overlay-member aov d-flex flex-column justify-content-end align-items-center"></div>
                        </div>
                        <div class="desc text-center">
                            <h5 class="text-uppercase"><a href="#">Aov-chan</a></h5>
                            <p>Creative Director</p>
                            <button type="button" class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center button-aov">
                                Read More<span class="lnr lnr-arrow-down"></span></button>
                            <div class="aov">
                                <p class="info mt-2">Merupakan <b>Creative Director</b> atau bisa disebut sebagai
                                    pemimpin kreatif. Orang yang memberikan banyak ide, termasuk fitur di dalam website
                                    kecil ini.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-member">
                        <div class="thumb relative about-tomy">
                            <div class="overlay overlay-member tomy d-flex flex-column justify-content-end align-items-center">
                            </div>
                        </div>
                        <div class="desc text-center">
                            <h5 class="text-uppercase"><a href="#">Tomy</a></h5>
                            <p>RS Developer</p>
                            <button type="button" class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center button-tomy">
                                Read More<span class="lnr lnr-arrow-down"></span></button>
                            <div class="tomy">
                                <p class="info mt-2">Merupakan <b>Roleplay Stories Developer</b> atau orang yang selama
                                    ini telah berusaha untuk mengembangkan Roleplay Stories agar semakin mendunia.</p>
                                <p class="info mt-2">Berkat usaha-nya membuat grup seperti <b>Hakoniwa Mahou Gakuen</b>,
                                    <b>The Hexe</b>, dan sebagainya, Roleplay Stories menjadi lebih dikenal orang
                                    banyak.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-member">
                        <div class="thumb relative about-kayo">
                            <div class="overlay overlay-member kayo d-flex flex-column justify-content-end align-items-center">
                            </div>
                        </div>
                        <div class="desc text-center">
                            <h5 class="text-uppercase"><a href="#">Irene</a></h5>
                            <p>UI Designer</p>
                            <button type="button" class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center button-kayo">
                                Read More<span class="lnr lnr-arrow-down"></span></button>
                            <div class="kayo">
                                <p class="info mt-2">Merupakan <b>User Interface Designer</b>, orang yang membuat
                                    tampilan antarmuka (interface) untuk suatu produk digital sebelum dikembangkan oleh
                                    Front End Developer.</p>
                                <p class="info mt-2">Tata Letak (Layout) dari website ini adalah kreasi darinya.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="single-member">
                        <div class="thumb relative about-fendy">
                            <div class="overlay overlay-member d-flex flex-column justify-content-end align-items-center">
                            </div>
                        </div>
                        <div class="desc text-center">
                            <h5 class="text-uppercase"><a href="#">Kagami</a></h5>
                            <p>Developer</p>
                            <button type="button" class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center button-kagami">
                                Read More<span class="lnr lnr-arrow-down"></span></button>
                            <div class="kagami">
                                <p class="info mt-2">Orang yang mengembangkan website ini. Ganteng kok orangnya. <b>Mau
                                        kenalan?</b> <img src="../aovchan/picture/about/chibi-kagami.png" width="40%"></p>

                                <a href="https://www.facebook.com/kagami.hirotou" target="_blank" class="kagami-blink"><img class="mt-2"
                                        src="../aovchan/picture/about/facebook.png" width="70%"></a>
                                <p class="text-kagami mt-2">Salam kenal, whuehehe</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-area">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 d-flex no-flex-xs justify-content-between align-items-center">
                    <h5 class="text-uppercase text-white">Ingin langsung menghubungi kami?</h5>
                    <a href="#" class="primary-btn d-inline-flex text-uppercase text-white align-items-center">Kontak
                        kami<span class="lnr lnr-arrow-right"></span></a>
                </div>
            </div>
        </div>
    </section>
    <section class="partner-area section-half">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="product-area-title text-center pb-2">
                        <p class="text-uppercase">Partner</p>
                        <h2 class="text-white">Rekan yang membantu kami dalam membentuk website ini.</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-2 d-flex no-flex-xs justify-content-between align-items-center">
                    <table class="table table-borderless table-partner">
                        <tr>
                            <td><a href="https://www.facebook.com/groups/FUFCA" target="_blank"><img src="../aovchan/picture/about/fufca.png" width="100%"></a></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <script src="about.js"></script>
</body>

</html>