<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    $filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>
<?php
    if(!isset($_GET['customerid']) || $_GET['customerid'] == NULL){
        echo "<script>window.location = 'inbox  .php'</script>";
    }else{
        $id = $_GET['customerid'];
    }
    $cs = new customer();
    // if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //     $catName = $_POST['catName'];
    //     $updateCat = $cat->update_category($id, $catName);
    // }
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Sửa danh mục</h2>
               <div class="block copyblock"> 
                <?php 
                    $get_customer = $cs->show_customers($id);
                    if($get_customer){
                        while($result =  $get_customer->fetch_assoc()){
                ?>
                        <form action="" method="post">
                            <table class="form">					
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>
                                        <input value="<?php echo $result['name'] ?>" type="text" readonly class="medium" />
                                    </td>
                                </tr>
                                <tr>
                                    <td>City</td>
                                    <td>:</td>
                                    <td><?= $result['city'] ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>:</td>
                                    <td><?= $result['phone'] ?></td>
                                </tr>
                                <tr>
                                    <td>ZipCode</td>
                                    <td>:</td>
                                    <td><?= $result['zipcode'] ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td><?= $result['email'] ?></td>
                                </tr>
                                <tr>
                                    <td>Address</td>
                                    <td>:</td>
                                    <td><?= $result['address'] ?></td>
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