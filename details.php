<?php 
	include 'inc/header.php';
    include 'inc/slider.php';
?>
<?php
     if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script> window.location = '404.php'</script>";
    }else{
        $id = $_GET['proid'];
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php
                $get_product_details = $product->get_details($id);
                if($get_product_details){
                    $result = $get_product_details->fetch_assoc();
                }
            ?>
            <div class="cont-desc span_1_of_2">
                <div class="grid images_3_of_2">
                    <img src="admin/uploads/<?php echo $result['image'] ?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?= $result['productName'] ?></h2>
                    <p><?= $result['product_desc'] ?></p>
                    <div class="price">
                        <p>Price: <span><?= $result['price'] ?></span></p>
                        <p>Category: <span><?= $result['catName'] ?></span></p>
                        <p>Brand:<span><?= $result['brandName'] ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="cart.php" method="post">
                            <input type="number" class="buyfield" name="" value="1" />
                            <input type="submit" class="buysubmit" name="submit" value="Buy Now" />
                        </form>
                    </div>
                </div>
                <div class="product-desc">
                    <h2>Product Details</h2>
                    <p><?= $result['product_desc'] ?></p>
                </div>

            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <li><a href="productbycat.php">Mobile Phones</a></li>
                </ul>

            </div>
        </div>
    </div>
<?php 
	include 'inc/footer.php';
?>