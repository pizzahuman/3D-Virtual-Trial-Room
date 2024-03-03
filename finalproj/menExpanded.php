<?php
session_start();
include 'connection.php';

if (isset($_GET['pid'])) {
    $product_id = $_GET['pid'];
}
;

?>


<html>

<head>
    <title>Blaryn Men's Category</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="javat" href=" slidshow.js">

</head>

<body>
    <div>
        <!---------- Logo and Search Panel HTML Code Starts --------->
        <div class="width-100 search-panel">
            <div class="container1">
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
            <div class="container1">
                <ul class="main-menu">
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="allProducts.php">Products</a>
                </li>
                <li>
                    <a href="makeup.php">Cosmetics</a>
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
                </ul>
            </div>
        </div>
        <!---------- Main Menu HTML Code Ends --------->
    </div>


    <div class="int">
        <main class="container">

            <?php

            $select_men = mysqli_query($conn, "SELECT * FROM `product_men` WHERE product_id='" . $product_id . "'");
            if (mysqli_num_rows($select_men) > 0) {
                while ($fetch_product = mysqli_fetch_assoc($select_men)) {

                    ?>

            <!-- Left Column / Clothes Image -->
                    <div class="Column">


                        <div class="left-column">
                            <!-- Container for the image gallery -->
                            <div class="container3">

                                <!-- Full-width images with number text -->
                                <div class="mySlides">
                                    <div class="numbertext">1 / 6</div>
                                    <img src="<?php echo $fetch_product['product_image_1']; ?>"
                                        style="width:100%;height: 200%; ">
                                </div>

                                <div class="mySlides">
                                    <div class="numbertext">2 / 6</div>
                                    <img src="<?php echo $fetch_product['product_image_2']; ?>"
                                        style="width:100%;height: 200%;">
                                </div>


                                <!-- Next and previous buttons -->
                                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                                <!-- Image text -->
                                <div class="caption-container">
                                    <p id="caption"></p>
                                </div>

                                <!-- Thumbnail images -->
                                <div class="row">
                                    <div class="column">
                                        <img class="demo cursor" src="<?php echo $fetch_product['product_image_1']; ?>"
                                            style="width:100%; height: 35%;" onclick="currentSlide(1)">
                                    </div>
                                    <div class="column">
                                        <img class="demo cursor" src="<?php echo $fetch_product['product_image_2']; ?>"
                                            style="width:100%; height: 35%;" onclick="currentSlide(2)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <script>
                            let slideIndex = 1;
                            showSlides(slideIndex);

                            // Next/previous controls
                            function plusSlides(n) {
                                showSlides(slideIndex += n);
                            }

                            // Thumbnail image controls
                            function currentSlide(n) {
                                showSlides(slideIndex = n);
                            }

                            function showSlides(n) {
                                let i;
                                let slides = document.getElementsByClassName("mySlides");
                                let dots = document.getElementsByClassName("demo");
                                let captionText = document.getElementById("caption");
                                if (n > slides.length) { slideIndex = 1 }
                                if (n < 1) { slideIndex = slides.length }
                                for (i = 0; i < slides.length; i++) {
                                    slides[i].style.display = "none";
                                }
                                for (i = 0; i < dots.length; i++) {
                                    dots[i].className = dots[i].className.replace(" active", "");
                                }
                                slides[slideIndex - 1].style.display = "block";
                                dots[slideIndex - 1].className += " active";
                                captionText.innerHTML = dots[slideIndex - 1].alt;
                            }
                        </script>








                        <!-- Right Column -->
                        <div class="right-column">

                            <!-- Product Description -->
                            <div class="product-description">
                                <span>Men</span>
                                <h1>
                                    <?php echo $fetch_product['product_name']; ?>
                                </h1>
                            </div>
                            <!-- Product Pricing -->
                            <div class="product-price">
                                <span class="product-original-price" style="font-size: medium;">Rs.
                                    <?php echo $fetch_product['product_price_original']; ?>
                                </span>
                                <span class="product-discounted-price" style="color: red;">Rs.
                                    <?php echo $fetch_product['product_price_discount']; ?>
                                </span>
                                <a href="#" class="tryon-btn">Try On!</a>
                            </div>
                            <!-- Product Configuration -->
                            <div class="product-configuration">


                                <!-- Cable Configuration -->
                                </br>
                                <div class="cable-config">
                                    <span>Size</span>

                                    <div class="cable-choose">
                                        <button>XS</button>
                                        <button>S</button>
                                        <button>M</button>
                                        <button>L</button>
                                        <button>XL</button>
                                        <button>XLL</button>

                                    </div>




                                </div>


                                <a href="cart.php" class="cart-btn" style="width: 82%;text-align: center;">Add to cart</a></br>
                            </div>

                            <div>
                                </br>

                                <!--product descpition -->
                                <meta name="viewport" content="width=device-width, initial-scale=1">


                                <button class="accordion">Description</button>
                                <div class="panel">
                                    <p>
                                        <?php echo $fetch_product['description']; ?>
                                    </p>
                                </div>

                                <button class="accordion">Details and Care</button>
                                <div class="panel">
                                    <p>
                                        Style:
                                        <?php echo $fetch_product['style']; ?></br>
                                        Composition:
                                        <?php echo $fetch_product['composition']; ?></br>
                                        More Details:
                                        <?php echo $fetch_product['address_detail']; ?></br>
                                        Generic Type:
                                        <?php echo $fetch_product['generic_type']; ?></br>
                                        Pack Size:
                                        <?php echo $fetch_product['pack_size']; ?></br>
                                        Net Quantity: NA<br />
                                        MRP: Inclusive of all taxes</br>
                                    </p>
                                </div>


                                <script>
                                    var acc = document.getElementsByClassName("accordion");
                                    var i;

                                    for (i = 0; i < acc.length; i++) {
                                        acc[i].addEventListener("click", function () {
                                            this.classList.toggle("active");
                                            var panel = this.nextElementSibling;
                                            if (panel.style.maxHeight) {
                                                panel.style.maxHeight = null;
                                            } else {
                                                panel.style.maxHeight = panel.scrollHeight + "px";
                                            }
                                        });
                                    }
                                </script>
                            </div>
                        </div>
                    </div>

                    <?php
                }
                ;
            }
            ;
            ?>

        </main>


    </div>

    <div>
        <!-- Footer-Section HTML Code STARTS -->
        <div class="width-100 margin-top-50 footer">
            <div class="container2">
                <div class="width-25">
                    <h2 class="quicklink-heading">Web Detail</h2>
                    <ul class="quicklink-menu">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="AboutUs.html">About us</a></li>
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
                        <li><i class="fa fa-envelope-o" aria-hidden="true"></i> E-MAIL:<a href="#"
                                class="footer-e-mail"> info@blaryn.com</a></li>
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
    </div>
</body>

</html>