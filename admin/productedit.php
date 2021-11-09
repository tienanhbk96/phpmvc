<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/brand.php';?>
<?php include_once '../classes/category.php';?>
<?php include_once '../classes/product.php';?>
<?php
    $product = new product();
    if(!isset($_GET['productid']) || $_GET['productid'] == NULL){
        echo "<script> window.location = 'productlist.php'</script>";
    }else{
        $id = $_GET['productid'];
        $show_product = $product->getproductbyId($id);

        if(isset($show_product)){
            $view_product = $show_product->fetch_assoc();
        }
    }
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['productId'])){
        
        $updateProduct = $product->update_product($_POST, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">     
           <?php
                if(isset($updateProduct)){
                    echo $updateProduct;
                }   
            ?>     
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Name</label>
                    </td>
                    <td>
                        <input value="<?php echo $view_product['productName']?>" type="text" name="productName" class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Category</label>
                    </td>
                    <td>
                        <select id="select" name="category">
                            <option>--- Select Category ---</option>
                            <?php
                                $cat = new category();
                                $catlist = $cat->show_category();
                                if($catlist){
                                    while($result = $catlist->fetch_assoc()){
                            ?>
                                    <option <?= $result['catId'] ==  $view_product['catId'] ? 'selected' : '' ?>  value="<?= $result['catId'] ?>"  ><?php echo $result['catName'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                
				<tr>
                    <td>
                        <label>Brand</label>
                    </td>
                    <td>
                        <select id="select" name="brand">
                            <option>--- Select Brand ---</option>
                            <?php
                                $brand = new brand();
                                $brandlist = $brand->show_brand();
                                if($brandlist){
                                    while($result = $brandlist->fetch_assoc()){
                            ?>
                                    <option <?= $result['brandId'] ==  $view_product['brandId'] ? 'selected' : '' ?>  value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?></option>
                            <?php
                                    }
                                }
                            ?>
                        </select>
                    </td>
                </tr>
				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="product_desc" class="tinymce"><?= $view_product['product_desc']  ?></textarea>
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Price</label>
                    </td>
                    <td>
                        <input value="<?= $view_product['price'] ?>" type="text" name="price" placeholder="Enter Price..." class="medium" />
                    </td>
                </tr>
            
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <img src="uploads/<?php echo $view_product['image'] ?>" style="width: 100px"/><br>
                        <input type="file" name="image" />
                    </td> 
                </tr>
				
				<tr>
                    <td>
                        <label>Product Type</label> 
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Type</option>
                            <option <?= $view_product['type'] == 1 ? 'selected' : '' ?> value="1">Featured</option>
                            <option <?= $view_product['type'] == 0 ? 'selected' : '' ?> value="0">Non-Featured</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Upadate" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


