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
            $result = $this->db->select($query);
            return $result;
        }
    }
?> 