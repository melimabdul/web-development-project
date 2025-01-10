<?php include('partials-front/menu.php'); 
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
	$username = stripslashes($_REQUEST['username']);
        //escapes special characters in a string
	$username = mysqli_real_escape_string($conn,$username); 
$select = mysqli_query($conn, "SELECT * FROM customers WHERE username = '".$_POST['username']."'");
if(mysqli_num_rows($select)) {
    exit("This username already exists. Please reregister. <a class=\"w3-text-green\" href=\"registration.php\">Register Here</a>");	
}
    $email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($conn,$email);
    $select = mysqli_query($conn, "SELECT * FROM customers WHERE email = '".$_POST['email']."'");
if(mysqli_num_rows($select)) {
    exit("This email already exists. Please reregister. <a class=\"w3-text-green\" href=\"registration.php\">Register Here</a>");	
}

	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($conn,$password);
    $full_name = $_REQUEST['full_name'];
    $contact = $_REQUEST['contact'];
    $address = $_REQUEST['address'];
        $sql = "INSERT into `customers` (full_name, contact_no, address, email, username, password)
VALUES ('$full_name','$contact','$address','$email','$username', '".md5($password)."')";
        $res = mysqli_query($conn,$sql);
        if($res){
            echo "<div class='form'>
<h3>You are registered successfully.</h3>
<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="container">
<h1>Registration</h1>
<form name="registration" action="" method="post">
    <div class="order-label">Full Name</div>
    <input type="text" name="full_name" placeholder="E.g. Ali bin Musa" class="input-responsive w3-border" required>

    <div class="order-label">Phone Number</div>
    <input type="tel" name="contact" placeholder="E.g. 0123456789" class="input-responsive w3-border" required>

    <div class="order-label">Email</div>
    <input type="email" name="email" placeholder="E.g. ali@example.com" class="input-responsive w3-border" required>

    <div class="order-label">Address</div>
    <textarea name="address" rows="10" placeholder="E.g. Street, City, State" class="input-responsive w3-border" required></textarea>

    <div class="order-label">Username</div>
    <input type="text" name="username" placeholder="Username" class="input-responsive w3-border" required />

    <div class="order-label">Password</div>
    <input type="password" name="password" placeholder="Password" class="input-responsive w3-border" required />

    <input type="submit" name="submit" value="Register" class="btn btn-primary"/>
</form>
</div>
<?php } ?>
</body>
</html>