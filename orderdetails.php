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
if (isset($_GET['cmrId'])) {
    $cmrId = $_GET['cmrId'];
    $date = $_GET['date'];
    $price = $_GET['price'];
    $confirm = $ct->productShiftConfirm($cmrId, $date, $price);
}
?>


<style>
    .tblone tr td{text-align: left;}
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <h2>Your Order Details</h2>
            <table class="tblone">
                <tr>
                    <th>Product Name</th>
                    <th>Image</th>
                    <th>Quantity</th>
                    <th>Total Price</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>

                <?php
                $cmrId = Session::get("customerId");
                $getOrder = $ct->getOrderProduct($cmrId);
                if ($getOrder) {
                    foreach ($getOrder as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value['productName']; ?></td>
                            <td><img src="admin/<?php echo $value['image']; ?>" alt=""/></td>
                            <td><?php echo $value['quantity']; ?></td>
                            <td>$
                                <?php
                                echo $value['price'];
                                ?>
                            </td>
                            <td><?php echo $fm->formatDate($value['date']); ?></td>
                            <td>
                                <?php
                                if ($value['status'] == 0) {
                                    echo "pending";
                                } elseif ($value['status'] == 1) {
                                    echo "Shifted";
                                } else {
                                    echo 'OK';
                                }
                                ?>
                            </td>
                            <?php if ($value['status'] == 1) { ?>
                                <td>
                                    <a href="?cmrId=<?php echo $cmrId; ?>&price=<?php echo $value['price']; ?>&date=<?php echo $value['date']; ?>">
                                        Confirm
                                    </a>
                                </td>
                            <?php } elseif ($value['status'] == 2) { ?>
                                <td>
                                    OK
                                </td> 
                            <?php } elseif ($value['status'] == 0) { ?>
                                <td>
                                    N/A
                                </td> 
                            <?php } ?>
                        </tr>

                        <?php
                    }
                } else {
                    header("Location:index.php");
                }
                ?>
            </table>
        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?> 