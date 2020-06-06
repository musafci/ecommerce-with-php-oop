<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/Cart.php'; ?>

<?php
$ct = new Cart();
$fm = new Format();
?>

<?php
if (isset($_GET['shiftId'])) {
    $shiftId = $_GET['shiftId'];
    $date = $_GET['date'];
    $price = $_GET['price'];
    $shift = $ct->productShifted($shiftId, $date, $price);
}

if (isset($_GET['delProId'])) {
    $delProId = $_GET['delProId'];
    $date = $_GET['date'];
    $price = $_GET['price'];
    $delOrder = $ct->delShiftedProducct($delProId, $date, $price);
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <?php
        if (isset($shift)) {
            echo $shift;
            unset($shift);
        }
        ?>
        <?php
        if (isset($delOrder)) {
            echo $delOrder;
            unset($delOrder);
        }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Date & Time</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Cust. Id</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getOrder = $ct->getAllOrderProduct();
                    if ($getOrder) {
                        foreach ($getOrder as $value) {
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $fm->formatDate($value['date']); ?></td>
                                <td><?php echo $value['productName']; ?></td>
                                <td><?php echo $value['quantity']; ?></td>
                                <td><?php echo $value['price']; ?></td>
                                <td><?php echo $value['cmrId']; ?></td>
                                <td><a href="customer.php?cmrId=<?php echo $value['cmrId']; ?>">View Details</a></td>

                                <?php
                                if ($value['status'] == 0) {
                                    ?>
                                    <td>
                                        <a href="?shiftId=<?php echo $value['cmrId']; ?>&price=<?php echo $value['price']; ?>&date=<?php echo $value['date']; ?>">Shifted</a>
                                    </td>
                                <?php } elseif ($value['status'] == 1) {
                                    ?>
                                    <td>
                                        pending
                                    </td>
                                <?php } else {
                                    ?>
                                    <td>
                                        <a href="?delProId=<?php echo $value['cmrId']; ?>&price=<?php echo $value['price']; ?>&date=<?php echo $value['date']; ?>">Remove</a>
                                    </td>
                                <?php } ?>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php'; ?>
