<?php include('partials-front/menu.php'); ?>
<div class="table-container">
    <table class="responsive-table">
        <tr>
            <th width="5%">ID</th>
            <th width="10%">Order Date</th>
            <th width="40%">Food</th>
            <th width="15%">Remark</th>
            <th width="8%">Status</th>
            <th width="10%">Customer</th>
            <th>Actions</th>
        </tr>

        <?php
        //Get all the orders from database
        $sql = "SELECT * FROM `orders` WHERE customer_email = '" . $_SESSION['email'] . "' ORDER BY id DESC";

        //Execute Query
        $res = mysqli_query($conn, $sql);
        //Count the Rows
        $count = mysqli_num_rows($res);

        $sn = 1; //Create a Serial Number and set its initail value as 1

        if ($count > 0) {
            //Order Available
            while ($row = mysqli_fetch_assoc($res)) {
                //Get all the order details
                $id = $row['id'];
                $food = $row['food'];
                $delivery = $row['delivery'];
                $remark = $row['remark'];
                $order_date = $row['order_date'];
                $status = $row['status'];
                $customer_name = $row['customer_name'];
                $customer_contact = $row['customer_contact'];
                $customer_email = $row['customer_email'];
                $customer_address = $row['customer_address'];

        ?>

                <tr>
                    <td><?php echo $id; ?> </td>
                    <td><?php echo $order_date; ?></td>
                    <td><?php echo $food; ?></td>

                    <td><?php echo $remark; ?></td>


                    <td>
                        <?php
                        // Ordered, On Delivery, Delivered, Cancelled

                        if ($status == "Ordered") {
                            echo "<label style='color: blue;'>$status</label>";
                        } elseif ($status == "Ready") {
                            echo "<label style='color: orange;'>$status</label>";
                        } elseif ($status == "On Delivery") {
                            echo "<label style='color: orange;'>$status</label>";
                        } elseif ($status == "Delivered") {
                            echo "<label style='color: green;'><b>$status</b></label>";
                        } elseif ($status == "Cancelled") {
                            echo "<label style='color: red;'>$status</label>";
                        }
                        ?>
                    </td>

                    <td><?php echo $customer_name; ?></td>

                    <td>
                        <a href="<?php echo SITEURL; ?>view-order.php?id=<?php echo $id; ?>" class="btn-secondary">View Order</a>
                    </td>
                </tr>

        <?php

            }
        } else {
            //Order not Available
            echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
        }
        ?>


    </table>
</div>

<?php include('partials-front/footer.php'); ?>