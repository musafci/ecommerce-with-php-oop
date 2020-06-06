<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/Product.php'; ?>
<?php include_once '../helpers/format.php'; ?>

<?php
$pd = new Product();
$fm = new Format();
?>

﻿
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getPd = $pd->getAllProduct();
                    if ($getPd) {
                        $i = 0;
                        foreach ($getPd as $value) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['productName']; ?></td>
                                <td><?php echo $value['catName']; ?></td>
                                <td><?php echo $value['brandName']; ?></td>
                                <td><?php echo $fm->textShort($value['body'], 50); ?></td>
                                <td>$<?php echo $value['price']; ?></td>
                                <td><img src="<?php echo $value['image']; ?>" width="50px" height="50px"></td>
                                <td>
                                    <?php
                                    if ($value['type'] == 0) {
                                        echo 'Featured';
                                    } else {
                                        echo 'General';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <a href="productedit.php?productId=<?php echo $value['productId']; ?>">Edit</a> || 
                                    <a onclick="return confirm('Are you sure to Delete')" href="?productdel=<?php echo $value['productId']; ?>">Delete</a>
                                </td>
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
