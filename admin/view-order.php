<?php include('partials/menu.php');        
            //CHeck whether Update Button is Clicked or Not
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                //Get All the Values from Form
                $id = $_POST['id'];
                $status = $_POST['status'];

                //Update the Values
                $sql2 = "UPDATE orders SET 
                    status = '$status'
                    WHERE id = $id ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether update or not
                //And REdirect to Manage Order with Message
                if($res2==true)
                {
                    //Updated
                    $_SESSION['update'] = "<div class='success'>Order #$id Status Updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/view-order.php');
                }
                else
                {
                    //Failed to Update
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order Status.</div>";
                    header('location:'.SITEURL.'admin/view-order.php');
                }
            }
        ?>


<div class="main-content">
    <div class="wrapper">
        <h1>View Order</h1>
        <br><br>


        <?php 
        
            //CHeck whether id is set or not
            if(isset($_GET['id']))
            {
                //GEt the Order Details
                $id=$_GET['id'];

                //Get all other details based on this id
                //SQL Query to get the order details
                $sql = "SELECT * FROM `orders` WHERE id=$id";
                //Execute Query
                $res = mysqli_query($conn, $sql);
                //Count Rows
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Detail Availble
                    $row=mysqli_fetch_assoc($res);

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
                    $customer_address= $row['customer_address'];
                    if($delivery==1){
                        $fee=10;
                    }else{
                        $fee=0;
                    }

                }
                else
                {
                    //DEtail not Available/
                    //Redirect to Manage Order
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            else
            {
                //REdirect to Manage ORder PAge
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-60">
                <tr>
                    <td>Foods</td>
                    <td style="text-align:right"><b> <?php echo $foods; ?> </b></td>
                </tr>

                <tr>
                    <td>Collection method</td>
                    <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($delivery==0)
                                                {
                                                    echo "<b>Self-collection</b>";
                                                }
                                                elseif($delivery==1)
                                                {
                                                    echo "<b>Delivery</b>";
                                                }
                                            ?>
                                        </td>
                </tr>

                <tr>
                    <td>Remark: </td>
                    <td><b> <?php echo $remark; ?> </b></td>
                </tr>

                <tr>
                    <td>Payment method: </td>
                    <td><b> <?php echo $payment; ?> </b></td>
                </tr>

                <tr>
                    <td>Customer Name: </td>
                    <td><b> <?php echo $customer_name; ?> </b></td>
                </tr>

                <tr>
                    <td>Customer Contact: </td>
                    <td><b> <?php echo $customer_contact; ?> </b></td>
                </tr>

                <tr>
                    <td>Customer Email: </td>
                    <td><b> <?php echo $customer_email; ?> </b></td>
                </tr>

                <tr>
                    <td>Customer Address: </td>
                    <td><b> <?php echo $customer_address; ?> </b></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status=="Ordered"){echo "selected";} ?> value="Ordered">Ordered</option>
                            <option <?php if($status=="Ready"){echo "selected";} ?> value="Ready">Ready</option>
                            <option <?php if($status=="On Delivery"){echo "selected";} ?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";} ?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";} ?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="submit" name="submit" value="Update Order" class="btn-secondary">
                                            </td><td>
                        <?php
                                            echo "<div  class='success text-center'><button id='pdfButton'><b>Click here to print receipt</b></button></div><div style='display:none' id='generatePDF'><fieldset style='max-width:600px;margin: auto;'><h4 style='text-align:center'>PAYMENT RECEIPT⠀⠀⠀⠀⠀⠀⠀⠀Auntie Jue's Homebakes</h4> 
                                            <table style='width:100%;border: 1px solid black'>
                                            <tr>
                                            <td>Bill to: $customer_name</td>
                                            <td style='text-align:right'>Receipt No.: $order_id</td>
                                            </tr>
                                            <tr>
                                            <td>Payment method: $payment</td>
                                            <td style='text-align:right'>Order date and time: $order_date</td>
                                            </tr>
                                            </table><br>
                                            <div style='text-align:right'>Item (Price x Quantity = Total)<br>$foods</div><div style='text-align:center'><br>Thank you for your business!</div></fieldset></div>";
?>                                            
                    </td>
                </tr>

            </table>
        
        </form>




    </div>
</div>
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

<?php include('partials/footer.php'); ?>
