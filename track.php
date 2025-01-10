<?php include('partials-front/menu.php'); ?>

    <?php 
        //CHeck whether food id is set or not
        if(isset($_POST['order_id']))
        {
            //Get the Food id and details of the selected food
            $order_id = $_POST['order_id'];

            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM orders WHERE id=$order_id";
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
                $status = $row['status'];
                $_SESSION['track'] = "<div class='success text-center'>Your order #$order_id is $status.</div>";
            }
            else
            {
                //order not Availabe
                //REdirect to Home Page
                $_SESSION['track'] = "<div class='success text-center'>No order with tracking number $order_id found. Please recheck your tracking number.</div>";
            }
        }
    ?>

<section class="w3-center w3-white">
        <div class="container">
        <h2>Track My Order</h2>
        <form class="food-search" action="" method="POST">
            <input type="search" name="order_id" placeholder="Tracking No." class="w3-border input-responsive" required>
            <input type="submit" name="submit" value="Track" class="btn btn-primary">
        </form>
        </div>
</section>

        <div class="container">
        <?php 
    if(isset($_SESSION['track']))
    {
        echo $_SESSION['track'];
        unset($_SESSION['track']);
    }
?>

        </div>


    <?php include('partials-front/footer.php'); ?>