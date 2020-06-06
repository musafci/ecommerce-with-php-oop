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
    .payment{width: 500px;min-height: 200px;text-align: center;border: 1px solid #DDD;margin: 0px auto;padding: 50px;}
    .payment h2{border-bottom: 1px solid #ddd;margin-bottom: 50px;padding-bottom: 10px;}
    .payment a{background: green;color: #FFF;font-size: 28px;padding: 10px 20px;border-radius: 10px;}
    .back a{width: 150px;margin: 5px auto;padding: 5px;font-size: 24px;text-align: center;display: block;background: #555;border: 1px solid #333;color: #FFF;border-radius: 10px;}
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="payment">
                <h2>Choose Payment Option</h2>
                <a href="payoffline.php">Offline</a>
                <a href="payonline.php">Online</a>
            </div>
            <div class="back">
                <a href="cart.php">< Previous</a>
            </div>
        </div>
    </div>
</div>
<?php

include './inc/footer.php';
?> 