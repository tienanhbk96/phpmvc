<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class product {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
            
        public function insert_product($data){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

            if($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $price == "" || $type == "" || $file_name == ""){
                $alert = "<span class='error'>Product must be not empty</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);

                $query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, price, type, image
                ) VALUES('$productName', '$category', '$brand', ' $product_desc', '$price', '$type', '$unique_image')";
                $result = $this->db->insert($query);

                if($result){
                    $alert = "<span class='success'>Insert Product Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Product not Success</span>";
                    return $alert;
                }
            }
        }

        public function show_product(){
            $query = " SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
                        FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
                        INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
                        order by tbl_product.productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data, $id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $category = mysqli_real_escape_string($this->db->link, $data['category']);
            $brand = mysqli_real_escape_string($this->db->link, $data['brand']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
            $price = mysqli_real_escape_string($this->db->link, $data['price']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


            if($productName == "" || $category == "" || $brand == "" || $product_desc == "" || $price == "" || $type == ""){
                $alert = "<span class='error'>Product must be not empty</span>";
                return $alert;
            }else{
                if(!empty($file_name)){
                    //Nếu người dùng chọn ảnh
                    if ($file_size > 204800000) { 
                        $alert = "<span class='success'>Image Size should be less then 2MB!</span>";
                        return $alert;
                    } 
                    elseif (in_array($file_ext, $permited) === false){
                        // echo "<span class='error'>You can upload only:-".implode(', ', $permited)."</span>";	
                        $alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    unlink($data['old_image']);
					move_uploaded_file($file_temp,$uploaded_image);
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category', 
                    brandId = '$brand', 
                    product_desc = '$product_desc', 
                    price = '$price', 
                    type = '$type',
                    image = '$unique_image'

                    WHERE productId = '$id' ";
                }else{
                    //Nếu người dùng không chọn ảnh
                    $query = "UPDATE tbl_product SET 
                    productName = '$productName',
                    catId = '$category', 
                    brandId = '$brand', 
                    product_desc = '$product_desc', 
                    price = '$price', 
                    type = '$type'

                    WHERE productId = $id ";
                }
                
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Product Update Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Product Update  not Success</span>";
                    return $alert;
                }
            }
        }

        public function getproductbyId($id){
            // $query = "SELECT tbl_product.*, tbl_category.catName, tbl_brand.brandName
            //         FROM tbl_product INNER JOIN tbl_category ON tbl_product.catId = tbl_category.catId
            //         INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
            //         WHERE tbl_product.productId = $id";
            $query = "SELECT * FROM tbl_product where productId = $id ";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_product($id){
            $query_old_image = "SELECT image FROM tbl_product WHERE productId = $id";
            $result_old_image = $this->db->select($query_old_image)->fetch_assoc();
            $result_old_image = 'uploads/'.$result_old_image['image'];
            
            $query = "DELETE FROM tbl_product WHERE productId = $id";
            $result = $this->db->delete($query);
            if($result){
                unlink($result_old_image);
                $alert = "<span class='success'>Product Delete Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Product Delete not Success</span>";
                return $alert;
            }
        }

        //END BACKEND

        public function getproduct_feathered(){
            $query = "SELECT * FROM tbl_product where type = '1' LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }
        public function getproduct_new(){
            $query = "SELECT * FROM tbl_product order by productId desc LIMIT 4";
            $result = $this->db->select($query);
            return $result;
        }



    }


?>