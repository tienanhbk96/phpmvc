<?php 
	include 'inc/header.php';
	// include 'inc/slider.php';
?>
<?php
    $check_login = Session::get('customer_login');
    if($check_login){
        header('Location:order.php');
    }
?>
<?php
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])){
        $insertCustomer = $cs->insert_customer($_POST);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])){
        $login_customer = $cs->login_customer($_POST);
    }
?>
<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Existing Customers</h3>
            <p>Sign in with the form below.</p>
            <?php
                if(isset($login_customer)){
                    echo $login_customer;
                }
            ?>
            <form action="" method="post">
                <input type="text" name="email" class="field" placeholder="Enter Email">
                <input type="password" name="password" class="field" placeholder="Enter Password">
                <p class="note">If you forgot your passoword just enter your email and click <a href="#">here</a></p>
                <div class="buttons">
                    <div><input type="submit" class="grey" name="login" value="Sign In">Sign In</input></div>
                </div>
            </form>
        </div>
        <div class="register_account">
            <h3>Register New Account</h3>
            <?php
             if(isset($insertCustomer)){
                    echo $insertCustomer;
                }
            ?>
            <form action="" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Enter Name...">
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="Enter City...">
                                </div>

                                <div>
                                    <input type="text" name="zipCode" placeholder="Enter ZipCode...">
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Enter E-Mail...">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Enter Address...">
                                </div>
                                <div>
                                    <select id="country" name="country" onchange="change_country(this.value)"
                                        class="frm-field required">
                                        <option value="null">Select a Country</option>
                                        <option value="AF">Afghanistan</option>
                                        <option value="AL">Albania</option>
                                        <option value="DZ">Algeria</option>
                                        <option value="AR">Argentina</option>
                                        <option value="AM">Armenia</option>
                                        <option value="AW">Aruba</option>
                                        <option value="AU">Australia</option>
                                        <option value="AT">Austria</option>
                                        <option value="AZ">Azerbaijan</option>
                                        <option value="BS">Bahamas</option>
                                        <option value="BH">Bahrain</option>
                                        <option value="BD">Bangladesh</option>

                                    </select>
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Enter Phone...." >
                                </div>

                                <div>
                                    <input type="text" name="password" placeholder="Enter password...." >
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search">
                    <div><input type="submit" name="submit" class="grey" value="Create Account"></div>
                </div>
                <p class="terms">By clicking 'Create Account' you agree to the <a href="#">Terms &amp; Conditions</a>.
                </p>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
</div>
<?php 
	include 'inc/footer.php';
?>