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
<?php
    // if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
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
    h3.payment {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        text-decoration: underline;
        cursor: pointer;
    }

    .wrapper_method {
        text-align: center;
        width: 550px;
        margin: 0 auto;
        border: 1px solid #666;
        padding: 20px;
        background: cornsilk;
    }

    .wrapper_method a {
        padding: 5px;
        background-color: red;
        color: #fff;
    }

    .wrapper_method h3 {
        margin-bottom: 20px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Payment Method</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Choose your method payment</h3>
                    <a class="payment_href" href="offlinepayment.php">Offline Payment</a>
                    <a class="payment_href" href="onlinepayment.php">Online Payment</a><br><br><br>
                    <a style="background: grey;" href="cart.php"> << Previous</a>
                </div>
            </div>
        </div>
    </div>
<?php 
	include 'inc/footer.php';
?>