<?php 
	include 'inc/header.php';
?>
<?php
    $check_login = Session::get('customer_login');
    if($check_login == false){
        header('Location:login.php');
    }
?>
<style>
    .order_page {
        font-size: 30px;
        font-weight: bold;
        color: red;
    }
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <div class="order_page">
                    <h3>Order page</h3>
                </div>
            </div>
            
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>