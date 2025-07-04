<?php
session_start();
include 'connection.php';

$product_id = isset($_GET['pid']) ? $_GET['pid'] : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blaryn Try-On</title>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="bfilterstyle.css">
</head>
<body>
  <div>
    <div class="width-100 search-panel">
      <div class="container1">
        <div class="width-20">
          <a href="index.php"><img src="pic/logo.jpg" style="height: 50px;"></a>
        </div>
        <div class="width-60">
          <input class="search-textbox" type="text" placeholder="Search for products, brand and more">
          <button class="search-button">
            <i class="fa fa-search" aria-hidden="true"></i>
          </button>
        </div>
        <div class="width-20">
          <ul class="cart-sect">
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

    <div class="width-100">
      <div class="container1">
        <ul class="main-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="allProducts.php">Products</a></li>
          <li><a href="categoryProduct.php?cat=Cosmetic">Cosmetics</a></li>
          <li><a href="categoryProduct.php?cat=Accessory">Accessories</a></li>
          <li><a href="categoryProduct.php?cat=Men">Men</a></li>
          <li><a href="categoryProduct.php?cat=Women">Women</a></li>
          <li><a href="categoryProduct.php?cat=Kids">Kids</a></li>
        </ul>
      </div>
    </div>
  </div>
  
  <div class="try">
    <section id="demos" class="section invisible">
      <div id="liveView" class="webcam">
        <video id="webcam" autoplay></video>
      </div>
    </section>
    <div id="loader-container" class="loader-container" style="display: none;">
      <div id="loader" class="center"></div>
    </div>
  </div>

  <div class="width-100 margin-top-50 footer">
    <div class="container2">
      <div class="width-25">
        <h2 class="quicklink-heading">Web Detail</h2>
        <ul class="quicklink-menu">
          <li><a href="index.php">Home</a></li>
          <li><a href="AboutUs.html">About us</a></li>
        </ul>
      </div>
      <div class="width-25">
        <h2 class="quicklink-heading">Quick Link</h2>
        <ul class="quicklink-menu">
          <li><a href="login.php">Login</a></li>
          <li><a href="fandq.html">Faq</a></li>
          <li><a href="ContactUs.html">Contact us</a></li>
        </ul>
      </div>
      <div class="width-25">
        <h2 class="quicklink-heading">GET IN TOUCH</h2>
        <ul class="get-in-touch">
          <li><i class="fa fa-envelope-o" aria-hidden="true"></i> E-MAIL:<a href="#" class="footer-e-mail">info@blaryn.com</a></li>
          <li><i class="fa fa-fax" aria-hidden="true"></i> CONTACT NO.: +91 7634567890</li>
          <li><i class="fa fa-globe" aria-hidden="true"></i> WEBSITE:<a href="#" class="footer-website">https://www.Blaryn.com</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="width-100 footer2-bacbor">
    <p class="footer2-content">Copyright © 2023, Blaryn.com. All Rights Reserved</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@2.0.0/dist/tf.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/body-pix@2.0"></script>
  <script src="bodyTry.js" defer></script>
</body>
</html>
