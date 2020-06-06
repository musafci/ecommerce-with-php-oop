<?php include 'inc/header.php'; ?>
<?php include 'inc/sidebar.php'; ?>
<?php include '../class/Brand.php'; ?>﻿
<?php
$brandObj = new Brand();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $getBrand = $brandObj->getAllBrand();
                    $i = 0;
                    if ($getBrand) {
                        foreach ($getBrand as $value) {
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['brandName']; ?></td>
                                <td>
                                    <a href="brandedit.php?brandId=<?php echo $value['brandId']; ?>">Edit</a> || 
                                    <a onclick="return confirm('Are you sure to Delete')" href="">Delete</a>
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

