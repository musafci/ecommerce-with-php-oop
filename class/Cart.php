<?php

$filepath = realpath(dirname(__FILE__));
include_once ($filepath . '/../lib/database.php');
include_once ($filepath . '/../helpers/format.php');
?>

<?php

class Cart {

    private $db;
    private $fm;

    public function __construct() {
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function addToCart($quantity, $productId) {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $sId = session_id();

        $squery = "SELECT * FROM tbl_product WHERE productId = '$productId'";
        $result = $this->db->select($squery)->fetch_assoc();

        $productName = $result['productName'];
        $price = $result['price'];
        $image = $result['image'];

        $chquery = "SELECT * FROM tbl_cart WHERE productId = '$productId' AND sId = '$sId'";
        $result = $this->db->select($chquery);
        if ($result) {
            $msg = "Product Already Added";
            return $msg;
        } else {

            $query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image)
                  VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
            $productInsert = $this->db->insert($query);
            if ($productInsert) {
                header("Location:cart.php");
            } else {
                header("Location:404.php");
            }
        }
    }

    public function getCartProduct() {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sid = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateToCart($cartId, $quantity) {
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $query = "UPDATE tbl_cart SET quantity = '$quantity' WHERE cartId = '$cartId'";
        $result = $this->db->update($query);
        if ($result) {
            header("Location:cart.php");
        } else {
            $msg = "Quantity Not Updated";
            return $msg;
        }
    }

    public function delProductFromCart($delId) {
        $query = "DELETE FROM tbl_cart WHERE cartId = '$delId'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "Product Delete From Your Cart Successfully";
            return $msg;
        } else {
            $msg = "Product Not Delete From Your Cart";
            return $msg;
        }
    }

    public function checkCartTable() {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sid = '$sId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function delCustomerCart() {
        $sId = session_id();
        $query = "DELETE FROM tbl_cart WHERE sId = '$sId'";
        $this->db->delete($query);
    }

    public function orderProduct($cmrId) {
        $sId = session_id();
        $query = "SELECT * FROM tbl_cart WHERE sid = '$sId'";
        $getProduct = $this->db->select($query);

        if ($getProduct) {
            foreach ($getProduct as $value) {
                $productId = $value['productId'];
                $productName = $value['productName'];
                $quantity = $value['quantity'];
                $price = $value['price'] * $quantity;
                $image = $value['image'];

                $query = "INSERT INTO tbl_order(cmrId,productId,productName,quantity,price,image)
                  VALUES('$cmrId','$productId','$productName','$quantity','$price','$image')";
                $orderInsert = $this->db->insert($query);
            }
        }
    }

    public function payableAmount($cmrId) {
        $query = "SELECT price FROM tbl_order WHERE cmrId = '$cmrId' AND date = now()";
        $result = $this->db->select($query);
        return $result;
    }

    public function getOrderProduct($cmrId) {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId' ORDER BY date DESC";
        $result = $this->db->select($query);
        return $result;
    }

    public function checkOrderTable($cmrId) {
        $query = "SELECT * FROM tbl_order WHERE cmrId = '$cmrId'";
        $result = $this->db->select($query);
        return $result;
    }

    public function getAllOrderProduct() {
        $query = "SELECT * FROM tbl_order ORDER BY date";
        $result = $this->db->select($query);
        return $result;
    }

    public function productShifted($shiftId, $date, $price) {
        $shiftId = mysqli_real_escape_string($this->db->link, $shiftId);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '1' WHERE cmrId = '$shiftId' AND date = '$date' AND price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "Update Successfully";
            return $msg;
        } else {
            $msg = "Update Fail";
            return $msg;
        }
    }

    public function delShiftedProducct($delProId, $date, $price) {
        $delProId = mysqli_real_escape_string($this->db->link, $delProId);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "DELETE FROM tbl_order WHERE cmrId = '$delProId' AND date = '$date' AND price = '$price'";
        $result = $this->db->delete($query);
        if ($result) {
            $msg = "Delete Successfully";
            return $msg;
        } else {
            $msg = "Delete Fail";
            return $msg;
        }
    }

    public function productShiftConfirm($cmrId, $date, $price) {
        $cmrId = mysqli_real_escape_string($this->db->link, $cmrId);
        $date = mysqli_real_escape_string($this->db->link, $date);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $query = "UPDATE tbl_order SET status = '2' WHERE cmrId = '$cmrId' AND date = '$date' AND price = '$price'";
        $result = $this->db->update($query);
        if ($result) {
            $msg = "Update Successfully";
            return $msg;
        } else {
            $msg = "Update Fail";
            return $msg;
        }
    }

}
?>