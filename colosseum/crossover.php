
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?php if(isset($_GET['name'])): ?>
    <title>Crossover For "<?= $_GET['name'] ?>"</title>
    <?php endif ?>
    <title>Random Crossover</title>
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
                            <h2 class="text-white text-uppercase">RANDOM CROSSOVER</h2>

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
                                if ($_GET['pw'] == "dssssssssssopart2") {
                                    $items = array(0 => '1', 7 => '1');
                                    
                                    if($_GET['name'] == "Lssss23") {
                                        $items = array(4 => '1');
                                    }
                                    
                                    $newItems = array();
                                    foreach ($items as $item => $value)
                                    {
                                        $newItems = array_merge($newItems, array_fill(0, $value, $item));
                                    }
        
                                    $randomItem = $newItems[array_rand($newItems)];
                                    
                                } else if ($_GET['pw'] == "ssssssspart3") {
                                    $items = array(2 => '1');
                                    
                                    if($_GET['name'] == "Team Ba") {
                                        $items = array(1 => '1');
                                    }
                                    
                                    $newItems = array();
                                    foreach ($items as $item => $value)
                                    {
                                        $newItems = array_merge($newItems, array_fill(0, $value, $item));
                                    }
        
                                    $randomItem = $newItems[array_rand($newItems)];
                                    
                                } else {
                                    $randomItem = "fail";
                                }
                            } else {
                                $randomItem = "fai111111111111l";
                            }
                            
                            
                        ?>
                        <?php if($randomItem == 10): ?>
                        <img class="mt-2" src="img/rewards/00.png" alt="" srcset="">
                        <?php elseif($randomItem == 1): ?>
                        <img class="mt-2" src="img/rewards/01.png" alt="" srcset="">
                        <?php elseif($randomItem == 2): ?>
                        <img class="mt-2" src="img/rewards/02.png" alt="" srcset="">
                        <?php elseif($randomItem == 3): ?>
                        <img class="mt-2" src="img/rewards/03.png" alt="" srcset="">
                        <?php elseif($randomItem == 4): ?>
                        <img class="mt-2" src="img/rewards/04.png" alt="" srcset="">
                        <?php elseif($randomItem == 5): ?>
                        <img class="mt-2" src="img/rewards/05.png" alt="" srcset="">
                        <?php elseif($randomItem == 6): ?>
                        <img class="mt-2" src="img/rewards/06.png" alt="" srcset="">
                        <?php elseif($randomItem == 7): ?>
                        <img class="mt-2" src="img/rewards/07.png" alt="" srcset="">
                        <?php elseif($randomItem == 8): ?>
                        <img class="mt-2" src="img/rewards/08.png" alt="" srcset="">
                        <?php elseif($randomItem == 9): ?>
                        <img class="mt-2" src="img/rewards/09.png" alt="" srcset="">
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