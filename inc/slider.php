<div class="header_bottom">
    <div class="header_bottom_left">
        <div class="section group">
            <?php
            $getIphone = $pd->latestFromIphone();
            if ($getIphone) {
                foreach ($getIphone as $value) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?productId=<?php echo $value['productId']; ?>"> <img src="admin/<?php echo $value['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Iphone</h2>
                            <p><?php echo $value['productName']; ?></p>
                            <div class="button"><span><a href="details.php?productId=<?php echo $value['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

            <?php
            $getSamsung = $pd->latestFromSamsung();
            if ($getSamsung) {
                foreach ($getSamsung as $value) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?productId=<?php echo $value['productId']; ?>"> <img src="admin/<?php echo $value['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Samsung</h2>
                            <p><?php echo $value['productName']; ?></p>
                            <div class="button"><span><a href="details.php?productId=<?php echo $value['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
        <div class="section group">
            <?php
            $getAcer = $pd->latestFromAcer();
            if ($getAcer) {
                foreach ($getAcer as $value) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?productId=<?php echo $value['productId']; ?>"> <img src="admin/<?php echo $value['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>ACER</h2>
                            <p><?php echo $value['productName']; ?></p>
                            <div class="button"><span><a href="details.php?productId=<?php echo $value['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>	
                    <?php
                }
            }
            ?>

            <?php
            $getCanon = $pd->latestFromCanon();
            if ($getCanon) {
                foreach ($getCanon as $value) {
                    ?>
                    <div class="listview_1_of_2 images_1_of_2">
                        <div class="listimg listimg_2_of_1">
                            <a href="details.php?productId=<?php echo $value['productId']; ?>"> <img src="admin/<?php echo $value['image']; ?>" alt="" /></a>
                        </div>
                        <div class="text list_2_of_1">
                            <h2>Canon</h2>
                            <p><?php echo $value['productName']; ?></p>
                            <div class="button"><span><a href="details.php?productId=<?php echo $value['productId']; ?>">Add to cart</a></span></div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>

        </div>
        <div class="clear"></div>
    </div>
    <div class="header_bottom_right_images">
        <!-- FlexSlider -->

        <section class="slider">
            <div class="flexslider">
                <ul class="slides">
                    <li><img src="images/1.jpg" alt=""/></li>
                    <li><img src="images/2.jpg" alt=""/></li>
                    <li><img src="images/3.jpg" alt=""/></li>
                    <li><img src="images/4.jpg" alt=""/></li>
                </ul>
            </div>
        </section>
        <!-- FlexSlider -->
    </div>
    <div class="clear"></div>
</div>