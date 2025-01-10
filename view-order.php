<?php include('partials-front/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>View Order</h1>
        <div class="order-details">
            <?php
            // Check whether id is set or not
            if (isset($_GET['id'])) {
                // Get the Order Details
                $id = $_GET['id'];

                // Get all other details based on this id
                // SQL Query to get the order details
                $sql = "SELECT * FROM `orders` WHERE id=$id";
                // Execute Query
                $res = mysqli_query($conn, $sql);
                // Count Rows
                $count = mysqli_num_rows($res);

                if ($count == 1) {
                    // Details Available
                    $row = mysqli_fetch_assoc($res);

                    $order_id = $row['id'];
                    $order_date = $row['order_date'];
                    $foods = $row['food'];
                    $delivery = $row['delivery'];
                    $status = $row['status'];
                    $remark = $row['remark'];
                    $payment = $row['payment'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                    if ($delivery == 1) {
                        $fee = 10;
                    } else {
                        $fee = 0;
                    }
                } else {
                    // Detail not Available
                    // Redirect to Manage Order
                    header('location:' . SITEURL . 'admin/manage-order.php');
                }
            } else {
                // Redirect to Manage Order Page
                header('location:' . SITEURL . 'admin/manage-order.php');
            }
            ?>

            <table class="order-table">
                <tr>
                    <td>Foods</td>
                    <td><b><?php echo $foods; ?></b></td>
                </tr>
                <tr>
                    <td>Collection method</td>
                    <td>
                        <?php
                        // Ordered, On Delivery, Delivered, Cancelled
                        if ($delivery == 0) {
                            echo "<b>Self-collection</b>";
                        } elseif ($delivery == 1) {
                            echo "<b>Delivery</b>";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>Remark:</td>
                    <td><b><?php echo $remark; ?></b></td>
                </tr>
                <tr>
                    <td>Payment method:</td>
                    <td><b><?php echo $payment; ?></b></td>
                </tr>
                <tr>
                    <td>Customer Name:</td>
                    <td><b><?php echo $customer_name; ?></b></td>
                </tr>
                <tr>
                    <td>Customer Contact:</td>
                    <td><b><?php echo $customer_contact; ?></b></td>
                </tr>
                <tr>
                    <td>Customer Email:</td>
                    <td><b><?php echo $customer_email; ?></b></td>
                </tr>
                <tr>
                    <td>Customer Address:</td>
                    <td><b><?php echo $customer_address; ?></b></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" disabled>
                            <option <?php if ($status == "Ordered") {
                                        echo "selected";
                                    } ?> value="Ordered">Ordered</option>
                            <option <?php if ($status == "Ready") {
                                        echo "selected";
                                    } ?> value="Ready">Ready</option>
                            <option <?php if ($status == "On Delivery") {
                                        echo "selected";
                                    } ?> value="On Delivery">On Delivery</option>
                            <option <?php if ($status == "Delivered") {
                                        echo "selected";
                                    } ?> value="Delivered">Delivered</option>
                            <option <?php if ($status == "Cancelled") {
                                        echo "selected";
                                    } ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <?php
                        echo "<div class='receipt-section'><button id='pdfButton'><b>Click here to print receipt</b></button></div><div style='display:none' id='generatePDF'><fieldset><h4>PAYMENT RECEIPT</h4> 
                <table>
                  <tr>
                    <td>Bill to: $customer_name</td>
                    <td>Receipt No.: $order_id</td>
                  </tr>
                  <tr>
                    <td>Payment method: $payment</td>
                    <td>Order date and time: $order_date</td>
                  </tr>
                </table>
                <div>Item (Price x Quantity = Total)<br>$foods</div>
                <div>Thank you for your business!</div></fieldset></div>";
                        ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    var button = document.getElementById("pdfButton");
    var makepdf = document.getElementById("generatePDF");
    button.addEventListener("click", function() {
        var mywindow = window.open("", "PRINT", "height=600,width=600");
        mywindow.document.write(makepdf.innerHTML);
        mywindow.document.close();
        mywindow.focus();
        mywindow.print();
        return true;
    });
</script>

<?php include('partials-front/footer.php'); ?>