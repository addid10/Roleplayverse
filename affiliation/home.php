<?php require_once('../layout/token.php'); ?>
<?php require_once('home.list.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Affiliation :: Roleplayverse</title>
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-quarter news-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="product-area-title text-right pb-4">
                        <h2 class="text-uppercase pt-5 text-white">Affiliation</h2>
                        <p class="text-white">Team | Organization | Duo | Trio </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div class="row">
                <?php foreach($rows as $data): ?>
                <div class="col-md-6 mb-4">
                    <div class="affiliation row">
                        <div class="col-md-5 pr-0">
                            <img src="../aovchan/picture/character/<?= $data->faceclaim ?>" style="width: 100%;height: 100%;object-fit: cover;" alt="">
                        </div>
                        <div class="col-md-7 pl-0">
                            <figure class="signle-service mt-0">
                                <figcaption class="text-center">
                                    <h5 class="text-uppercase">
                                        <?= $data->affiliation_name ?>
                                    </h5>
                                    <p>
                                        <?php 
                                            $string = strip_tags($data->affiliation_description);
                                            if (strlen($string) > 100) {
                                            
                                                // truncate string
                                                $stringCut = substr($string, 0, 100);
                                                $endPoint = strrpos($stringCut, ' ');
                                            
                                                //if the string doesn't contain any space then it will cut without word basis.
                                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                $string .= ' . . .';
                                            }
                                            echo $string;
                                        ?>
                                    </p>
                                    <a href="<?= $data->affiliation_id ?>" class="primary-btn d-inline-flex align-items-center">Read More<span class="lnr lnr-arrow-right"></span></a>
                                </figcaption>
                            </figure>
                        </div>
                    </div>
                </div>
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