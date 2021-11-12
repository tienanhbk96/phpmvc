<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>

<?php
    $cat = new category();
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script>window.location = '404.php'</script>";
    }else{
        $id = $_GET['catid'];
    }

    $get_cat_name = $cat->getcatbyId($id);
    if($get_cat_name){
        $result_cat_name = $get_cat_name->fetch_assoc();
    }


    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->update_category($id, $catName);
    // }
?>
<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Category: <?= $result_cat_name['catName'] ?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
                $productbycat = $cat->get_product_by_cat($id);
                if($productbycat){
                    while($result = $productbycat->fetch_assoc()){
            ?>
                <div class="grid_1_of_4 images_1_of_4">
                    <a href="preview-3.php"><img src="admin/uploads/<?= $result['image'] ?>" alt="" /></a>
                    <h2><?= $result['productName'] ?> </h2>
                    <p><?= $fm->textShorten($result['product_desc'], 100)  ?></p>
                    <p><span class="price">$<?= $result['price'] ?></span></p>
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