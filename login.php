<?php include('partials-front/menu.php'); ?>

<section class="food-search ">
    <div class="order">


        <?php
        // If form submitted, insert values into the database.
        if (isset($_POST['username'])) :
            // removes backslashes
            $username = stripslashes($_REQUEST['username']);
            //escapes special characters in a string
            $username = mysqli_real_escape_string($conn, $username);
            $password = stripslashes($_REQUEST['password']);
            $password = mysqli_real_escape_string($conn, $password);
            //Checking is user existing in the database or not
            $sql = "SELECT * FROM `customers` WHERE username='$username'and password='" . md5($password) . "'";
            $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $count = mysqli_num_rows($res);
            if ($count == 1) {
                $row = mysqli_fetch_assoc($res);
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $row['email'];
                // Redirect user to index.php
                $_SESSION['login'] = "<div class='success text-center'>You Logged In Successfully.</div>";
                echo "<script>alert('You Logged In Successfully.'); window.location='index.php';</script>";
                header("Location: index.php");
            } else {
                echo "<div class='form'>
            <h2 style='color: red'>Username/password is incorrect.</h2><br><br><br>
            <br> <a href='login.php'>Click here to Login</a></div>";
            }
        else : ?>
            <div>
                <h3>Log In</h3>
                <form action="" method="post" name="login">
                    <div class="order-label">Username</div>
                    <input type="text" name="username" placeholder="Username" class="input-responsive w3-border" required />

                    <div class="order-label">Password</div>
                    <input type="password" name="password" placeholder="Password" class="input-responsive w3-border" required />

                    <input name="submit" type="submit" value="Login" class="w3-button w3-round-large w3-green" />
                </form>
                <p>Not registered yet? <a class="w3-text-green" href='registration.php'>Register Here</a></p>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php include('partials-front/footer.php'); ?>