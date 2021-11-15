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
            <div class="content_top">
                <div class="heading">
                    <h3>Profile customer</h3>
                </div>
                <div class="clear"></div>
            </div>
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
<?php 
	include 'inc/footer.php';
?>