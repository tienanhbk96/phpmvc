<?php
    include_once '../lib/database.php';
    include_once '../helpers/format.php';
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
                $alert = "<span class='error'>File must be not empty</span>";
                return $alert;
            }else{
                move_uploaded_file($file_temp, $uploaded_image);

                $query = "INSERT INTO tbl_product(productName, catId, brandId, product_desc, type, price, image
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

        // public function show_category(){
        //     $query = "SELECT * FROM tbl_category order by catId desc";
        //     $result = $this->db->select($query);
        //     return $result;
        // }

        // public function update_category($id, $catName){
        //     $catName = $this->fm->validation($catName);
        //     $catName = mysqli_real_escape_string($this->db->link, $catName);

        //     if(empty($catName)){
        //         $alert = "<span class='error'>Category must be not empty</span>";
        //         return $alert;
        //     }else{
        //         $query = "UPDATE tbl_category SET catName = '$catName' WHERE catId = '$id'";
        //         $result = $this->db->update($query);
        //         if($result){
        //             $alert = "<span class='success'>Category Update Successfully</span>";
        //             return $alert;
        //         }else{
        //             $alert = "<span class='error'>Category Update  not Success</span>";
        //             return $alert;
        //         }
        //     }
        // }

        // public function getcatbyId($id){
        //     $query = "SELECT * FROM tbl_category WHERE catId = $id";
        //     $result = $this->db->select($query);
        //     return $result;
        // }

        // public function delete_category($id){
        //     $query = "DELETE FROM tbl_category WHERE catId = $id";
        //     $result = $this->db->delete($query);
        //     if($result){
        //         $alert = "<span class='success'>Category Delete Successfully</span>";
        //         return $alert;
        //     }else{
        //         $alert = "<span class='error'>Category Delete not Success</span>";
        //         return $alert;
        //     }
        // }
    }


?>