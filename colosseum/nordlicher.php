<?php require_once('../layout/token.php'); ?>
<?php if(isset($_SESSION['coloseum_code']) && $_SESSION['coloseum_name'] == "Nordlicher"): ?>

<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Colosseum Information Center</title>
    <link rel="shortcut icon" href="img/logo.png">
    <meta property="og:image" content="img/logo.png">
    <?php require_once('../layout/head.php'); ?>
    <link rel="stylesheet" href="css/colosseum.css">
</head>

<body>
    <div id="top"></div>
    <section id="contact" class="section-half">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mx-auto">
                    <div class="pb-4 text-center">
                        <div class="title-content">
                            <h2 class="text-white text-uppercase">Nordlicher</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8 mx-auto">
                    <div class="accordion">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#information04">
                                        Aset
                                    </button>
                                </h5>
                            </div>
                            <div id="information04" class="collapse">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="stat-box">
                                                <div class="title">17</div>
                                                <div class="body">Members</div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="stat-box">
                                                <div class="title">25.000</div>
                                                <div class="body">Dollars</div>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="mb-0 mt-2">Power</p>
                                    <div class="container-bar">
                                        <div class="skills attack">10%</div>
                                    </div>

                                    <p class="mb-0 mt-2">Defense</p>
                                    <div class="container-bar">
                                        <div class="skills defense">10%</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse"
                                        data-target="#information03">
                                        Kunci Kemenangan Tahap 1
                                    </button>
                                </h5>
                            </div>
                            <div id="information03" class="collapse">
                                <div class="card-body">
                                    Jangan sebarkan jabatan kepada kubu lain.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer -->
    <?php require_once('../layout/javascript.php'); ?>
    <script src="js/login.js"></script>

    <!-- Javascript for Users page -->
</body>

</html>
<?php else: ?>
<?php header('location: ../colosseum'); ?>
<?php endif ?>