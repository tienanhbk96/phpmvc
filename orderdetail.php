<?php 
	include 'inc/header.php';
    // include 'inc/slider.php';
?>
<?php
     $check_login = Session::get('customer_login');
     if($check_login == false){
         header('Location:login.php');
     }
    
?>
<style>
    .box_left {
        width: 100%;
        border: 1px solid #666;
        padding: 4px;
    }
</style>
<form action="" method="post">
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Your Detail order</h3>
            </div>
            <div class="clear"></div>
            <div class="box_left">
                <div class="cartpage">
                    <table class="tblone">
                        <tr>
                            <th width="10%">ID</th>
                            <th width="20%">Product Name</th>
                            <th width="30%">Image</th>
                            <th width="10%">Price</th>
                            <th width="10%">Quantity</th>
                            <th width="10%">Date</th>
                            <th width="10%">Status</th>
                            <th width="10%">Action</th>
                        </tr>
                        <?php
                            $customer_id = Session::get('customer_id');
                            $get_cart_order = $ct->get_cart_order($customer_id);
                            $id = 0;
                            if($get_cart_order){
                                $qty = 0;
                                while($result = $get_cart_order->fetch_assoc()){
                                    $id++;
                        ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $result['productName'] ?></td>
                                    <td><img src="admin/uploads/<?php echo $result['image'] ?>" style="width: 50px; height: 50px" /></td>
                                    <td><?= '$'.$result['price'] ?></td>
                                    <td>
                                            <?= $result['quantity'] ?>
                                    </td>
                                    <td><?= $fm->formatDate($result['date_order']) ?></td>
                                    <td><?php
                                            if($result['status'] == 0){
                                                echo 'Pending';
                                            }else{
                                                echo 'Processed';
                                            }
                                        ?>
                                    </td>
                                    <?php
                                        if($result['status'] == 0){
                                    ?>
                                        <td><?php echo 'N/A' ?></td>
                                    <?php
                                    }else{
                                    ?>
                                        <td><a onclick="return confirm('Are you want to delete')" href="?delcart=<?php echo $result['cartId'] ?>">Xóa</a></td>
                                    <?php
                                    }
                                    ?>
                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </table>
                   
                </div>
                <div class="shopping">
                    <div class="shopleft">
                        <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php 
	include 'inc/footer.php';
?>

