<?php
include './inc/header.php';
?>

<?php
$login = Session::get("customerLogin");
if ($login == FALSE) {
    header("Location:login.php");
}
?>

<style>
    .tblone{width: 550px;margin: 0px auto;border: 2px solid #DDD;}
    .tblone tr td{text-align: justify;}
</style>
<div class="main">
    <div class="content">
        <div class="section group">
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
<?php
include './inc/footer.php';
?> 