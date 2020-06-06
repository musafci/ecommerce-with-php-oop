<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Category {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName) {
        $catName = $this->fm->validation($catName);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        if (empty($catName)) {
            $msg = "Category Field Must Not Be Empty...!";
            return $msg;
        } else {
            $query = "INSERT INTO tbl_category(catName)VALUES('$catName')";
            $catInsert = $this->db->insert($query);
            if ($catInsert) {
                $msg = "Category Insert Successfully";
                return $msg;
            } else {
                $msg = "Category Insert Fail";
                return $msg;
            }
        }
    }

    public function getAllCat() {
        $query = "SELECT * FROM tbl_category ORDER BY catId DESC";
        $result = $this->db->select($query);
        return $result;
    }

}
?>