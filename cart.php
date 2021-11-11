<?php 
	include 'inc/header.php';
	include 'inc/slider.php';
?>

<style>
    td {
        vertical-align: middle;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Your Cart</h2>
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
                        if(isset($get_product_cart)){
                            $subtotal = 0;
                            while($result = $get_product_cart->fetch_assoc()){
                    ?>
                            <tr>
                                <td><?= $result['productName'] ?></td>
                                <td><img style="width: auto; height: 50px" src="admin/uploads/<?= $result['image'] ?>" alt="" /></td>
                                <td><?= $result['price'] ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="number" name="" value="<?= $result['quantity'] ?>" min="0" />
                                        <input type="submit" name="submit" value="Update" />
                                    </form>
                                </td>
                                <td><?php 
                                    $total = $result['quantity']*$result['price'];
                                    $subtotal += $total;
                                    echo '$'.$total;
                                    ?>
                                </td>
                                <td><a href="">X</a></td>
                            </tr>
                    <?php
                          }
                        }
                    ?>
                </table>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Sub Total : </th>
                        <td><?= '$'.$subtotal ?></td>
                    </tr>
                    <tr>
                        <th>VAT : </th>
                        <td>TK. <?php $vat = $subtotal*0.1;
                                echo '$'.$vat ?></td>
                    </tr>
                    <tr>
                        <th>Grand Total :</th>
                        <td>
                            <?php
                                $grandTotal = $subtotal*1.1;
                                echo '$'.$grandTotal;
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
                    <a href="login.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>