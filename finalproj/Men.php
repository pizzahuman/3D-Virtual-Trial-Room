<?php
session_start();
include 'connection.php';
?>
<!---------- Meta HTML Starts --------->
<html>

<head>
  <title>Blaryn Men's Category</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style1.css">
</head>

<body>
  <!---------- Meta HTML Ends --------->

  <!---------- Top Header HTML Code Starts --------->


  <!---------- Logo and Search Panel HTML Code Starts --------->
  <div class="width-100 search-panel">
    <div class="container">
      <div class="width-20">
        <a href="index.php"><img src="pic/logo.jpg" style="height: 50; "></a>
      </div>
      <div class="width-60">
        <input class="search-textbox" type="text" Placeholder="Search for products, brand and more">
        <button class="search-button">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
      </div>
      <div class="width-20">
        <ul class="cart-sect">
          <!-- <li>
            <i class="fa fa-heart-o" aria-hidden="true"></i>
            <a class="head1mr" href="#">Whislist</a>
          </li> -->
          <li>
            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
            <a href="login.php">Login & Signup</a>
          </li>
          <li>
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            <a href="cart.php">Cart</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!---------- Logo and Search Panel HTML Code Ends --------->

  <!---------- Main Menu HTML Code Starts --------->
  <div class="width-100">
    <div class="container">
      <ul class="main-menu">
        <li>
          <a href="index.php">Home</a>
        </li>
        <li>
          <a href="allProducts.php">Products</a>
        </li>
        <li>
          <a href="Men.php">Men</a>
        </li>
        <li>
          <a href="Women.php">Women</a>
        </li>
        <li>
          <a href="Kids.php">Kids</a>
        </li>
        <li>
          <a href="makeup.php">Cosmetics</a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Product-Section HTML Code STARTS -->
  <div class="width-100 margin-top-50">
    <div class="container">
      <?php

      $select_men = mysqli_query($conn, "SELECT * FROM `product_men`");
      if (mysqli_num_rows($select_men) > 0) {
        while ($fetch_product = mysqli_fetch_assoc($select_men)) {

          ?>

          <div class="width-25">
            <div class="product-section">
              <div class="product-border">
                <div class="product-img-center">
                  <a href="menExpanded.php?pid=<?php echo $fetch_product['product_id']; ?>">
                    <img class="product-img" src="<?php echo $fetch_product['product_image_1']; ?>">
                  </a>
                </div><br/>
                <div>
                  <p class="product-name">
                    <a href="#">
                      <?php echo $fetch_product['product_name']; ?>
                    </a>
                  </p>
                  <p class="product-rating">
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <i class="fa fa-star" aria-hidden="true"></i>
                    <span>(
                      <?php echo $fetch_product['rating']; ?>)
                    </span>
                  </p>
                  <p class="product-price">
                    <span class="product-discounted-price">
                      <?php echo $fetch_product['product_price_discount']; ?>
                    </span>
                    <span class="product-original-price">
                      <?php echo $fetch_product['product_price_original']; ?>
                    </span>
                    <!-- <span class="product-discount">90%OFF</span> -->
                </div>
              </div>
            </div>
          </div>

          <?php
        }
        ;
      }
      ;
      ?>



    </div>
  </div>
  <!---------- Product-Section HTML Code Ends --------->

  <!-- Footer-Section HTML Code STARTS -->
  <div class="width-100 margin-top-50 footer">
    <div class="container">
      <div class="width-25">
        <h2 class="quicklink-heading">Web Detail</h2>
        <ul class="quicklink-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="AboutUs.html">About Us</a></li>
          <!-- <li><a href="#">Search</a></li>
          <li><a href="#">Cart</a></li>
          <li><a href="#">Checkout</a></li> -->
        </ul>
      </div>
      <!-- <div class="width-25">
        <h2 class="quicklink-heading">Quick Link</h2>
        <ul class="quicklink-menu">
          <li><a href="#">My Profile</a></li>
          <li><a href="#">Change Password</a></li>
          <li><a href="#">Order History</a></li>
          <li><a href="#">My Whislist</a></li>
          <li><a href="#">My Cashback</a></li>
        </ul>
      </div> -->
      <div class="width-25">
        <h2 class="quicklink-heading">Quick Link</h2>
        <ul class="quicklink-menu">
          <li><a href="login.php">Login</a></li>
          <li><a href="fandq.html">Faq</a></li>
          <li><a href="ContactUs.html">Contact us</a></li>
          <!-- <li><a href="#">Download App</a></li>
          <li><a href="#">Refer & Earn Cashback</a></li> -->
        </ul>
      </div>
      <div class="width-25">
        <h2 class="quicklink-heading">GET IN TOUCH</h2>
        <ul class="get-in-touch">
          <li><i class="fa fa-envelope-o" aria-hidden="true"></i> E-MAIL:<a href="#" class="footer-e-mail">
              info@blaryn.com</a></li>
          <li><i class="fa fa-fax" aria-hidden="true"></i> CONTACT NO.: +91 7634567890</li>
          <li><i class="fa fa-globe" aria-hidden="true"></i> WEBSITE:<a href="#" class="footer-website">
              https://www.Blaryn.com</a></li>
        </ul>
        <!-- <ul class="social-media">
          <li><a href="#"><img src="images/icon-facebook.png"></a></li>
          <li><a href="#"><img src="images/icon-twitter.png"></a></li>
          <li><a href="#"><img src="images/icon-linkedin.png"></a></li>
          <li><a href="#"><img src="images/icon-instagram.png"></a></li>
        </ul> -->
      </div>
    </div>
  </div>
  <!---------- Footer-Section HTML Code Ends --------->
  <!-- Footer-bottom Section HTML Code STARTS -->
  <div class="width-100 footer2-bacbor">
    <p class="footer2-content">Copyright © 2023, Blaryn.com. All Rights Reserved</p>
  </div>
  <!---------- Footer-bottom Section HTML Code Ends --------->