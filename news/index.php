<?php require_once('../layout/token.php'); ?>
<?php if(isset($_GET['id'])): ?>
<?php require_once('index.news.php'); ?>
<?php if($row['counts']==1): ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <meta property="og:title" content="<?= $row['title'] ?>">
    <meta name="keywords" content="<?= $row['title'] ?>">
    <meta property="og:image" content="../aovchan/picture/news/<?= $row['photos'] ?>">
    <title>
        <?= $row['title'] ?>
    </title>
    <?php require_once('../layout/head.php'); ?>
</head>

<body>
    <div id="top"></div>
    <!-- Header -->
    <?php require_once('../layout/header.php'); ?>
    <section id="blog" class="section-full gray-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-7">
                    <div class="post-item">
                        <div class="post-thumbnail">
                            <img src="../aovchan/picture/news/<?= $row['photos'] ?>" alt="">
                            <div class="post-date">
                                <h2>
                                    <?php $day = date('d', strtotime($row['create_at'])); echo $day ?>
                                </h2>
                                <h3>
                                    <?php $month = date('m', strtotime($row['create_at'])); echo $bulan[$month] ?>
                                    <?php $year = date('Y', strtotime($row['create_at'])); echo $year; ?>
                                </h3>
                            </div>
                        </div>
                        <div class="post-content">
                            <h2 class="post-title">
                                <?= $row['title'] ?>
                            </h2>
                            <div class="post-meta">
                                <span><i class="fa fa-user"></i>
                                    <?= $row['fullname'] ?></span>
                                <span><i class="fa fa-circle"></i>
                                    <?= $row['category_name'] ?></span>
                            </div>
                            <p>
                                <?= $row['contents'] ?>
                            </p>
                        </div>
                        <div class="comments mt-5">
                            <?php require_once('index.comments.php'); ?>
                            <h2>Comments (<?= comments_count($id) ?>)</h2>
                            <ul class="comment-list">
                                <?php foreach($comment as $data): ?>
                                <li class="row">
                                    <div class="col-lg-2 col-sm-4 col-md-4 col-4">
                                        <div class="avatar">
                                            <img src="../aovchan/picture/profile/<?= $data['picture'] ?>" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-10 col-sm-8 col-md-8 col-8">
                                        <div class="comment-text">
                                            <h3>
                                                <a href="../profile/<?= $data['username'] ?>"><?= $data['fullname'] ?></a>
                                                <i class="fa fa-clock-o"></i>
                                                <?= date_convert($data['comment_at']) ?>
                                            </h3>
                                            <p>
                                                <?= $data['comments'] ?>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                        <?php if(isset($_SESSION['usernameMember'])): ?>
                        <div class="row">
                            <div class="col-md-9">
                                <h3>Leave a comment</h3>
                                <form class="form-class" id="news-form">
                                    <div class="single-input color-2 mb-10">
                                        <textarea id="comment" type="text" name="comment" placeholder="Tulis komentarmu"
                                            required maxlength="300"></textarea>
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <input type="hidden" name="id" value="<?= $id ?>" required>
                                        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" required>
                                        <button type="submit" class="mt-10 primary-btn text-uppercase"><i class="fa fa-commenting"></i>
                                            Balas</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
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
    <script src="news.js"></script>

    <!-- Javascript for Users page -->
</body>

</html>
<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>


<?php else: ?>
<?php header('location: ../404'); ?>
<?php endif ?>