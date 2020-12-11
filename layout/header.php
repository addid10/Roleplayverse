<header class="default-header other-header">
    <div class="container">
        <div class="header-content d-flex justify-content-between align-items-center">
            <div class="logo">
                <a href="../" class="smooth"><img src="../ovakun/aovchan/aman/logo.png" alt=""></a>
            </div>
            <div class="right-bar d-flex align-items-center">
                <nav class="d-flex align-items-center">
                    <ul class="main-menu">
                        <li><a href="../">Home</a></li>
                        <li><a href="../roleplay_stories/roleplay">Roleplay Stories</a></li>
                        <li class="nav-item dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">Original Characters</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item m-0" href="../chart/characters">Top Rated Characters</a>
                                <a class="dropdown-item m-0" href="../chart/characters?by=favorites">Most Favorited Characters</a>
                            </div>
                        </li>
                        <?php if(isset($_SESSION['usernameMember'])): ?>
						<li class="nav-item dropdown">
							<?php require_once('header.profile.php'); ?>
							<a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
							    <?php if(!empty($picture['picture']) && $picture['picture']!="default.png"): ?>
								<img class="img-circle" src="../aovchan/picture/profile/<?= $picture['picture'] ?>"> <?= $_SESSION['usernameMember']; ?>
								<?php else: ?>
								<img class="img-circle" src="../aovchan/picture/profile/member.png"> <?= $_SESSION['usernameMember']; ?>
								<?php endif ?>
							</a>
							<div class="dropdown-menu">
								<a class="dropdown-item m-0" href="../profile/<?=$_SESSION['usernameMember'] ?>">My Profile</a>
								<a class="dropdown-item m-0" href="../profile/dashboard">My Dashboard</a>
								<a class="dropdown-item m-0" href="../users/logout"><i class="fa fa-sign-out"></i> Logout</a>
							</div>
						</li>
                        <?php else: ?>
                        <li><a href="../users/login"><i class="fa fa-sign-in"></i> Login</a></li>
                        <?php endif ?>
                    </ul>
                    <a href="#" class="mobile-btn"><span class="lnr lnr-menu"></span></a>
                </nav>
                <div class="search relative">
                    <span class="lnr lnr-magnifier"></span>
                    <form action="../search" class="search-field">
                        <input type="text" name="q" placeholder="Search here">
                        <input type="hidden" name="filter" value="all">
                        <button class="search-submit"><span class="lnr lnr-magnifier"></span></button>
                    </form>
                </div>
                <div class="header-social d-flex align-items-center">
                    <a href="https://www.facebook.com/AoVRoleplay" target="_blank"><i class="fa fa-facebook"></i></a>
                    <a href="http://id.roleplay-stories.wikia.com" target="_blank"><i class="fa fa-wikipedia-w"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>