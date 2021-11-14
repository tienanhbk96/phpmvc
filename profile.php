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
<div class="main">
    <div class="content">
        <div class="section group">
            <h3>Profile customer</h3>
            <table class="tblone">
                <tr>
                    <td>Name</td>
                    <td>:</td>
                    <td>Tiền Anh</td>
                </tr>
            </table>
        </div>
    </div>
<?php 
	include 'inc/footer.php';
?>