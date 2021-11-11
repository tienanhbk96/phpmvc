<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Feature Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $product_feathered = $product->getproduct_feathered();
                if(isset($product_feathered)){
                    while($result = $product_feathered->fetch_assoc()){
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" style="height:220px" /></a>
                    <h2><?php echo $result['productName'] ?></h2>
                    <p><?php echo $fm->textShorten_product($result['product_desc'], 50) ?></p>
                    <p><span class="price">$<?php echo $result['price'] ?></span></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
                </div>
            <?php
                    }
                }
            ?>
        </div>
        <div class="content_bottom">
            <div class="heading">
                <h3>New Products</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $product_new = $product->getproduct_new();
                if(isset($product_new)){
                    while($result = $product_new->fetch_assoc()){
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="details.php?proid=<?php echo $result['productId'] ?>"><img src="admin/uploads/<?php echo $result['image'] ?>" alt="" style="height:220px"  /></a>
                    <h2><?php echo $fm->textShorten_product($result['product_desc'], 50) ?></h2>
                    <p><span class="price">$<?php echo $result['price'] ?></span></p>
                    <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>" class="details">Details</a></span></div>
                </div>
            <?php
                    }
                }
            ?>
        </div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>