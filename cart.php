<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $cartId = $_POST['cartId'];
        $quantity = $_POST['quantity'];
        if($quantity > 0){
            $update_quantity_cart = $ct->update_quantity_cart($quantity, $cartId);
        }else{
            $delete_cart = $ct->delete_cart($cartId);
        }
    }

    if(isset($_GET['delcart'])){
        $id = $_GET['delcart'];
        $delete_cart = $ct->delete_cart($id);
    }
?>
<style>
    td {
        vertical-align: middle;
    }
</style>

<?php
    if(!isset($_GET['id'])){
		echo "<meta http-equiv='refresh' content='0;URL=?id=live'>";
	}
?>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
                <?php
                    if(isset($update_quantity_cart)){
                        echo $update_quantity_cart;
                    }
                    if(isset($delete_cart)){
                        echo $delete_cart;
                    }
                ?>
               
                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                        $get_product_cart = $ct->get_product_cart();
                        if($get_product_cart){
                            $subtotal = 0;
                            $qty = 0;
                            while($result = $get_product_cart->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?= $result['productName'] ?></td>
                                <td><img style="width: auto; height: 50px" src="admin/uploads/<?= $result['image'] ?>" alt="" /></td>
                                <td><?= $result['price'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?= $result['cartId'] ?>" />
                                        <input type="number" name="quantity" value="<?= $result['quantity'] ?>" min="0" />
                                        <input type="submit" name="submit" value="Update" />
                                    </form>
                                </td>
                                <td><?php 
                                    $total = $result['quantity']*$result['price'];
                                    $subtotal += $total;
                                    echo '$'.$total;
                                    ?>
                                </td>
                                <td><a onclick="return confirm('Are you want to delete')" href="?delcart=<?php echo $result['cartId'] ?>">Xóa</a></td>
                            </tr>
                    <?php
                        $vat = $subtotal*0.1;
                        $grandTotal = $subtotal*1.1;
                        $qty = $qty + $result['quantity'];
                          }
                        }
                    ?>
                </table>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td><?php
                               echo isset($subtotal) ? '$'.$subtotal : '0';
                               isset($subtotal) ?  Session::set('sum', $subtotal) : '';
                                isset($qty) ?  Session::set('qty', $qty) : '';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>
                            <?php
                               echo isset($vat) ? '$'.$vat : '0' 
                            ?>
                         </td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td> 
                            <?php
                                echo isset($grandTotal) ? '$'.$grandTotal : '0';
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>