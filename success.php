<?php 
	include 'inc/header.php';
    // include 'inc/slider.php';
?>
<?php
     if(isset($_GET['orderid']) && $_GET['orderid'] == 'order'){
         $customer_id = Session::get('customer_id');
         $insertOrder = $ct->insertOrder($customer_id);
         $delCart = $ct->dell_all_data_cart();
         header('Location:success.php');
    }
    
?>
<style>
    h2.success_order {
        text-align: center;
        color: red;
    }

    p.success_note {
        text-align: center;
        padding: 8px;
        font-size: 17px;
    }
</style>
<form action="" method="post">
<div class="main">
    <div class="content">
        <div class="section group">
            <h2 class="success_order">Success Order</h2>
            <?php
            $customer_id = Session::get('customer_id');
                $get_amount = $ct->getAmountPrice($customer_id)->fetch_assoc();
                $total = $get_amount['price'] * 1.1;
            ?>
            <p class="Success_note">Total price you have bought from my website: <?=  $total ?></p>
            <p class="Success_note">Please see you your order detail here <a href="orderdetail.php">Click here</a></p>
        </div>
    </div>
</form>
<?php 
	include 'inc/footer.php';
?>