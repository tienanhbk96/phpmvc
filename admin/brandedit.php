<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/brand.php' ?>
<?php
    $brand = new brand();
    if(!isset($_GET['brandid']) || $_GET['brandid'] == NULL){
        echo "<script>window.location = 'brandlist.php'</script>";
    }else{
        $id = $_GET['brandid'];
    }
    

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $brandName = $_POST['brandName'];
        $updateBrand = $brand->update_brand($id, $brandName);
    }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa thương hiệu</h2>
               <div class="block copyblock"> 
               <?php 
                    if(isset($updateBrand)){
                        echo $updateBrand;
                    }
                ?>
                <?php 
                    $get_brand_name = $brand->getbrandbyId($id);
                    if(isset($get_brand_name)){
                        while($result =  $get_brand_name->fetch_assoc()){
                ?>
                        <form action="" method="post">
                            <table class="form">					
                                <tr>
                                    <td>
                                        <input value="<?php echo $result['brandName'] ?>" type="text" name="brandName" placeholder="Sửa thương hiệu sản phẩm..." class="medium" />
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                                        <input type="submit" name="submit" Value="Update" />
                                    </td>
                                </tr>
                            </table>
                        </form>
                <?php
                     }
                }
                ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>