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
if (isset($_GET['productDelId'])) {
    $productId = $_GET['productDelId'];
    $delWlist = $pd->delWlistData($cmrId, $productId);
}
?>


<style>
    table.tblone img{width: 90px;height: 100px;}
</style>
<div class="main">
    <div class="content">
        <div class="cartoption">
            <?php
            if ((isset($delWlist))) {
                echo $delWlist;
                unset($delWlist);
            }
            ?>
            <div class="cartpage">
                <h2>Wishlist</h2>

                <table class="tblone">
                    <tr>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>

                    <?php
                    $cmrId = Session::get("customerId");
                    $getPro = $pd->getWlistProduct($cmrId);
                    if ($getPro) {
                        foreach ($getPro as $value) {
                            ?>
                            <tr>
                                <td><?php echo $value['productName']; ?></td>
                                <td>$<?php echo $value['price']; ?></td>
                                <td><img src="admin/<?php echo $value['image']; ?>" alt=""/></td>

                                <td>
                                    <a href="details.php?productId=<?php echo $value['productId']; ?>">Buy</a>  ||  
                                    <a href="?productDelId=<?php echo $value['productId']; ?>">Delete</a>  
                                </td>
                            </tr>

                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
            <div class="shopping">
                <div class="shopleft" style="width: 100%;text-align: center">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>  	
        <div class="clear"></div>
    </div>
</div>
<?php
include './inc/footer.php';
?>