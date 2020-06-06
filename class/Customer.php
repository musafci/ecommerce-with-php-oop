<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Customer {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data) {
        
        $name = mysqli_real_escape_string($this->db->link, $data['name']);
        $address = mysqli_real_escape_string($this->db->link, $data['address']);
        $city = mysqli_real_escape_string($this->db->link, $data['city']);
        $country = mysqli_real_escape_string($this->db->link, $data['country']);
        $zip = mysqli_real_escape_string($this->db->link, $data['zip']);
        $phone = mysqli_real_escape_string($this->db->link, $data['phone']);
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass = mysqli_real_escape_string($this->db->link, $data['pass']);

        if ($name == "" || $address == "" || $city == "" || $country == "" || $zip == "" || $phone == "" || $email == "" || $pass == "") {
            $msg = "Field Must Not Be Empty...!";
            return $msg;
        }

        $mailquery = "SELECT * FROM tbl_customer WHERE email ='$email' LIMIT 1";
        $mailchk = $this->db->select($mailquery);
        if ($mailchk != FALSE) {
            $msg = "Mail already exist";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_customer(name,address,city,country,zip,phone,email,pass)VALUES('$name','$address','$city','$country','$zip','$phone','$email','$pass')";
            $customerInsert = $this->db->insert($query);
            if ($customerInsert) {
                $msg = "User Added Successfully";
                return $msg;
            } else {
                $msg = "User Insert Fail";
                return $msg;
            }
        }
    }

    public function customerLogin($data) {
        $email = mysqli_real_escape_string($this->db->link, $data['email']);
        $pass = mysqli_real_escape_string($this->db->link, $data['pass']);

        if ($email == "" || $pass == "") {
            $msg = "Field Must Not Be Empty...!";
            return $msg;
        }

        $query = "SELECT * FROM tbl_customer WHERE email = '$email' AND pass = '$pass' ";
        $result = $this->db->select($query);
        if ($result != FALSE) {
            $value = $result->fetch_assoc();
            Session::set("customerLogin", TRUE);
            Session::set("customerId", $value['id']);
            Session::set("customerName", $value['name']);
            header("Location:cart.php");
        } else {
            $msg = "Email/Password are Wrong";
            return $msg;
        }
    }

    public function getCustomerData($id) {
        $query = "SELECT * FROM tbl_customer WHERE id = '$id'";
        $result = $this->db->select($query);
        return $result;
    }

}
?>