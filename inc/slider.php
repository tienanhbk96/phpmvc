<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
                $getLastestDell = $product->getLastestDell();
                if(isset($getLastestDell)){
                    $dell = $getLastestDell->fetch_assoc();
                }

                $getLastesAssus = $product->getLastestAssus();
                if(isset($getLastesAssus)){
                    $assus = $getLastesAssus->fetch_assoc();
                }

                $getLastestHp = $product->getLastestHp();
                if(isset($getLastestHp)){
                    $hp = $getLastestHp->fetch_assoc();
                }

                $getLastestMacbook = $product->getLastestMacbook();
                if(isset($getLastestMacbook)){
                    $macbook = $getLastestMacbook->fetch_assoc();
                }
            ?>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?proid=<?php echo $dell['productId'] ?>"> <img src="admin/uploads/<?= $dell['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Dell</h2>
                    <p><?= $dell['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $dell['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?proid=<?php echo $assus['productId'] ?>"><img src="admin/uploads/<?= $assus['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Samsung</h2>
                    <p><?= $assus['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $assus['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
        </div>
        <div class="section group">
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?proid=<?php echo $hp['productId'] ?>"> <img src="admin/uploads/<?= $hp['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Acer</h2>
                    <p><?= $hp['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $hp['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
            <div class="listview_1_of_2 images_1_of_2">
                <div class="listimg listimg_2_of_1">
                    <a href="details.php?proid=<?php echo $macbook['productId'] ?>"><img src="admin/uploads/<?= $macbook['image'] ?>" alt="" /></a>
                </div>
                <div class="text list_2_of_1">
                    <h2>Canon</h2>
                    <p><?= $macbook['productName'] ?></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $macbook['productId'] ?>">Add to cart</a></span></div>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt="" /></li>
                    <li><img src="images/2.jpg" alt="" /></li>
                    <li><img src="images/3.jpg" alt="" /></li>
                    <li><img src="images/4.jpg" alt="" /></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>