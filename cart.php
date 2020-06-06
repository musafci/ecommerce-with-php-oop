<?php
include './inc/header.php';
?>

<?php
if (isset($_GET['delpro'])) {
    $delId = $_GET['delpro'];
    $delProduct = $ct->delProductFromCart($delId);
}
?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cartId = $_POST['cartId'];
    $quantity = $_POST['quantity'];
    $updateCart = $ct->updateToCart($cartId, $quantity);

    if ($quantity <= 0) {
        $delProduct = $ct->delProductFromCart($cartId);
    }
}
?>

<?php
if (!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content='0;URL=?id=live' />";
}
?>



<div class="main">
    <div class="content">
        <div class="cartoption">		
            <div class="cartpage">
                <h2>Your Cart</h2>

                <?php
                if (isset($updateCart)) {
                    echo $updateCart;
                    unset($updateCart);
                }
                ?>

                <?php
                if (isset($delProduct)) {
                    echo $delProduct;
                    unset($delProduct);
                }
                ?>

                <table class="tblone">
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="10%">Image</th>
                        <th width="15%">Price</th>
                        <th width="25%">Quantity</th>
                        <th width="20%">Total Price</th>
                        <th width="10%">Action</th>
                    </tr>

                    <?php
                    $getPro = $ct->getCartProduct();
                    if ($getPro) {
                        $sum = 0;
                        $qty = 0;
                        foreach ($getPro as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['productName']; ?></td>
                                <td><img src="admin/<?php echo $value['image']; ?>" alt=""/></td>
                                <td>$<?php echo $value['price']; ?></td>
                                <td>
                                    <form action="" method="post">
                                        <input type="hidden" name="cartId" value="<?php echo $value['cartId']; ?>"/>
                                        <input type="number" name="quantity" value="<?php echo $value['quantity']; ?>"/>
                                        <input type="submit" name="submit" value="Update"/>
                                    </form>
                                </td>
                                <td>$
                                    <?php
                                    $total = $value['price'] * $value['quantity'];
                                    echo $total;
                                    ?>
                                </td>
                                <td>
                                    <a onclick="return confirm('Are you sure to Delete')" href="?delpro=<?php echo $value['cartId']; ?>">x</a>
                                </td>
                            </tr>
                            <?php
                            echo $sum = $sum + $total;

                            $qty = $qty + $value['quantity'];
                            Session::set("qty", $qty);
                            ?>

                            <?php
                        }
                    }
                    ?>
                </table>
                <?php
                if ($getData) {
                    ?>
                    <table style="float:right;text-align:left;" width="40%">
                        <tr>
                            <th>Sub Total : </th>
                            <td>$ <?php echo $sum; ?></td>
                        </tr>
                        <tr>
                            <th>VAT : </th>
                            <td>10%</td>
                        </tr>
                        <tr>
                            <th>Grand Total :</th>
                            <td>
                                $ <?php
                                $vat = $sum * 0.1;
                                $gtotal = $sum + $vat;
                                echo $gtotal;

                                Session::set("gtotal", $gtotal);
                                ?>
                            </td>
                        </tr>
                    </table>
                    <?php
                } else {
                    header("Location:index.php");
                }
                ?>
            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php
include './inc/footer.php';
?>