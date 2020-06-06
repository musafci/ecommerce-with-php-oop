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
    .success{width: 500px;min-height: 200px;text-align: center;border: 1px solid #DDD;margin: 0px auto;padding: 20px;}
    .success h2{border-bottom: 1px solid #ddd;margin-bottom: 25px;padding-bottom: 10px;}
    .success p{line-height: 25px;}
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="success">
                <h2>Success</h2>
                <?php
                $cmrId = Session::get("customerId");
                $amount = $ct->payableAmount($cmrId);
                $sum = 0;
                if ($amount) {
                    foreach ($amount as $value) {
                        $price = $value['price'];
                        $sum = $sum + $price;
                    }
                }
                ?>
                <p>
                    Total Payable Amount (Including 10% Vat)
                    <?php
                    $vat = $sum * 0.1;
                    $total = $sum + $vat;
                    echo $total;
                    ?>
                </p>
                <p>
                    Here is your order details <a href="orderdetails.php">visit here</a>
                </p>

            </div>

        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?> 