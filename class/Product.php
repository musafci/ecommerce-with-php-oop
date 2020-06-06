<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Product {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function productInsert($data, $file) {
        $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
        $catId = mysqli_real_escape_string($this->db->link, $data['catId']);
        $brandId = mysqli_real_escape_string($this->db->link, $data['brandId']);
        $body = mysqli_real_escape_string($this->db->link, $data['body']);
        $price = mysqli_real_escape_string($this->db->link, $data['price']);
        $type = mysqli_real_escape_string($this->db->link, $data['type']);


        $permited = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $file['image']['name'];
        $file_size = $file['image']['size'];
        $file_temp = $file['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
        $uploaded_image = "uploads/" . $unique_image;

        if ($productName == "" || $catId == "" || $brandId == "" || $body == "" || $price == "" || $type == "") {
            $msg = "Field Must Not Be Empty...!";
            return $msg;
        } else {
            move_uploaded_file($file_temp, $uploaded_image);
            $query = "INSERT INTO tbl_product(productName,catId,brandId,body,price,image,type)VALUES('$productName','$catId','$brandId','$body','$price','$uploaded_image','$type')";
            $productInsert = $this->db->insert($query);
            if ($productInsert) {
                $msg = "Product Insert Successfully";
                return $msg;
            } else {
                $msg = "Product Insert Fail";
                return $msg;
            }
        }
    }

    public function getAllProduct() {
        $query = "SELECT p.*,c.catName,b.brandName 
                  FROM tbl_product as p,tbl_category as c,tbl_brand as b 
                  WHERE p.catId = c.catId AND p.brandId = b.brandId 
                  ORDER BY p.productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function getFeaturedProduct() {
        $query = "SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getNewProduct() {
        $query = "SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 4";
        $result = $this->db->select($query);
        return $result;
    }

    public function getSingleProduct($productId) {
        $query = "SELECT p.*,c.catName,b.brandName 
                  FROM tbl_product as p,tbl_category as c,tbl_brand as b 
                  WHERE p.catId = c.catId AND p.brandId = b.brandId AND p.productId = '$productId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromIphone() {
        $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromSamsung() {
        $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromAcer() {
        $query = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function latestFromCanon() {
        $query = "SELECT * FROM tbl_product WHERE brandId = '6' ORDER BY productId DESC LIMIT 1";
        $result = $this->db->select($query);
        return $result;
    }

    public function productByCat($catId) {
        $query = "SELECT * FROM tbl_product WHERE catId = '$catId' ORDER BY productId DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function insertCompareData($cmrId, $productId) {
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);

        $compareQuery = "SELECT * FROM tbl_compare WHERE productId = '$productId' AND cmrId = '$cmrId'";
        $check = $this->db->select($compareQuery);
        if ($check) {
            $msg = "Already Added";
            return $msg;
        }


        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $getProduct = $this->db->select($query)->fetch_assoc();

        if ($getProduct) {
            $productId = $getProduct['productId'];
            $productName = $getProduct['productName'];
            $price = $getProduct['price'];
            $image = $getProduct['image'];

            $query = "INSERT INTO tbl_compare(cmrId,productId,productName,price,image)
                  VALUES('$cmrId','$productId','$productName','$price','$image')";
            $compareInsert = $this->db->insert($query);
            if ($compareInsert) {
                $msg = "Added to Compare";
                return $msg;
            } else {
                $msg = "Fail to Added Compare";
                return;
            }
        }
    }

    public function getCompareProduct($cmrId) {
        $query = "SELECT * FROM tbl_compare WHERE cmrId = '$cmrId' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCompareData($cmrId) {
        $query = "DELETE FROM tbl_compare WHERE cmrId = '$cmrId'";
        $this->db->delete($query);
    }

    public function saveWlistData($cmrId, $productId) {
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
        $productId = mysqli_real_escape_string($this->db->link, $productId);

        $compareQuery = "SELECT * FROM tbl_wlist WHERE productId = '$productId' AND cmrId = '$cmrId'";
        $check = $this->db->select($compareQuery);
        if ($check) {
            $msg = "Already Added";
            return $msg;
        }


        $query = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $getProduct = $this->db->select($query)->fetch_assoc();

        if ($getProduct) {
            $productId = $getProduct['productId'];
            $productName = $getProduct['productName'];
            $price = $getProduct['price'];
            $image = $getProduct['image'];

            $query = "INSERT INTO tbl_wlist(cmrId,productId,productName,price,image)
                  VALUES('$cmrId','$productId','$productName','$price','$image')";
            $compareInsert = $this->db->insert($query);
            if ($compareInsert) {
                $msg = "Added to Wishlist";
                return $msg;
            } else {
                $msg = "Fail to Added Wishlist";
                return;
            }
        }
    }

    public function getWlistProduct($cmrId) {
        $query = "SELECT * FROM tbl_wlist WHERE cmrId = '$cmrId' ORDER BY id DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function delWlistData($cmrId, $productId) {
        $query = "DELETE FROM tbl_wlist WHERE cmrId = '$cmrId' AND productId = '$productId'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "Wishlist Delete Successfully";
            return $msg;
        }
    }

}
