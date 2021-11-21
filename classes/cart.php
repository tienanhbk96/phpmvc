<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class cart {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($quantity, $id){

            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sId = session_id();

            $query = "SELECT * FROM tbl_product where productId = $id ";
            $result = $this->db->select($query)->fetch_assoc();

            $image = $result['image'];
            $price = $result['price'];
            $productName = $result['productName'];

            $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sId ='$sId' ";
            $check_cart = $this->db->select($check_cart);
            if($check_cart){
                $msg = "Product Already Added";
                return $msg;
            }else{
                $query_insert = "INSERT INTO tbl_cart(productId, quantity, sId, image, price, productName)
                            VALUES('$id', '$quantity', '$sId', '$image', '$price', '$productName' )";
                $insert_cart = $this->db->insert($query_insert);

                if($insert_cart){
                    header('Location:cart.php');
                }else{
                    header('Location:404.php');
                }
            }
        }

        public function get_product_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_quantity_cart($quantity, $cartId){

            $quantity = mysqli_real_escape_string($this->db->link, $quantity);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);

            $query = "UPDATE tbl_cart SET quantity =  '$quantity' WHERE cartId = '$cartId' ";
            $result = $this->db->update($query);
            if($result){
                header('Location:cart.php');
                $alert = "<span class='success'>Cart Update Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Cart Update  not Success</span>";
                return $alert;
            }
        }

        public function delete_cart($id){
            $sId = session_id();

            $query = "DELETE FROM tbl_cart WHERE cartId = '$id' AND sId = '$sId'  " ;
            $result = $this->db->delete($query);
            if($result){
                header('Location:cart.php');
                $alert = "<span class='success'>Cart Delete Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Cart Delete not Success</span>";
                return $alert;
            }
        }

        public function check_cart(){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function dell_all_data_cart(){
            $sId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
            $result = $this->db->delete($query);
            return $result;
        }

        
        public function insertOrder($customer_id){
            $sId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sId = '$sId'";
            $get_product = $this->db->select($query);
            if($get_product){
                while($result = $get_product->fetch_assoc()){
                    $productid = $result['productId'];
                    $productName = $result['productName'];
                    $quantity = $result['quantity'];
                    $price = $result['price'] * $result['quantity'];
                    $image = $result['image'];
                    $customer_id = $customer_id;
                    $query_order = "INSERT INTO tbl_order(productId, productName, quantity, price, image, customer_id)
                    VALUES('$productid', '$productName', '$quantity', '$price', '$image', '$customer_id')";

                    $insert_order = $this->db->select($query_order);
                }
            }
        }

        public function getAmountPrice($customer_id){
            $query = "SELECT SUM(price) as price FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }

        public function get_cart_order($customer_id){
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_cart_order = $this->db->select($query);
            return $get_cart_order;
        }

        public function check_order($customer_id){
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order ORDER BY date_order ";
            $result = $this->db->select($query);
            return $result;
        }
    }
?> 