<?php require_once('../layout/token.php'); ?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <title>Colosseum :: Company Positions</title>
    <?php require_once('../layout/head.php'); ?>
    <link rel="stylesheet" href="css/colosseum.css">
</head>

<body class="body-content">
    <div id="top"></div>

    <section id="contact" class="section-half pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mx-auto" >
                    <div class="pb-4 text-center">
                        <div class="title-content">
                            <h2 class="text-white text-uppercase">Roles/Positions</h2>

                        </div>
                    </div>
                </div>
            </div>
            <!--<div class="row justify-content-center">-->
            <!--    <div class="col-lg-6 mb-30">-->
            <!--        <form id="uploadForm" method="POST" action="role.server.php" enctype="multipart/form-data">-->
            <!--            <div class="form-group">-->
            <!--                <input type="file" class="form-control-file" name="file" accept=".rar, .zip">-->
            <!--            </div>-->
            <!--            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>" required>-->
            <!--            <div class="d-flex justify-content-end">-->
            <!--                <button type="submit"-->
            <!--                    class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center text-center text-white w-100">-->
            <!--                    Upload<span class="lnr lnr-upload"></span></button>-->
            <!--            </div>-->
            <!--        </form>-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <?php 
            require_once('../database/db.php');
            $files = $connection->prepare("SELECT * FROM colosseum_files");
            $files->execute();

            $file = $files->fetchAll(PDO::FETCH_OBJ);
        ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mx-auto" >
                    <div class="pb-4 mt-2 text-center">
                        <div class="row">
                            <?php foreach($file as $data): ?>
                            <div class="col-lg-6">
                                <a href="file/<?= $data->files ?>" target='_blank' class="d-block w-100" download>
                                    <img src="img/winrar.png" class="w-100">
                                </a>
                                <label class="text-white"><?= $data->files ?></label>
                            </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    
    </section>

    <!-- Footer -->
    <?php require_once('../layout/javascript.php'); ?>

    <!-- Javascript for Users page -->
</body>

</html>