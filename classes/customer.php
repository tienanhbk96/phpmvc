<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../lib/database.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class customer {
        private $db;
        private $fm;

        public function __construct(){
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_customer($data){
            $name = mysqli_real_escape_string($this->db->link, $data['name']);
            $city = mysqli_real_escape_string($this->db->link, $data['city']);
            $zipCode = mysqli_real_escape_string($this->db->link, $data['zipCode']);
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $address = mysqli_real_escape_string($this->db->link, $data['address']);
            $country = mysqli_real_escape_string($this->db->link, $data['country']);
            $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));
            
            if($name == "" || $city == "" || $zipCode == "" || $email == "" || $address == "" || $country == "" || $phone == "" || $password == ""){
                $alert = "<span class='error'>Fields must be not empty</span>";
                return $alert;
            }else{
                $check_email = "SELECT email FROM tbl_customer where email = '$email'" ;
                $result_check  =  $this->db->select($check_email);
                if($result_check){
                    $alert = "<span class='error'>Email Already Exits</span>";
                    return $alert;
                }else{
                    $query = "INSERT INTO tbl_customer(name, city, zipCode, email, address, country, phone, password
                    ) VALUES('$name', '$city', '$zipCode', '$email', '$address', '$country', '$phone', '$password')";
                    $result = $this->db->insert($query);

                    if($result){
                        $alert = "<span class='success'>Customer Created Successfully</span>";
                        return $alert;
                    }else{
                        $alert = "<span class='error'>Customer Created not Success</span>";
                        return $alert;
                    }
                }
            }
        }

        public function login_customer($data){
            $email = mysqli_real_escape_string($this->db->link, $data['email']);
            $password = mysqli_real_escape_string($this->db->link, md5($data['password']));

            if($email == "" || $password == ""){
                $alert = "<span class='error'>Password and email must be not empty</span>";
                return $alert;
            }else{
                $check_email = "SELECT * FROM tbl_customer where email = '$email' AND password = '$password'" ;
                $result_check  =  $this->db->select($check_email);
                if($result_check){
                    $result_check = $result_check->fetch_assoc();
                    Session::set('customer_login', true);
                    Session::set('customer_id', $result_check['id']);
                    Session::set('customer_login', $result_check['name']);
                    header('Location:order.php');
                    // $alert = "<span class='error'>Email Already Exits</span>";
                    // return $alert;
                }else{
                    $alert = "<span class='error'>Email or Password doesn't match</span>";
                    return $alert;
                }
            }
        }
    }
?> 