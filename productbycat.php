<?php
include './inc/header.php';
?>

<?php
if (!isset($_GET['catId']) || $_GET['catId'] == NULL) {
    echo "<script>window.location = '404.php';</script>";
} else {
    $catId = $_GET['catId'];
}
?>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>Latest from Category</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group">
            <?php
            $productByCat = $pd->productByCat($catId);
            if ($productByCat) {
                foreach ($productByCat as $value) {
                    ?>
                    <div class="grid_1_of_4 images_1_of_4">
                        <a href="details.php?productId=<?php echo $value['productId']; ?>">
                            <img src="admin/<?php echo $value['image']; ?>" alt="" />
                        </a>
                        <h2><?php echo $value['productName']; ?></h2>
                        <p><?php echo $fm->textShort($value['body'], 50); ?></p>
                        <p><span class="price">$<?php echo $value['price']; ?></span></p>
                        <div class="button"><span><a href="details.php?productId=<?php echo $value['productId']; ?>" class="details">Details</a></span></div>
                    </div>
                    <?php
                }
            }else{
                echo "<span style='font-size:22px;'>No product available in this category....!</span>";
            }
            ?>

        </div>



    </div>
</div>
<?php
include './inc/footer.php';
?>