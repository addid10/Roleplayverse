
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?php if(isset($_GET['name'])): ?>
    <meta name="description" content="Result For <?= $_GET['name'] ?>">
    <?php endif ?>
    
                        <?php 
                            date_default_timezone_set('Asia/Kuala_Lumpur');
                            $time  = date("H");
                            $date  = date("Y-m-d");

                            // $items = array(
                            //     'Liquid Manipulation' => '40', 
                            //     'Cobra Manipulation' => '30', 
                            //     'Wing Manipulation' => '20', 
                            //     );
                                
                            $items = array(
                                'Accessory Manipulation',
                                'Acid Manipulation',
                                'Acidic Poison Manipulation',
                                'Acrylic Manipulation',
                                'Adaptation Manipulation',
                                'Aether Manipulation',
                                'Air Energy Manipulation',
                                'Air Manipulation',
                                'Airwave Manipulation',
                                'Alcohol Manipulation',
                                'Amphibian Manipulation',
                                'Animal Manipulation',
                                'Ant Manipulation',
                                'Armament Magic',
                                'Armor Manipulation',
                                'Armor Manipulation',
                                'Art Manipulation',
                                'Aura Manipulation',
                                'Aurora Manipulation',
                                'Balloon Manipulation',
                                'Bandage Manipulation',
                                'Barricade Manipulation',
                                'Bat Manipulation',
                                'Bead Manipulation',
                                'Bee Manipulation',
                                'Bell Manipulation',
                                'Bio-Air Manipulation',
                                'Bio-Earth Manipulation',
                                'Bio-Electricity Manipulation',
                                'Bio-Fire Manipulation',
                                'Bio-Iron Manipulation',
                                'Bio-Iron Manipulation',
                                'Bio-Magma Manipulation',
                                'Bio-Metal Manipulation',
                                'Black Earth Manipulation',
                                'Black Lightning Manipulation',
                                'Black Metal Manipulation',
                                'Blade Manipulation',
                                'Blood Manipulation',
                                'Blue Fire Manipulation',
                                'Bone Manipulation',
                                'Bow Manipulation',
                                'Bread Manipulation',
                                'Bronze Manipulation',
                                'Bubble Manipulation',
                                'Bullet Manipulation',
                                'Card Manipulation',
                                'Ceramic Manipulation',
                                'Chain Manipulation',
                                'Cheese Manipulation',
                                'Chi Manipulation',
                                'Chocolate Manipulation',
                                'Clay Manipulation',
                                'Cloth Manipulation',
                                'Cloud Manipulation',
                                'Coal Manipulation',
                                'Coin Manipulation',
                                'Cold Manipulation',
                                'Color Manipulation',
                                'Combat Manipulation',
                                'Copper Manipulation',
                                'Cryo-Electricity Manipulation',
                                'Cryo-Telekinesis',
                                'Crystal Manipulation',
                                'Dark Aura Manipulation',
                                'Dark Chi Manipulation',
                                'Dark Energy Manipulation',
                                'Dark Fire Manipulation',
                                'Dark Ice Manipulation',
                                'Dark Light Manipulation',
                                'Dark Twilight Manipulation',
                                'Dark Water Manipulation',
                                'Dark Wind Manipulation',
                                'Darkness Manipulation',
                                'Diamond Manipulation',
                                'Doll Manipulation',

                                );
                          
                          
                            // if($date == "2019-07-02"){
                            //     $items = array('R' => '5', 'SSR' => '35', 'N' => '5', 'SR' => '45', 'UR' => '10');
                                
                            // }
                            
                            // if($time >= 0 && $time <= 1){
                            //     $items = array('N' => '10', 'R' => '10', 'SSR' => '25', 'SR' => '45', 'UR' => '5');
                            // }
                            // if($_GET['name'] == "Sakura Aoyama & Haze777777777777777l") {
                            //     $items = array('SR' => '1');
                            // }
                            

                            // $newItems = array();
                            // foreach ($items as $item => $value)
                            // {
                            //     $newItems = array_merge($newItems, array_fill(0, $value, $item));
                            // }

                            $randomItem = $items[array_rand($items)];
                            
                        ?>
    <title><?= $randomItem ?></title>
    <?php require_once('../layout/head.php'); ?>
    <meta name="description" content="Result for '<?= $_GET['name'] ?>'">
    <link rel="stylesheet" href="css/colosseum.css">
</head>

<body class="body-content">
    <div id="top"></div>

    <!--<section id="contact" class="section-half pt-5">-->
    <!--    <div class="container">-->
    <!--        <div class="row justify-content-center">-->
    <!--            <div class="col-lg-6 mx-auto" >-->
    <!--                <div class="pb-4 text-center">-->
    <!--                    <div class="title-content">-->
    <!--                        <h2 class="text-white text-uppercase">RANDOM ASSETS</h2>-->

    <!--                    </div>-->
    <!--                </div>-->
    <!--            </div>-->
    <!--        </div>-->
        <!--    <div class="row justify-content-center">-->
        <!--        <div class="col-lg-6 mb-30">-->
        <!--            <form id="randomForm" method="GET">-->
        <!--                <div class="form-group color-2 mb-10">-->
        <!--                    <input class="form-control" id="text" type="text" name="name" required>-->
        <!--                </div>-->
        <!--                <div class="d-flex justify-content-end">-->
        <!--                    <button type="submit"-->
        <!--                        class="mt-10 primary-btn d-inline-flex text-uppercase align-items-center text-center text-white w-100">-->
        <!--                        Random<span class="lnr lnr-dice"></span></button>-->
        <!--                </div>-->
        <!--            </form>-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->

    <?php if(isset($_GET['name'])): ?>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 mx-auto" >
                    <div class="pb-4 mt-2 text-center">
                        <h2 class="text-white text-uppercase">RESULT FOR "<?= $_GET['name'] ?>":</h2>
                        <?php echo $randomItem ?>
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