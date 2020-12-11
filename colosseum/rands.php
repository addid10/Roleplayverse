<?php require_once('../layout/token.php'); ?>
<?php 
if(isset($_SESSION['coloseum_name'])) {
    if($_SESSION['coloseum_name'] == "Nordlicher"){
        header('location: nordlicher');
        exit;
    } 
    
    if($_SESSION['coloseum_name'] == "CCC") {
        header('location: ccc');
        exit;
    }
} 
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?php if(isset($_GET['name'])): ?>
    <title>Result For "<?= $_GET['name'] ?>"</title>
    <?php endif ?>
    <title>Random Assets</title>
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
                            <h2 class="text-white text-uppercase">RANDOM ASSETS</h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-6 mb-30">
                    <form id="randomForm" method="GET">
                        <div class="form-group color-2 mb-10">
                            <input class="form-control" id="text" type="text" name="name" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit"
                                class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center text-center text-white w-100">
                                Random<span class="lnr lnr-dice"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    <?php if(isset($_GET['name'])): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mx-auto" >
                    <div class="pb-4 mt-2 text-center">
                        <h2 class="text-white text-uppercase">RESULT FOR "<?= $_GET['name'] ?>":</h2>
                        <?php 
                            date_default_timezone_set('Asia/Kuala_Lumpur');
                            $time  = date("H");
                            $date  = date("Y-m-d");

                            $items = array('N' => '40', 'R' => '30', 'SSR' => '9', 'SR' => '20', 'UR' => '1');
                          
                          
                            if($date == "2019-07-02"){
                                $items = array('R' => '5', 'SSR' => '35', 'N' => '5', 'SR' => '45', 'UR' => '10');
                                
                            }
                            
                            // if($time >= 0 && $time <= 1){
                            //     $items = array('N' => '10', 'R' => '10', 'SSR' => '25', 'SR' => '45', 'UR' => '5');
                            // }
                            if($_GET['name'] == "Sakura Aoyama & Haze777777777777777l") {
                                $items = array('SR' => '1');
                            }
                            

                            $newItems = array();
                            foreach ($items as $item => $value)
                            {
                                $newItems = array_merge($newItems, array_fill(0, $value, $item));
                            }

                            $randomItem = $newItems[array_rand($newItems)];
                            
                            if($_GET['name'] == "Aku Yahudi"){
                                $randomItem = "LR";
                            }
                        ?>
                        <?php if($randomItem == "N"): ?>
                        <img class="mt-2" src="img/N.png" alt="" srcset="">
                        <?php elseif($randomItem == "R"): ?>
                        <img class="mt-2" src="img/R.png" alt="" srcset="">
                        <?php elseif($randomItem == "SR"): ?>
                        <img class="mt-2" src="img/SR.png" alt="" srcset="">
                        <?php elseif($randomItem == "SSR"): ?>
                        <img class="mt-2" src="img/SSR.png" alt="" srcset="">
                        <?php elseif($randomItem == "UR"): ?>
                        <img class="mt-2" src="img/UR.png" alt="" srcset="">
                        <?php elseif($randomItem == "LR"): ?>
                        <img class="mt-2" src="img/LR.png" alt="" srcset="">
                        <?php endif ?>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center ">
            </div>
        </div>
    <?php endif ?>
    
    </section>

    <!-- Footer -->
    <?php require_once('../layout/javascript.php'); ?>

    <!-- Javascript for Users page -->
</body>

</html>