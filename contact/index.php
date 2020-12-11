<?php require_once('../layout/token.php') ?>
<?php require_once('../database/db.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta property="og:image" content="../ovakun/aovchan/aman/banner2.png">
	<title>Hubungi Kami :: Contact Us</title>
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>

    <!-- Contact -->
    <section id="contact" class="section-half gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="product-area-title text-center">
                        <h2 class="h1 mt-4">Hubungi Kami</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mb-30 mx-auto">
                    <form id="contact-form" method="POST" class="contact-form">
                        <div class="single-input mb-10">
                            <input type="text" id="fname" name="fname" placeholder="Nama Lengkap">
                        </div>
                        <div class="single-input color-2 mb-10">
                            <input type="email" id="email" name="email" placeholder="Email">
                        </div>
                        <div class="single-input color-2 mb-10">
                            <textarea id="message" name="message" placeholder="Tulis pesanmu di sini..." maxlength="500"></textarea>
                        </div>
                            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
                            <button type="submit" class="mt-10 primary-btn text-uppercase">Send Message<span class="lnr lnr-arrow-right"></span></button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once('../layout/footer.php'); ?>
    <?php require_once('../layout/javascript.php'); ?>
    <script src="contact.js"></script>
</body>

</html>