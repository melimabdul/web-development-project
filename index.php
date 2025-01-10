<?php include('partials-front/menu.php'); ?>

<!-- fOOD sEARCH Section Starts Here -->
<section class="food-search text-center">
        
        <form action="<?php echo SITEURL; ?>food-search.php" method="GET">
            <input type="search" name="search" placeholder="Search Foods" class="w3-border input-responsive" required>
            <input type="submit" value="Search" class="btn btn-primary">
        </form>

</section>
<!-- fOOD sEARCH Section Ends Here -->

<?php 
    if(isset($_SESSION['order']))
    {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }
?>

<!-- CAtegories Section Starts Here -->
<section class=" w3-center">
        <div class="container">
            <h2 >Explore Our Choices
            </h2>

            <?php 

                //Display all the cateories that are active
                //Sql Query
                $sql = "SELECT * FROM category WHERE active='Yes' AND id<=3";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether categories available or not
                if($count>0)
                {
                    //CAtegories Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <a href="<?php echo SITEURL; ?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not found.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white w3-center"><?php echo $title; ?></h3>
                            </div>
                        </a>

                        <?php
                    }
                }
                else
                {
                    //CAtegories Not Available
                    echo "<div class='error'>Category not found.</div>";
                }
            
            ?>            

            <div class="clearfix"></div>

        </div>            
        <h4><b>We Are Now Delivering to Your Homes!</b></h4>

    <h6><a href="categories.php" class="text-green"><i>Click Here to Explore More of Our Selections</i></a></h6>
    <p>Spend some time to look at our delicious baked goods. Ready to made.</p>



    </section>
<!-- Categories Section Ends Here -->



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu w3-white">        
    <h2 class="text-center">Our Baked Goods</h2>
    <p class="text-center">Click on "Add to Cart" to start your journey with us.</p>


    <div class="container">

        <?php 
        
        //Getting Foods from Database that are active and featured
        //SQL Query
        $sql2 = "SELECT * FROM food WHERE active='Yes' AND featured='Yes' LIMIT 6";

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
                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
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
        ?>
        

        

    </div>
<h6 class="text-center">
        <a href="foods.php" class=""><i>See All Foods</i></a>
    </h6>

</section>    
<div class="clearfix"></div>

<!-- fOOD Menu Section Ends Here -->
<script>
      var button = document.getElementById("pdfButton");
      var makepdf = document.getElementById("generatePDF");
      button.addEventListener("click", function () {
         var mywindow = window.open("", "PRINT", "height=600,width=600");
         mywindow.document.write(makepdf.innerHTML);
         mywindow.document.close();
         mywindow.focus();
         mywindow.print();
         return true;
      });
   </script>

<?php include('partials-front/footer.php'); ?>