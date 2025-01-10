<?php include('partials-front/menu.php');

if (isset($_SESSION['order'])) {
    echo $_SESSION['order'];
    unset($_SESSION['order']);
}


// If the user clicked the add to cart button on the product page we can check for the form data
if (isset($_POST['addToCart'])) {
    unset($_POST['addToCart']);
    // So refresh will not add another quantity
    // Set the post variables so we easily identify them
    $cart_food_id = $_POST['id'];
    $qty = $_POST['qty'];
    // Create/update the session variable for the cart
    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        if (isset($_SESSION['cart'][$cart_food_id])) {
            // Product exists in cart so just update the quanity
            $_SESSION['cart'][$cart_food_id] += $qty;
        } else {
            // Product is not in cart so add it
            $_SESSION['cart'][$cart_food_id] = $qty;
        }
    } else {
        // There are no products in cart, this will add the first product to cart
        $_SESSION['cart'] = array($cart_food_id => $qty);
    }
}

// Remove product from cart, check for the URL param "remove", this is the product id, make sure it's a number and check if it's in the cart
if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
    // Remove the product from the shopping cart
    unset($_SESSION['cart'][$_GET['remove']]);
}
//CHeck whether submit button is clicked or not
if (isset($_POST['submit'])) {

    // Calculate the number of items in the cart
    $itemCount = count($_SESSION['cart']);

    // Calculate discount based on item count
    if ($itemCount >= 5 && $itemCount <= 10) {
        $discountPercent = 5; // 5% discount for 5-10 items
    } elseif ($itemCount > 10) {
        $discountPercent = 15; // 15% discount for more than 10 items
    } else {
        $discountPercent = 0; // No discount
    }

    // Calculate discount amount
    $discountAmount = ($subtotal * $discountPercent) / 100;

    // Apply free postage if the total price is larger than RM100
    if ($subtotal > 100) {
        $fee = 0; // Free postage
    } else {
        $fee = 10; // RM10 postage fee
    }

    // Get all the details from the form
    $foods = "";
    $subtotal = $_POST['total'];
    // $fee = $_POST['fee'];
    $total = $subtotal + $fee - $discountAmount;
    foreach (array_keys($_SESSION['cart']) as $j) {
        if (is_numeric($j)) {
            //Get the DEtails of the SElected Food
            $sql = "SELECT * FROM food WHERE id=$j";
            //Execute the Query
            $res = mysqli_query($conn, $sql);
            //Count the rows
            $count = mysqli_num_rows($res);
            //CHeck whether the data is available or not
            if ($count == 1) {
                //WE Have DAta
                //GEt the Data from Database
                $row = mysqli_fetch_assoc($res);
                $foods = $foods . "<br>" . $row['title'] . " (RM" . $row['price'] . " x " . $_POST[$j] . " = RM" . number_format((float) ($_POST[$j] * $row['price']), 2, '.', '') . ")";
                //$price = $row['price'];
            }
        }
    }

    // Add Subtotal + Total to receipt
    $foods = $foods . "<br><br>Subtotal: RM" . number_format((float) $subtotal, 2, '.', '') . "<br>Delivery fee: RM" . number_format((float) $fee, 2, '.', '') . "<br>Total: RM" . number_format((float) $total, 2, '.', '');

    $order_date = date("Y-m-d h:i:sa"); //Order DAte
    $status = "Ordered";  // Ordered, On Delivery, Delivered, Cancelled
    $remark = $_POST['remark'];
    $payment = $_POST['payment'];
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];
    // if ($fee == 10) {
    //     $delivery = 1;
    // } else {
    //     $delivery = 0;
    // }



    //Save the Order in Databaase
    //Create SQL to save the data
    $sql2 = "INSERT INTO orders SET
                        id = NULL,
                        food = '$foods',
                        total = $total,
                        remark = '$remark',
                        payment = '$payment',
                        delivery = '$delivery',
                        order_date = '$order_date',
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

    //echo $sql2; die();

    //Execute the Query
    $res2 = mysqli_query($conn, $sql2);
    $order_id = mysqli_insert_id($conn);
    //Check whether query executed successfully or not
    if ($res2 == true) {
        //Clear session
        unset($_SESSION['cart']);
        //Query Executed and Order Saved
        $_SESSION['order'] = "<div class='success text-center'>Food Ordered Successfully. Your tracking number is $order_id. <button id='pdfButton'><b>Click here to print receipt</b></button></div><div id='generatePDF'><fieldset style='max-width:600px;margin: auto;'><h4 style='text-align:center'>PAYMENT RECEIPT⠀⠀⠀⠀⠀⠀⠀⠀Auntie Jue's Home Bakes</h4> 
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
    } else {
        //Failed to Save Order
        $_SESSION['order'] = "<div class='error text-center'>Failed to Order Food.</div>";
    }
    echo '<script>location.reload(true);</script>';
} ?>
<div class="w3-container w3-padding-32 w3-light-gray">

    <h2 class="text-center text-black">Cart and Confirmation</h2>
    <?php if (isset($_SESSION['cart'])): ?>
        <form name="orderCart" action="" method="POST">

            <div class="w3-row-padding " style="max-width:1200px;margin: auto;">
                <div class="w3-half w3-hover-opacity">
                    <div id="t9">
                        <h3>Selected Foods</h3>
                        <?php

                        $total = (float) 0;
                        $highestID = 0;
                        foreach (array_keys($_SESSION['cart']) as $i) {
                            // find highest ID
                            if ($i > $highestID) {
                                $highestID = $i;
                            }
                            if (is_numeric($i)) {
                                //Get the DEtails of the SElected Food
                                $sql = "SELECT * FROM food WHERE id=$i";
                                //Execute the Query
                                $res = mysqli_query($conn, $sql);
                                //Count the rows
                                $count = mysqli_num_rows($res);
                                //CHeck whether the data is available or not
                                if ($count == 1) {
                                    //WE Have DAta
                                    //GEt the Data from Database
                                    $row = mysqli_fetch_assoc($res);

                                    $title = $row['title'];
                                    $price = $row['price'];
                                    $image_name = $row['image_name'];
                                    $total = $total + ($price * $_SESSION['cart'][$i]);
                                }

                                echo '<div class="food-menu2-img">';

                                echo '<img src="' . SITEURL . 'images/food/' . $image_name . '" alt="Chicke Hawain Pizza" class="img-responsive img-curve">';

                                echo '</div>

                <div class="food-menu2-desc">
                    <h3>' . $title . '</h3>
                    <p class="food-price" id="price' . $i . '">' . $price . '</p>
                    <div class="order-label">Quantity</div>
                    <input type="hidden" value="' . $_SESSION['cart'][$i] . '" name="qty' . $i . '">
                    <input type="number" name="' . $i . '" class="input-responsive" value="' . $_SESSION['cart'][$i] . '" min="1" onchange="price()" id="' . $i . '" required>
                    <a href="cart.php?remove=' . $i . '" class="w3-text-red">Remove</a>              
                </div>
                <div class="clearfix"></div>';
                            }
                        }
                        echo '<input type="hidden" value="' . $total . '"  name="total">
                <input type="hidden" value="' . $highestID . '" name="highestID">
                <p class="food-price" id="totalDisplay">Cart total: RM' . number_format((float) $total, 2, '.', '') . '</p></div></div>';
                        ?>


                        <div class="w3-half w3-hover-opacity">
                            <div id="t10">
                                <h3>Delivery Details</h3>
                                <?php
                                if (isset($_SESSION['username'])) {

                                    //Get the DEtails of the SElected Food
                                    $sql = "SELECT * FROM customers WHERE username = '" . $_SESSION['username'] . "'";
                                    //Execute the Query
                                    $res = mysqli_query($conn, $sql);
                                    //Count the rows
                                    $count = mysqli_num_rows($res);
                                    //CHeck whether the data is available or not
                                    if ($count == 1) {
                                        //WE Have DAta
                                        //GEt the Data from Database
                                        $row = mysqli_fetch_assoc($res);

                                        $full_name = $row['full_name'];
                                        $contact_no = $row['contact_no'];
                                        $address = $row['address'];
                                        $email = $row['email'];
                                    }



                                    echo '
                             
                <div class="order-label">Remark</div>
                <input type="text" name="remark" placeholder="E.g. Use blue cream for decoration" class="input-responsive">

                <div class="order-label">Full Name</div>
                <input type="text" name="full-name" value="' . $full_name . '" placeholder="E.g. Ali bin Musa" class="input-responsive" required>

                <div class="order-label">Phone Number</div>
                <input type="tel" name="contact" value="' . $contact_no . '" placeholder="E.g. 0123456789" class="input-responsive" required>

                <div class="order-label">Email</div>
                <input type="email" name="email" value="' . $email . '" placeholder="E.g. ali@example.com" class="input-responsive" required>

                <div class="order-label">Address</div>
                <textarea name="address" rows="10" placeholder="E.g. Street, City, State" class="input-responsive" required>' . $address . '</textarea>

                <div class="order-label">Payment method</div>
                <select name="payment" id="payment" class="input-responsive w3-border" required>
                    <option value=""></option>
                    <option value="Cash" onclick="hideCardForm();">Cash</option>
                    <option value="Card" onclick="showCardForm();">Credit Card / Debit Card</option>
                </select> 
                
                <div id="card" style="display:none">
                <div class="order-label">Billing Address</div>
                <textarea rows="10" placeholder="E.g. Street, City, State" class="input-responsive" >' . $address . '</textarea>
                
                <div class="order-label">Full Name on Card</div>
                <input type="text" value="' . $full_name . '" placeholder="E.g. Ali bin Musa" class="input-responsive" >

                <div class="order-label">Card Number</div>
                <input type="text" class="input-responsive" >

                <div class="order-label">3 Digit Security Code</div>
                <input type="text" class="input-responsive" >

                <div class="order-label">Expiration Date</div>
                <input type="date" class="input-responsive" >

                <div class="input-responsive">
                <input type="radio" id="age1" name="age" value="30">
                <label for="age1">Visa</label><br>
                <input type="radio" id="age2" name="age" value="60">
                <label for="age2">Mastercard</label><br>
                </div>
              
                </div>

                <div class="order-label ">Collection method </div>
                <select name="fee" id="fee" class="input-responsive w3-border" required>
                    <option value=""></option>
                    <option value="10">Delivery (Delivery fee: +RM10)</option>
                    <option value="0">Self-Collect (+RM0)</option>
                </select> 

                <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                ';
                                } else {
                                    echo "<p>You are not logged in. <a class='w3-text-green' href='login.php'>Login Here</a></p>";
                                } ?>
                            <?php else: ?>
                                <fieldset>Your cart is empty. Please start adding foods to your cart.</fieldset>
                            <?php endif; ?>
                            <script>
                                if (window.history.replaceState) {
                                    window.history.replaceState(null, null, window.location.href);
                                }

                                function price() {
                                    console.log('Price function called');

                                    var total = 0;

                                    try {
                                        var highestID = parseFloat(document.getElementsByName("highestID")[0].value);
                                        console.log('highestID:', highestID);
                                    } catch (error) {
                                        console.error(error);
                                        return;
                                    }

                                    for (let i = 0; i <= highestID; i++) {
                                        console.log('i:', i);
                                        var qtyElement = document.querySelector(`[name="${i}"]`);
                                        if (!qtyElement) {
                                            continue;
                                        }
                                        var qty = parseFloat(document.getElementById(i).value);
                                        var price = parseFloat(document.getElementById("price" + i).innerHTML);

                                        console.log('qty:', qty);
                                        console.log('price:', price);

                                        if (!qty || !price) {
                                            continue;
                                        }

                                        total = total + (qty * price);
                                        console.log('qty:', qty);
                                        console.log('price:', price);

                                    }

                                    document.getElementsByName("total")[0].value = parseFloat(total);
                                    document.getElementById("totalDisplay").innerText = "Cart total: RM" + total.toFixed(2);
                                }

                                function showCardForm() {
                                    document.getElementById('card').style.display = "";
                                }

                                function hideCardForm() {
                                    document.getElementById('card').style.display = "none";
                                }
                            </script>
                        </div>
                    </div>
                </div>

    </form>
</div>

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