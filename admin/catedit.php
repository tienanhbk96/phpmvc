<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/category.php' ?>
<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        echo "<script>window.location = 'catlist.php'</script>";
    }else{
        $id = $_GET['catid'];
    }
       
    $cat = new category();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock"> 
               <?php 
                    if(isset($insertCat)){
                        echo $insertCat;
                    }
                ?>
                <?php 
                    $get_cat_name = $cat->getcatbyId($id);
                    if($get_cat_name){
                        while($result =  $get_cat_name->fetch_assoc()){
                            
                       
                ?>
                        <form action="catadd.php" method="post">
                            <table class="form">					
                                <tr>
                                    <td>
                                        <input value="<?php echo $result['catName'] ?>" type="text" name="catName" placeholder="Sửa thêm danh mục sản phẩm..." class="medium" />
                                    </td>
                                </tr>
                                <tr> 
                                    <td>
                                        <input type="submit" name="submit" Value="Edit" />
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