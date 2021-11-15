<?php 
	include 'inc/header.php';
    // include 'inc/slider.php';
?>
<?php
    //  if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
    //     echo "<script> window.location = '404.php'</script>";
    // }else{
    //     $id = $_GET['proid'];
    // }

    // if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
    //     $quantity = $_POST['quantity'];
    //     $AddtoCart = $ct->add_to_cart($quantity, $id);
        
    // }
?>
<style>
    .box_left {
        width: 50%;
        border: 1px solid #666;
        float: left;
        padding: 4px;
    }

    .box_right {
        width: 47%;
        border: 1px solid #666;
        float: right;
        padding: 4px;
    }

    table {
        font-size: 13px;
    }

    table td {
        padding: 2px;
        vertical-align: middle;
    }

    .tblone th {
        font-size: 14px;
    }
    
    .tblone td {
        padding: 2px;
    }

    input.submit_order {
        padding: 10px 70px;
        border: none;
        background: red;
        font-size: 25px;
        color: #fff;
        cursor: pointer;
        margin: 10px;
    }
</style>
<form action="" method="post">
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="heading">
                <h3>Offline Payment</h3>
            </div>
            <div class="clear"></div>
            <div class="box_left">
                <div class="cartpage">
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
                            <th width="10%">ID</th>
                            <th width="30%">Product Name</th>
                            <th width="20%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="20%">Total Price</th>
                        </tr>
                        <?php
                            $get_product_cart = $ct->get_product_cart();
                            $id = 0;
                            if($get_product_cart){
                                $subtotal = 0;
                                $qty = 0;
                                while($result = $get_product_cart->fetch_assoc()){
                                    $id++;
                        ?>
                                <tr>
                                    <td><?= $id ?></td>
                                    <td><?= $result['productName'] ?></td>
                                    <td><?= '$'.$result['price'] ?></td>
                                    <td>
                                            <?= $result['quantity'] ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $total = $result['quantity']*$result['price'];
                                            $subtotal += $total;
                                            echo '$'.$total;
                                        ?>
                                    </td>
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
            </div>
            <div class="box_right">
            <table class="tblone">
                <?php
                    $id = Session::get('customer_id');
                    $get_customers = $cs->show_customers($id);
                    if($get_customers){
                        while($result = $get_customers->fetch_assoc()){
                ?>
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td><?= $result['name'] ?></td>
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
                <tr>
                    <td colspan="3"><a href="editprofile.php">Update Profile</a></td>
                </tr>
                <?php
                      }
                    }
                ?>
            </table>
            </div>
        </div>
        <center><input type="submit" value="Order Now" name="order" class="submit_order"></center>
    </div>
</form>
<?php 
	include 'inc/footer.php';
?>