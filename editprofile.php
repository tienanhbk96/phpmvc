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
    $id = Session::get('customer_id');
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])){

        $UpdateCustomer = $cs->update_customer($_POST, $id);
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>Update Profile customer</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="post">
                <table class="tblone">
                    <tr>
                        <?php
                            if(isset($UpdateCustomer)){
                                echo '<td colspan="3">'.$UpdateCustomer.'</td>';
                            }
                        ?>
                    </tr>
                    <?php
                        $id = Session::get('customer_id');
                        $get_customers = $cs->show_customers($id);
                        if($get_customers){
                            while($result = $get_customers->fetch_assoc()){
                    ?>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td><input type="text" name="name" value="<?= $result['name'] ?>"></td>
                        </tr>
                        <!-- <tr>
                            <td>City</td>
                            <td>:</td>
                            <td><input type="text" name="city" value="<?= $result['city'] ?>"></td>
                        </tr> -->
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td><input type="text" name="phone" value="<?= $result['phone'] ?>"></td>
                        </tr>
                        <tr>
                            <td>ZipCode</td>
                            <td>:</td>
                            <td><input type="text" name="zipcode" value="<?= $result['zipcode'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td><input type="text" name="email" value="<?= $result['email'] ?>"></td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td><input type="text" name="address" value="<?= $result['address'] ?>"></td>
                        </tr>
                        <tr>
                            <td colspan="3"><input type="submit" name="save" value="Save" class="grey"></td>
                        </tr>
                    <?php
                            }
                        }
                    ?>
                </table>
            </form>
        </div>
    </div>
<?php 
	include 'inc/footer.php';
?>