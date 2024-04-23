<?php
session_start();
include ("connection.php");
include ("functions.php");

$user_data = check_login($conn);


?>

<head>
    <title>Blaryn - Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="finalcart.css">

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>

<body>


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
                    <a href="categoryProduct.php?cat=Cosmetic">Cosmetics</a>
                </li>
                <li>
                    <a href="categoryProduct.php?cat=Men">Men</a>
                </li>
                <li>
                    <a href="categoryProduct.php?cat=Women">Women</a>
                </li>
                <li>
                    <a href="categoryProduct.php?cat=Kids">Kids</a>
                </li>
            </ul>
        </div>
    </div>
    <!---------- Main Menu HTML Code Ends --------->
    </div>

    <!-- cart -->
    <div class="row">
        <div class="col-md-16 col-lg-7 small-container cart-page">
            <!-- <div class="small-container cart-page"> -->
            <div class="title">
                Shopping Bag
            </div>

            <!-- Product #1 -->
            <div class="item">
                <div class="buttons">
                    <span class="delete-btn"></span>
                    <span class="like-btn">
                        <i class="fa-solid fa-heart"></i>
                    </span>
                </div>

                <div class="image">
                    <img src="pic/pure white1(women).jpg" style="    width: 59;" />
                </div>

                <div class="description">
                    <span>Women</span>
                    <span>Pure Cotton V-Neck Mini Tiered Dress</span>

                </div>

                <div class="quantity">
                    <button class="plus-btn" type="button" name="button">
                        -
                    </button>
                    <input type="text" name="name" value="1">
                    <button class="minus-btn" type="button" name="button">
                        +
                    </button>
                </div>

                <div class="total-price">Rs. 549</div>
                <div class="buttons">
                    <span class="delete-btn">X</span>

                </div>
            </div>

            <!-- Product #2 -->
            <div class="item">
                <div class="buttons">
                    <span class="delete-btn"></span>
                    <span class="like-btn">
                        <i class="fa-solid fa-heart"></i>
                    </span>
                </div>

                <div class="image">
                    <img src="pic/Hoodie1(kids).webp" style="    width: 59;" />
                </div>

                <div class="description">
                    <span>Kids</span>
                    <span>Cotton Rich Camouflage Hoodie (6-16 Yrs)</span>
                </div>

                <div class="quantity">
                    <button class="plus-btn" type="button" name="button">
                        -
                    </button>
                    <input type="text" name="name" value="1">
                    <button class="minus-btn" type="button" name="button">
                        +
                    </button>
                </div>

                <div class="total-price">Rs. 870</div>
                <div class="buttons">
                    <span class="delete-btn">X</span>

                </div>
            </div>



            <!-- Product #3 -->
            <div class="item">
                <div class="buttons">
                    <span class="delete-btn"></span>
                    <span class="like-btn">

                        <i class="fa-solid fa-heart"></i>
                    </span>


                </div>



                <div class="image">
                    <img src="pic/Trouser1(women).jpg" style="    width: 59;" />
                </div>

                <div class="description">
                    <span>Women</span>
                    <span>Pure Cotton Wide Leg Trousers</span>
                </div>

                <div class="quantity">

                    <button class="plus-btn" type="button" name="button">
                        -
                    </button>
                    <input type="text" name="name" value="1">
                    <button class="minus-btn" type="button" name="button">
                        +
                    </button>
                </div>

                <div class="total-price">Rs. 349</div>
                <div class="buttons">
                    <span class="delete-btn">X</span>

                </div>


            </div>



        </div>

        <!-- </div> -->

        <script>
            $('.like-btn').on('click', function () {
                $(this).toggleClass('is-active');
            });

            $('.minus-btn').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');


                var value = parseInt($input.val()) + 1;
                value = value < 1 ? 1 : value;


                $input.val(value);
                $input.change();
                return false;

                $input.val(value);

            });

            $('.plus-btn').on('click', function (e) {
                e.preventDefault();
                var $this = $(this);
                var $input = $this.closest('div').find('input');
                var value = parseInt($input.val()) - 1;
                value = value < 1 ? 1 : value;


                $input.val(value);
                $input.change();
                return false;

            });
        </script>

        <div class="col-md-12 col-lg-4">

            <div class="total-price1">

                <table>
                    <tr>
                        <td> Subtotal</td>
                        <td>3000</td>
                    </tr>

                    <tr>
                        <td>Dilivery Charges</td>
                        <td>100</td>
                    </tr>
                    <tr>
                        <td>Discount</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Total</td>
                        <td>3100</td>
                    </tr>
                </table>
            </div>
            </br>
            <a class="cart-button" href="payment.html">
                <button
                    style="  margin-right: 19px; height: 50px; width: 400px;color: antiquewhite; background-color: #f13f31; text-align: center;">
                    Checkout
                </button>
            </a>

        </div>

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