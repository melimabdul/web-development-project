
<?php include('partials-front/menu.php'); ?>

    <?php 
        //CHeck whether food id is set or not
        if(isset($_GET['food_id']))
        {
            //Get the Food id and details of the selected food
            $food_id = $_GET['food_id'];

            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM food WHERE id=$food_id";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if($count==1)
            {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);

                $title = $row['title'];
                $desc = $row['description'];
                $price = $row['price'];
                $image_name = $row['image_name'];
            }
            else
            {
                //Food not Availabe
                //REdirect to Home Page
                header('location:'.SITEURL);
            }
        }
        else
        {
            //Redirect to homepage
            header('location:'.SITEURL);
        }
    ?>

    <!-- fOOD sEARCH Section Starts Here -->
        <div class="container">
        
            <form  name="cart" action="cart.php" method="POST" class="add">
                <fieldset>

                    <div class="food-menu-img">
                        <?php 
                        
                            //CHeck whether the image is available or not
                            if($image_name=="")
                            {
                                //Image not Availabe
                                echo "<div class='error'>Image not Available.</div>";
                            }
                            else
                            {
                                //Image is Available
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                <?php
                            }
                        
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                    <h2 class="text-center text-black"><?php echo $title; ?></h2>

                        <p class="food-price"><?php echo $desc; ?></p>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        <input type="hidden" name="id" value="<?php echo $food_id; ?>">
                        <input type="hidden" name="form_submitted" value="1">

                        <h3 >RM<?php echo $price; ?></h3>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive w3-border" value="1" required>
                        <input type="submit" name="addToCart" value="Add To Cart" class="btn btn-primary">

                    </div>

                </fieldset>
                </form>

        </div>
    <!-- fOOD sEARCH Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>