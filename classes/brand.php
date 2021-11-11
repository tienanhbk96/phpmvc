<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class brand {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }
            
        public function insert_brand($brandName){
            $brandName = $this->fm->validation($brandName);

            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span class='error'>Brand must be not empty</span>";
                return $alert;
            }else{
                $query = "INSERT INTO tbl_brand(brandName) VALUES('$brandName')";
                $result = $this->db->insert($query);
                if($result){
                    $alert = "<span class='success'>Insert Brand Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Insert Brand not Success</span>";
                    return $alert;
                }
            }
        }

        public function show_brand(){
            $query = "SELECT * FROM tbl_brand order by brandId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_brand($id, $brandName){
            $brandName = $this->fm->validation($brandName);
            $brandName = mysqli_real_escape_string($this->db->link, $brandName);

            if(empty($brandName)){
                $alert = "<span class='error'>Brand must be not empty</span>";
                return $alert;
            }else{
                $query = "UPDATE tbl_brand SET brandName = '$brandName' WHERE brandId = '$id'";
                $result = $this->db->update($query);
                if($result){
                    $alert = "<span class='success'>Brand Update Successfully</span>";
                    return $alert;
                }else{
                    $alert = "<span class='error'>Brand Update  not Success</span>";
                    return $alert;
                }
            }
        }

        public function getbrandbyId($id){
            $query = "SELECT * FROM tbl_brand WHERE brandId = $id";
            $result = $this->db->select($query);
            return $result;
        }

        public function delete_brand($id){
            $query = "DELETE FROM tbl_brand WHERE brandId = $id";
            $result = $this->db->delete($query);
            if($result){
                $alert = "<span class='success'>Brand Delete Successfully</span>";
                return $alert;
            }else{
                $alert = "<span class='error'>Brand Delete not Success</span>";
                return $alert;
            }
        }
    }


?>