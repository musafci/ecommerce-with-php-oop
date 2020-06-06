<?php
include './inc/header.php';
?>

<?php
$login = Session::get("customerLogin");
if ($login == FALSE) {
    header("Location:login.php");
}
?>

<?php
if (isset($_GET['orderId']) && $_GET['orderId'] == 'order') {
    $cmrId = Session::get("customerId");
    $insertOrder = $ct->orderProduct($cmrId);
    $delData = $ct->delCustomerCart();
    header("Location:success.php");
}
?>

<style>
    .division{width: 50%;float: left;}
    .tblone{width: 500px;margin: 0px auto;border: 2px solid #DDD;}
    .tblone tr td{text-align: justify;}
    .tbltwo{float:right;width: 60%;text-align:left;border: 2px solid #DDD;margin-right: 15px;margin-top: 15px;}
    .tbltwo tr td{text-align: justify;padding: 5px;}
    .ordernow a{
        width: 150px;margin: 5px auto;padding: 5px;font-size: 24px;text-align: center;display: block;background: #70389C;border: 1px solid #333;color: #FFF;border-radius: 10px;
    }
</style>
<div class="main">
    <div class="content">
        <div class="section group">

            <div class="division">
                <table class="tblone">
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
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
                                <td>$<?php echo $value['price']; ?></td>
                                <td><?php echo $value['quantity']; ?></td>

                                <td>$
                                    <?php
                                    $total = $value['price'] * $value['quantity'];
                                    echo $total;
                                    ?>
                                </td>
                            </tr>
                            <?php
                            $sum = $sum + $total;

                            $qty = $qty + $value['quantity'];
                            Session::set("qty", $qty);
                            ?>

                            <?php
                        }
                    }
                    ?>
                </table>
                <table class="tbltwo">
                    <tr>
                        <td>Quantity</td>
                        <td>:</td>
                        <td><?php echo $qty; ?></td>
                    </tr>
                    <tr>
                        <td>Sub Total</td>
                        <td>:</td>
                        <td>$ <?php echo $sum; ?></td>
                    </tr>
                    <tr>
                        <td>VAT</td>
                        <td>:</td>
                        <td>10%($ <?php echo $vat = $sum * 0.1; ?>)</td>
                    </tr>
                    <tr>
                        <td>Grand Total</td>
                        <td>:</td>
                        <td>
                            $ <?php
                            $vat = $sum * 0.1;
                            $gtotal = $sum + $vat;
                            echo $gtotal;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="division">
                <?php
                $id = Session::get("customerId");
                $getData = $cmr->getCustomerData($id);
                if ($getData) {
                    foreach ($getData as $value) {
                        ?>
                        <table class="tblone">
                            <tr>
                                <td colspan="3" style="text-align: center;">
                                    <h2>User Profile Details</h2>
                                </td>
                            </tr>
                            <tr>
                                <td width='20%'>Name</td>
                                <td width='3%'>:</td>
                                <td><?php echo $value['name']; ?></td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>:</td>
                                <td><?php echo $value['phone']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td><?php echo $value['email']; ?></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>:</td>
                                <td><?php echo $value['address']; ?></td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>:</td>
                                <td><?php echo $value['city']; ?></td>
                            </tr>
                            <tr>
                                <td>Zip-Code</td>
                                <td>:</td>
                                <td><?php echo $value['zip']; ?></td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>:</td>
                                <td><?php echo $value['country']; ?></td>
                            </tr>
                        </table>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div class="ordernow">
        <a href="?orderId=order">Order Now !</a>
    </div>
</div>
<?php
include './inc/footer.php';
?> 