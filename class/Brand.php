<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Brand {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName) {
        $brandName = $this->fm->validation($brandName);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        if (empty($brandName)) {
            $msg = "Brand Field Must Not Be Empty...!";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_brand(brandName)VALUES('$brandName')";
            $brandInsert = $this->db->insert($query);
            if ($brandInsert) {
                $msg = "Brand Insert Successfully";
                return $msg;
            } else {
                $msg = "Brand Insert Fail";
                return $msg;
            }
        }
    }

    public function getAllBrand() {
        $query = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
        $result = $this->db->select($query);
        return $result;
    }

}
