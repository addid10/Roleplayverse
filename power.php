
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
    <?php if(isset($_GET['name'])): ?>
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
                                // 'Adaptation Manipulation',
                                // 'Combat Manipulation',
                                // 'Diamond Manipulation',
                                // 'Electromagnetism Manipulation',
                                // 'Engineering Manipulation',
                                // 'Enhancement Manipulation',
                                // 'Gas Manipulation',
                                // 'Strength Manipulation',
                                // 'Technology Manipulation',
                                // 'Vehicle Manipulation',
                                // 'Vibration Manipulation',
                                'Accessory Manipulation',
                                'Air Energy Manipulation',
                                'Air Manipulation',
                                'Airwave Manipulation',
                                'Alcohol Manipulation',
                                'Ant Manipulation',
                                'Armor Manipulation',
                                'Art Manipulation',
                                'Balloon Manipulation',
                                'Bandage Manipulation',
                                'Bat Manipulation',
                                'Bee Manipulation',
                                'Bell Manipulation',
                                'Bio-Air Manipulation',
                                'Bio-Earth Manipulation',
                                'Bio-Metal Manipulation',
                                'Blade Manipulation',
                                'Blood Manipulation',
                                'Blue Fire Manipulation',
                                'Bone Manipulation',
                                'Bow Manipulation',
                                'Bubble Manipulation',
                                'Ground Manipulation',
                                'Card Manipulation',
                                'Ceramic Manipulation',
                                'Chain Manipulation',
                                'Chocolate Manipulation',
                                'Cloth Manipulation',
                                'Coin Manipulation',
                                'Chopper Manipulation',
                                'Cryo-Telekinesis',
                                'Crystal Manipulation',
                                'Dark Ice Manipylation',
                                'Darkness Manipulation',
                                'Doll Manipulation',
                                'Equipment Manipulation',
                                'Explosive Fire Manipulation',
                                'Fire Manipulation',
                                'Flower Manipulation',
                                'Gel Manipulation',
                                'Glass Manipulation',
                                'Gold Manipulation',
                                'Grass Manipulation',
                                'Hair Manipulation',
                                'Iron Sand Manipulation',
                                'Jewelry Manipulation',
                                'Magma Manipulation',
                                'Meat Manipulation',
                                'Medicine Manipulation',
                                'Snake Manipulation',
                                'Metal Dust Manipulation',
                                'Metal Manipulation',
                                'Molten Metal Manipulation',
                                'Monster Manipulation',
                                'Mud Manipulation',
                                'Object Manipulation',
                                'Oil Manipulation',
                                'Plastic Manipulation',
                                'Platinum Manipulation',
                                'Poison Manipulation',
                                'Potion Manipulation',
                                'Pure Earth Manipulation',
                                'Pure Ice Manipulation',
                                'Pure Oil Manipulation',
                                'Pure Smoke Manipulation',
                                'Purple Lightning Manipulation',
                                'Ribbon Manipulation',
                                'Ring Manipulation',
                                'Rod Manipulation',
                                'Rope Manipulation',
                                'Shard Manipulation',
                                'Shield Manipulation',
                                'Solid Fire Manipulation',
                                'Steel Manipulation',
                                'Storm Manipulation',
                                'Sugar Manipulation',
                                'Thunder Manipulation',
                                'Toy Manipulation',
                                'Weapon Manipulation',
                                'Wing Manipulation',
                                'Wood Manipulation',
                                'Wool Manipulation',
                                'Zipper Manipulation',


                            );
                                
                          
                            if($_GET['name'] == "Kano Riichiro" || $_GET['name'] == "Abimanyu_Reforma") {
                                $items = array(
                                    'Electromagnetism Manipulation',
                                    'Engineering Manipulation',
                                    'Enhancement Manipulation',
                                    'Gas Manipulation',
                                    'Dark Twilight Manipulation',
                                    'Vehicle Manipulation',
                                    'Dark Fire Manipulation',
                                    'Bio-Fire Manipulation',
                                    'Bio-Magma Manipulation',
                                    'Lunar Manipulation',
                                    'Molten Metal Manipulation',
                                    'Monster Manipulation',
                                    'Mud Manipulation',
                                    'Object Manipulation',
                                    'Oil Manipulation',
                                    'Plastic Manipulation',
                                    'Platinum Manipulation',
                                    'Pure Ice Manipulation',
                                    'Pure Oil Manipulation',
                                    'Pure Smoke Manipulation',
                                    'Purple Lightning Manipulation',
                                    'Ribbon Manipulation',
                                    'Shard Manipulation',
                                    'Shield Manipulation',
                                );
                            }
                            
                            if($_GET['name'] == "Rizkia_Akbar_Rhamadani" || $_GET['name'] == "Elkaiser") {
                                $items = array(
                                    'Sugar Manipulation',
                                    'Mud Manipulation',
                                    'Balloon Manipulation',
                                    'Toothpaste Manipulation',
                                    'Soap Manipulation',
                                    'Silk Manipulation',
                                    'Metal Dust Manipulation',
                                    'Metal Manipulation',
                                    'Wood Manipulation',
                                    'Salt Manipulation',
                                    'Shadow-Metal Manipulation',
                                    'Silk Manipulation',
                                    'Silver Manipulation',
                                    'Size Manipulation',
                                    'Pepper Manipulation',
                                    'Wool Manipulation',
                                    'Chocolate Manipulation',
                                    'Cheese Manipulation',
                                    'Medicine Manipulation',
                                    'Snake Manipulation',
                                    'Molten Metal Manipulation',
                                    'Monster Manipulation',
                                );
                            }
                            

                            // $newItems = array();
                            // foreach ($items as $item => $value)
                            // {
                            //     $newItems = array_merge($newItems, array_fill(0, $value, $item));
                            // }

                            $randomItem = $items[array_rand($items)];
                            
                        ?>
    <title><?= $randomItem ?></title>
    <?php require_once('layout/head.php'); ?>
    <meta name="description" content="Result for <?= $_GET['name'] ?>">
    <link rel="stylesheet" href="colosseum/css/colosseum.css">
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