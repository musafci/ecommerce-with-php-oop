<?php
include './inc/header.php';
?>
<?php
if (isset($_GET['productId'])) {
    $productId = $_GET['productId'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $quantity = $_POST['quantity'];
    $addCart = $ct->addToCart($quantity, $productId);
}
?>

<?php
$cmrId = Session::get("customerId");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['compare'])) {
    $productId = $_POST['productId'];
    $insertCompare = $pd->insertCompareData($cmrId, $productId);
}
?>

<?php
$cmrId = Session::get("customerId");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['wlist'])) {
    $productId = $_POST['productId'];
    $saveWlist = $pd->saveWlistData($cmrId, $productId);
}
?>


<style>
    .mybtn{width: 100px;float: left;margin-right: 30px;}
</style>


<div class="main">
    <div class="content">
        <div class="section group">
            <div class="cont-desc span_1_of_2">	
                <?php
                $getpd = $pd->getSingleProduct($productId);
                if ($getpd) {
                    foreach ($getpd as $value) {
                        ?>

                        <div class="grid images_3_of_2">
                            <img src="admin/<?php echo $value['image']; ?>" alt="" />
                        </div>
                        <div class="desc span_3_of_2">
                            <h2><?php echo $value['productName']; ?></h2>
                            <div class="price">
                                <p>Price: <span><?php echo $value['price']; ?></span></p>
                                <p>Category: <span><?php echo $value['catName']; ?></span></p>
                                <p>Brand:<span><?php echo $value['brandName']; ?></span></p>
                            </div>
                            <div class="add-cart">
                                <form action="" method="post">
                                    <input type="number" class="buyfield" name="quantity" value="1"/>
                                    <input type="submit" class="buysubmit" name="submit" value="Buy Now"/>
                                </form>				
                            </div>
                            <?php
                            if (isset($addCart)) {
                                echo $addCart;
                                unset($addCart);
                            }
                            ?>


                            <?php
                            if (isset($insertCompare)) {
                                echo $insertCompare;
                                unset($insertCompare);
                            }
                            ?>

                            <?php
                            if (isset($saveWlist)) {
                                echo $saveWlist;
                                unset($saveWlist);
                            }
                            ?>


                            <?php
                            $login = Session::get("customerLogin");
                            if ($login == TRUE) {
                                ?>
                                <div class="add-cart">
                                    <div class="mybtn">
                                        <form action="" method="post">
                                            <input type="hidden" class="buyfield" name="productId" value="<?php echo $value['productId']; ?>"/>
                                            <input type="submit" class="buysubmit" name="compare" value="Add to Compare"/>
                                        </form>
                                    </div>
                                    <div class="mybtn">
                                        <form action="" method="post">
                                            <input type="hidden" class="buyfield" name="productId" value="<?php echo $value['productId']; ?>"/>
                                            <input type="submit" class="buysubmit" name="wlist" value="Add to Wishlist"/>
                                        </form>
                                    </div>
                                </div>
                            <?php } ?>

                        </div>
                        <div class="product-desc">
                            <h2>Product Details</h2>
                            <p>
                                <?php echo $value['body']; ?>
                            </p>

                        </div>
                        <?php
                    }
                }
                ?>

            </div>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php
                    $getCat = $cat->getAllCat();
                    if ($getCat) {
                        foreach ($getCat as $value) {
                            ?>
                            <li>
                                <a href="productbycat.php?catId=<?php echo $value['catId']; ?>">
                                    <?php echo $value['catName']; ?>
                                </a>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>
    </div>
</div>
<?php
include './inc/footer.php';
?>