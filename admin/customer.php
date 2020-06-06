<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/Customer.php'; ?>﻿


<?php
if (!isset($_GET['cmrId']) || $_GET['cmrId'] == NULL) {
    echo "<script>window.location = 'inbox.php';</script>";
} else {
    $cmrId = $_GET['cmrId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "<script>window.location = 'inbox.php';</script>";
}
?>


<div class="grid_10">
    <div class="box round first grid">
        <h2>Customer Details</h2>
        <div class="block copyblock">
            <?php
            $cus = new Customer();
            $getCus = $cus->getCustomerData($cmrId);
            if ($getCus) {
                foreach ($getCus as $value) {
                    ?>
                    <form action="" method="post">
                        <table class="form">					
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input type="text" value="<?php echo $value['name']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td>
                                    <input type="text" value="<?php echo $value['address']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>City</td>
                                <td>
                                    <input type="text" value="<?php echo $value['city']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Country</td>
                                <td>
                                    <input type="text" value="<?php echo $value['country']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Zip</td>
                                <td>
                                    <input type="text" value="<?php echo $value['zip']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>
                                    <input type="text" value="<?php echo $value['phone']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>
                                    <input type="text" value="<?php echo $value['email']; ?>" readonly="" class="medium" />
                                </td>
                            </tr>
                            <tr> 
                                <td></td>
                                <td>
                                    <input type="submit" name="submit" Value="oK" />
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>