
    <?php include('partials-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        
    <form action="<?php echo SITEURL; ?>food-search.php" method="GET">
            <input type="search" name="search" placeholder="Search Foods" class="w3-border input-responsive" required>
            <input type="submit" value="Search" class="btn btn-primary">
        </form>

</section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class=" w3-white">
        <div class="container">
            <h2 class="w3-center">Foods</h2>

            <?php 
        
        //Getting Foods from Database that are active and featured
        //SQL Query
        $sql2 = "SELECT * FROM food WHERE active='Yes' ";

        //Execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Count Rows
        $count2 = mysqli_num_rows($res2);
        $i=0;
        //CHeck whether food available or not
        if($count2>0)
        {
            //Food Available
            while($row=mysqli_fetch_assoc($res2))
            {
                $i++;
                //Get all the values
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $description = $row['description'];
                $image_name = $row['image_name'];
                ?>

                <div class="food-menu-box w3-border">
                    <div class="food-menu-img">
                        <?php 
                            //Check whether image available or not
                            if($image_name=="")
                            {
                                //Image not Available
                                echo "<div class='error'>Image not available.</div>";
                            }
                            else
                            {
                                //Image Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        ?>
                        
                    </div>

                    <div class="food-menu-desc">
                        <h4><?php echo $title; ?></h4>
                        <p class="food-price">RM<?php echo $price; ?></p>
                        <br>

                        <a href="<?php echo SITEURL; ?>food-item.php?food_id=<?php echo $id; ?>" class="w3-button w3-round-large w3-green">Add to Cart</a>
                    </div>
                </div>

                <?php
                if (($i%2)==0):?>
                    <div class="clearfix"></div>
                <?php endif;
            }
        }
        else
        {
            //Food Not Available 
            echo "<div class='error'>Food not available.</div>";
        }
        
        ?>


            

            

            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>