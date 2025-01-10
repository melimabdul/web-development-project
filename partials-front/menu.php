<?php include('config/constants.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- Important to make website responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Baker's Cottage</title>

  <!-- Link our CSS file -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/w3edit.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
  <style>
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a {
      font-family: "Karma", sans-serif;
      text-decoration: none
    }

    .w3-bar-block .w3-bar-item {
      padding: 20px
    }
  </style>

</head>

<body>
  <!-- Navbar Section Starts Here
  <div class="w3-top" style="background: rgba(255, 255, 255, 0.3);">

    <div class="w3-bar  w3-xlarge w3-center" style="max-width:1000px;margin:auto;">
      <a href="<?php echo SITEURL; ?>" class="w3-bar-item w3-button w3-padding-large ">Home</a>
      <a href="<?php echo SITEURL; ?>track.php" class="w3-bar-item w3-button w3-padding-large ">Track My Order</a>
      <a href="<?php echo SITEURL; ?>foods.php" class="w3-bar-item w3-button w3-padding-large ">Foods</a>
      <?php if (!isset($_SESSION["username"])) : ?>
        <a href="<?php echo SITEURL; ?>login.php" class="w3-bar-item w3-button w3-right w3-padding-large">Log In</a>
      <?php else : ?>
        <a href="<?php echo SITEURL; ?>logout.php" class="w3-bar-item w3-button w3-right w3-padding-large">Logout</a>
      <?php endif; ?>

      <a href="<?php echo SITEURL; ?>cart.php" class="w3-bar-item w3-button w3-right w3-padding-large">Cart</a>
      <div class="w3-dropdown-hover ">
        <a href="<?php echo SITEURL; ?>categories.php" class="w3-button w3-padding-large ">Categories</a>
        <div class="w3-dropdown-content w3-bar-block w3-card-4">
          <a href=" category-foods.php?category_id=1" class="w3-bar-item w3-button">Cakes</a>
          <a href=" category-foods.php?category_id=2" class="w3-bar-item w3-button">Cupcakes</a>
          <a href=" category-foods.php?category_id=3" class="w3-bar-item w3-button">Cookies</a>
          <a href=" category-foods.php?category_id=4" class="w3-bar-item w3-button">Pastries</a>
          <a href=" category-foods.php?category_id=5" class="w3-bar-item w3-button">Breads</a>
        </div>
      </div>

    </div>

  </div>
  <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:50px">
    <h1 class=" w3-center w3-padding-16">Baker's Cottage</h1>
    <hr> -->

  <header class="navbar">
    <div class="navbar-container">
      <a href="<?php echo SITEURL; ?>" class="navbar-logo">Baker's Cottage</a>
      <nav class="navbar-menu">
        <ul class="navbar-items">
          <li class="navbar-item">
            <a href="<?php echo SITEURL; ?>" class="navbar-link">Home</a>
          </li>
          <li class="navbar-item">
            <a href="<?php echo SITEURL; ?>track.php" class="navbar-link">Track My Order</a>
          </li>
          <li class="navbar-item">
            <a href="<?php echo SITEURL; ?>foods.php" class="navbar-link">Foods</a>
          </li>
          <li class="navbar-item">
            <a href="<?php echo SITEURL; ?>cart.php" class="navbar-link">Cart</a>
          </li>
          <li class="navbar-item dropdown">
            <a href="<?php echo SITEURL; ?>categories.php" class="navbar-link">Categories</a>
            <ul class="dropdown-menu">
              <li class="dropdown-item">
                <a href="category-foods.php?category_id=1" class="navbar-link">Cakes</a>
              </li>
              <li class="dropdown-item">
                <a href="category-foods.php?category_id=2" class="navbar-link">Cupcakes</a>
              </li>
              <li class="dropdown-item">
                <a href="category-foods.php?category_id=3" class="navbar-link">Cookies</a>
              </li>
              <li class="dropdown-item">
                <a href="category-foods.php?category_id=4" class="navbar-link">Pastries</a>
              </li>
              <li class="dropdown-item">
                <a href="category-foods.php?category_id=5" class="navbar-link">Breads</a>
              </li>
            </ul>
          </li>
          <?php if (!isset($_SESSION["username"])) : ?>
            <li class="navbar-item">
              <a href="<?php echo SITEURL; ?>login.php" class="navbar-link">Log In</a>
            </li>
          <?php else : ?>
            <li class="navbar-item">
              <a href="<?php echo SITEURL; ?>orders.php" class="navbar-link">Orders</a>
            </li>
            <li class="navbar-item">
              <a href="<?php echo SITEURL; ?>logout.php" class="navbar-link">Logout</a>
            </li>
          <?php endif; ?>
        </ul>
      </nav>
    </div>
  </header>
  <br><br><br><br><br>


  <!-- Navbar Section Ends Here -->