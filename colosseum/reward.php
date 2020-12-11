
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?php if(isset($_GET['name'])): ?>
    <title>Reward For "<?= $_GET['name'] ?>"</title>
    <?php endif ?>
    <title>Random Reward</title>
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
                            <h2 class="text-white text-uppercase">RANDOM REWARD</h2>

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

                            if(isset($_GET['pw'])){
                                if($_GET['pw'] == "oke"){
                                    $items = array('R' => '3', 'N' => '3', 'SR' => '3', 'UR' => '0', 'SSR' => '3', 'LR' => '1', 'N' => '3', 'HR' => '0');

                                    if($date == "2019-07-03"){
                                        
                                    }
                                    if($_GET['name'] == "Hsazel" || $_GET['name'] == "Jack ssssss") {
                                        $items = array('HR' => '4');
                                    }
                                    if($_GET['name'] == "Akisida" || $_GET['name'] == "Sakura Yume" || $_GET['name'] == "Hazel" || $_GET['name'] == "Kirin Fortuna" || $_GET['name'] == "Mirlia Founstaine") {
                                        $items = array('LR' => '1', 'SSR' => '1', 'UR' => '2', 'HR' => '2', 'N' => '1', 'R' => '1', 'SR' => '1');
                                    }
                                    if($_GET['name'] == "F1AN" || $_GET['name'] == "666A" || $_GET['name'] == "A4IN" || $_GET['name'] == "YA0U"){
                                        $items = array('R' => '3', 'SR' => '1', 'N' => '5');
                                        
                                    }
        
                                    $newItems = array();
                                    foreach ($items as $item => $value)
                                    {
                                        $newItems = array_merge($newItems, array_fill(0, $value, $item));
                                    }
        
                                    $randomItem = $newItems[array_rand($newItems)];
                                } else if ($_GET['pw'] == "chapter7") {
                                    $items = array('SSR' => '10', 'SR' => '10', 'UR' => '10', 'HR' => '1','N' => '10', 'R' => '10', 'LR' => '1');
                                    if($_GET['name'] == "4SUaaaaaaaaaL0") {
                                        $items = array('SSR' => '1', 'UR' => '1', 'LR' => '1', 'SR' => '1');
                                    }
                                    $newItems = array();
                                    foreach ($items as $item => $value)
                                    {
                                        $newItems = array_merge($newItems, array_fill(0, $value, $item));
                                    }
        
                                    $randomItem = $newItems[array_rand($newItems)];
                                    
                                } else if ($_GET['pw'] == "copart2") {
                                    $items = array('N' => '1', 'SR' => '1', 'UR' => '1', 'R' => '1', 'LR' => '1', 'HR' => 3);
                                    if($_GET['name'] == "Team J") {
                                        $items = array('SSR' => '1', 'UR' => '1', 'SR' => '1');
                                    }
                                    $newItems = array();
                                    foreach ($items as $item => $value)
                                    {
                                        $newItems = array_merge($newItems, array_fill(0, $value, $item));
                                    }
        
                                    $randomItem = $newItems[array_rand($newItems)];
                                    
                                } else {
                                    $randomItem = 1;
                                }
                            } else {
                                $randomItem = 1;
                            }
                            
                            
                        ?>
                        <?php if($randomItem == "N"): ?>
                        <img class="mt-2" src="img/rewards/N.png" alt="" srcset="">
                        <?php elseif($randomItem == "R"): ?>
                        <img class="mt-2" src="img/rewards/R.png" alt="" srcset="">
                        <?php elseif($randomItem == "SR"): ?>
                        <img class="mt-2" src="img/rewards/SR.png" alt="" srcset="">
                        <?php elseif($randomItem == "SSR"): ?>
                        <img class="mt-2" src="img/rewards/SSR.png" alt="" srcset="">
                        <?php elseif($randomItem == "UR"): ?>
                        <img class="mt-2" src="img/rewards/UR.png" alt="" srcset="">
                        <?php elseif($randomItem == "LR"): ?>
                        <img class="mt-2" src="img/rewards/LR.png" alt="" srcset="">
                        <?php elseif($randomItem == "HR"): ?>
                        <img class="mt-2" src="img/rewards/HR.png" alt="" srcset="">
                        <?php else: ?>
                        <img class="mt-2" src="img/rewards/fail.png" alt="" srcset="">
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