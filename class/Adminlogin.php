<?php
$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/session.php');
Session::checkLogin();
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>


<?php

class Adminlogin {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLogin($adminUser, $adminPass) {
        $adminUser = $this->fm->validation($adminUser);
        $adminPass = $this->fm->validation($adminPass);

        $adminUser = mysqli_real_escape_string($this->db->link, $adminUser);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);

        if (empty($adminUser) || empty($adminPass)) {
            $loginmsg = "Field Must Not Be Empty...!";
            return $loginmsg;
        } else {
            $query = "SELECT * FROM tbl_admin WHERE adminUser='$adminUser' AND adminPass='$adminPass'";
            $result = $this->db->select($query);
            if ($result != FALSE) {
                $value = $result->fetch_assoc();
                Session::set("adminLogin", TRUE);
                Session::set("adminId", $value['adminId']);
                Session::set("adminUser", $value['adminUser']);
                Session::set("adminName", $value['adminName']);
                header('Location:index.php');
            } else {
                $loginmsg = "Login Information Not Match.";
                return $loginmsg;
            }
        }
    }

}
?>