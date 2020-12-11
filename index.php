<?php session_start(); ?>
<?php require_once('database/db.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" href="ovakun/aovchan/aman/fav.png"> 
	<meta property="og:image" content="ovakun/aovchan/aman/banner.jpg"> 
	<meta name="author" content="Aov-chan">
	<meta name="description" content="Rate Your Original Characters">
	<meta property="og:title" content="Roleplayverse">
	<meta name="keywords" content="Roleplayverse">
	<meta charset="UTF-8">
	<title>Welcome to Roleplayverse!</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:300,500,600" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/linearicons.css">
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/animate.css">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/main.css">
</head>

<body>
	<div id="top"></div>
	<!-- Start Header Area -->
	<header class="default-header">
		<div class="container">
			<div class="header-content d-flex justify-content-between align-items-center">
				<div class="logo">
					<a href="../" class="smooth"><img src="ovakun/aovchan/aman/logo.png" alt=""></a>
				</div>
				<div class="right-bar d-flex align-items-center">
					<nav class="d-flex align-items-center">
						<ul class="main-menu">
							<li><a class="active" href="#">Home</a></li>
                        	<li><a href="roleplay_stories/roleplay">Roleplay Stories</a></li>
							<li class="nav-item dropdown">
								<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
									Original Characters
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item m-0" href="chart/characters">Top Rated Characters</a>
									<a class="dropdown-item m-0" href="chart/characters?by=favorites">Most Favorited Characters</a>
								</div>
							</li>
							<?php if(isset($_SESSION['usernameMember'])): ?>
							<li class="nav-item dropdown">
							    <?php require_once('layout/header.profile.php'); ?>
								<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
    							    <?php if(!empty($picture['picture']) && $picture['picture']!="default.png"): ?>
    								<img class="img-circle" src="aovchan/picture/profile/<?= $picture['picture'] ?>"> <?= $_SESSION['usernameMember']; ?>
    								<?php else: ?>
    								<img class="img-circle" src="aovchan/picture/profile/member.png"> <?= $_SESSION['usernameMember']; ?>
    								<?php endif ?>
								</a>
								<div class="dropdown-menu">
									<a class="dropdown-item m-0" href="profile/<?=$_SESSION['usernameMember'] ?>">My Profile</a>
								    <a class="dropdown-item m-0" href="profile/dashboard">My Dashboard</a>
									<a class="dropdown-item m-0" href="users/logout"><i class="fa fa-sign-out"></i> Logout</a>
								</div>
							</li>
							<?php else: ?>
							<li><a href="users/login"><i class="fa fa-sign-in"></i> Login</a></li>
							<?php endif ?>
						</ul>
						<a href="#" class="mobile-btn"><span class="lnr lnr-menu"></span></a>
					</nav>
					<div class="search relative">
						<span class="lnr lnr-magnifier"></span>
                        <form action="search" class="search-field">
                            <input type="text" name="q" placeholder="Search here">
                            <input type="hidden" name="filter" value="all">
                            <button class="search-submit"><span class="lnr lnr-magnifier"></span></button>
                        </form>
					</div>
					<div class="header-social d-flex align-items-center">
						<a href="https://www.facebook.com/AoVRoleplay"><i class="fa fa-facebook"></i></a>
						<a href="http://id.roleplay-stories.wikia.com"><i class="fa fa-wikipedia-w"></i></a>
					</div>
				</div>
			</div>
		</div>
	</header>
	<!-- End Header Area -->
	<!-- Start Banner Area -->
	<section class="banner-area relative">
		<div id="roleplaySlider" class="carousel slide carousel-fade" data-ride="carousel">
			<div class="carousel-inner">
				<div class="carousel-item active">
					<div class="overlay overlay-bg"></div>
					<img class="d-block w-100" src="ovakun/aovchan/aman/banner.jpg" alt="First slide">
					<div class="carousel-caption d-none d-md-block">
						<div class="text-center">
							<p class="text-uppercase text-white">RoleplayVerse</p>
							<h1 class="text-uppercase text-white">Rate Your Original Characters</h1>
							<a href="roleplay_stories/roleplay" class="primary-btn banner-btn">Selengkapnya</a>
						</div>
					</div>
				</div>
				<div class="carousel-item">
					<div class="overlay overlay-bg-villain"></div>
					<img class="d-block w-100" src="ovakun/aovchan/aman/banner2.png" alt="Second slide">
					<div class="carousel-caption d-none d-md-block">
						<div class="text-center">
							<p class="text-uppercase text-white">RoleplayVerse</p>
							<h1 class="text-uppercase text-white">Best Roleplay-Stories Villain</h1>
							<a href="#" class="primary-btn banner-btn">COMING SOON</a>
						</div>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#roleplaySlider" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#roleplaySlider" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</section>

	<!-- Start About Area -->
	<section class="section-half gray-bg">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-10">
					<div class="section-title text-center">
						<h2>Welcome to RoleplayVerse.site!</h2>
						<h3>Tempat di mana <b>Penulis</b> atau <b>Pemain RolePlay</b> saling menilai karakter yang telah dibuat, entah
							dengan wujud buatan sendiri atau memakai karakter animasi lain.</h4>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 col-sm-12">
					<figure class="signle-service">
						<img src="ovakun/aovchan/aman/welcome-aov.png" alt="">
						<figcaption class="text-center">
							<h5 class="text-uppercase">Top Characters</h5>
							<p>Karakter dengan <b>score</b> atau <b>rate</b> tertinggi yang diberikan oleh banyak member. Karakter ini berasal dari Roleplay Stories</p>
							<a href="chart/characters" class="primary-btn d-inline-flex align-items-center">Explore<span class="lnr lnr-arrow-right"></span></a>
						</figcaption>
					</figure>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<figure class="signle-service">
						<img src="ovakun/aovchan/aman/roleplay-stories.png" alt="">
						<figcaption class="text-center">
							<h5 class="text-uppercase">Roleplay</h5>
							<p>Kumpulan Roleplay. Seperti Roleplay Stories, roleplay yang memiliki cerita secara garis besar untuk seluruh karakter yang terlibat.</p>
							<a href="roleplay_stories/roleplay" class="primary-btn d-inline-flex align-items-center">Explore<span class="lnr lnr-arrow-right"></span></a>
						</figcaption>
					</figure>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<figure class="signle-service">
						<img src="ovakun/aovchan/aman/most-favorited.png" alt="">
						<figcaption class="text-center">
							<h5 class="text-uppercase">Most Favorited Characters</h5>
							<p>Karakter dengan jumlah <b>penyuka</b> terbanyak yang difavoritkan oleh banyak member. Karakter ini berasal dari Roleplay Stories</p>
							<a href="chart/characters?by=favorites" class="primary-btn d-inline-flex align-items-center">Explore<span class="lnr lnr-arrow-right"></span></a>
						</figcaption>
					</figure>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<figure class="signle-service">
						<img src="ovakun/aovchan/aman/theelite.png" alt="">
						<figcaption class="text-center">
							<h5 class="text-uppercase">Affiliation</h5>
							<p>Hubungan yang didasari dalam mencapai tujuan yang sama. Biasanya merupakan organisasi, tim, atau kelompok kecil.</p>
							<a href="../affiliation/home" class="primary-btn d-inline-flex align-items-center">Explore<span class="lnr lnr-arrow-right"></span></a>
						</figcaption>
					</figure>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<figure class="signle-service">
						<img src="ovakun/aovchan/aman/aov-awards.png" alt="">
						<figcaption class="text-center">
							<h5 class="text-uppercase">Awards</h5>
							<p><b>Penghargaan</b> yang diberikan oleh karakter dengan spesifik tertentu. Dipilih melalui voting atau langsung dari admin.</p>
							<a href="#" id="roleplayverse-awards" class="primary-btn d-inline-flex align-items-center">Explore<span class="lnr lnr-arrow-right"></span></a>
						</figcaption>
					</figure>
				</div>
				<div class="col-lg-4 col-md-6 col-sm-12">
					<figure class="signle-service">
						<img src="ovakun/aovchan/aman/news.png" alt="">
						<figcaption class="text-center">
							<h5 class="text-uppercase">NEWS</h5>
							<p>Membahas seputar roleplay terutama <b>Roleplay Stories</b> yang masih menjadi hal yang diperbincangkan.</p>
							<a href="../news/home" class="primary-btn d-inline-flex align-items-center">Explore<span class="lnr lnr-arrow-right"></span></a>
						</figcaption>
					</figure>
				</div>
			</div>
		</div>
	</section>

	<!-- Start Digital Studio -->
	<section class="section-full studio-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="studio-content">
						<h2 class="h1 text-white text-uppercase mb-20">RATE YOUR CHARACTERS Absolutely</h2>
						<p class="text-white mb-30 text-justify mr-3">Member bisa mendaftarkan original karakter dengan <b>faceclaim</b> yang 
							berasal dari <b>fandom lain</b> atau buatan sendiri dengan mencantumkan asal <b>Roleplay Stories-nya</b>. 
							Setelah itu, member lainnya bisa menilai atau memberikan rating kepada karakter tersebut.</p>
						<h4 class="text-white mb-30">Punya karakter yang ingin didaftarkan?</h4>
						<a href="users/signup" class="primary-btn text-white d-inline-flex align-items-center">Daftar Sekarang<span class="lnr lnr-arrow-right"></span></a>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Quotes -->
	<section class="section-half gray-bg">
		<div class="container">
			<div class="active-testimonial-carousel">
				<?php require_once('content/quotes.php'); ?>
				<?php foreach($quotes as $data): ?>
				<div class="single-testimonial">
					<img src="aovchan/picture/quotes/<?= $data->image ?>" class="img-circle" alt="">
					<p><i class="fa fa-quote-left"></i>
						<?= $data->quotes ?>
					</p>
					<div class="author text-center">
						<div class="d-flex justify-content-end">
							<h6>—<a href="#">
									<?= $data->character_name ?></a>
								<?php if(!empty($data->target)): ?>
								, to
								<?= $data->target ?>
								<?php endif ?>
							</h6>
						</div>
						<div class="d-flex justify-content-end">
							<span>
								<?= $data->roleplay_stories ?></span>
						</div>
					</div>
				</div>
				<?php endforeach ?>
			</div>
		</div>
	</section>

	<!-- Footer -->
	<?php require_once('content/comingsoon.php'); ?>
	<?php require_once('layout/footer.php'); ?>


	<script src="ovakun/aovchan/private/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
	 crossorigin="anonymous"></script>
	<script src="ovakun/aovchan/private/bootstrap-home.min.js"></script>
	<script src="ovakun/aovchan/private/jquery.ajaxchimp.min.js"></script>
	<script src="ovakun/aovchan/private/jquery.sticky.js"></script>
	<script src="ovakun/aovchan/private/owl.carousel.min.js"></script>
	<script src="ovakun/aovchan/private/mixitup.min.js"></script>
	<script src="ovakun/aovchan/private/main.js"></script>
</body>

</html>