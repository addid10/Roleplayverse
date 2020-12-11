<?php require_once('../layout/token.php'); ?>
<?php require_once('home.news.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta property="og:image" content="../ovakun/aovchan/aman/news.jpg"> 
	<meta property="og:title" content="News :: Roleplayverse">
	<meta name="keywords" content="News :: Roleplayverse">
    <title>News :: Roleplayverse</title>
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
                        <h2 class="text-uppercase pt-5 text-white">NEWS</h2>
                        <p class="text-white">Articles | Soft News </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="blog" class="section-half gray-bg">
        <div class="container">
            <div class="row">
				<div class="col-md-8 col-sm-7">
                    <?php foreach($rows as $row): ?>
					<div class="post-item">
						<div class="post-thumbnail">
							<img src="../aovchan/picture/news/<?= $row->photos ?>" alt="">
							<div class="post-date">
								<h2><?php $day = date('d', strtotime($row->create_at)); echo $day ?></h2>
								<h3><?php $month = date('m', strtotime($row->create_at)); echo $bulan[$month] ?> <?php $year = date('Y', strtotime($row->create_at)); echo $year; ?></h3>
							</div>
						</div>
						<div class="post-content">
							<h2 class="post-title"><?= $row->title ?></h2>
							<div class="post-meta">
								<span><i class="fa fa-user"></i> <?= $row->fullname ?></span>
								<span><i class="fa fa-circle"></i> <?= $row->category_name ?></span>
							</div>
                            <p><?php $contents = explode(".",$row->contents); echo $contents[0] ?>.</p>
                            <a href="../news/<?= $row->news_id ?>" class="primary-btn d-inline-flex align-items-center">Selengkapnya<span class="lnr lnr-arrow-right"></span></a>
						</div>
                    </div>
                    <?php endforeach ?>
                </div>
				<div class="col-md-4 col-sm-5 sidebar">
                    <?php require_once('category.php'); ?>
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