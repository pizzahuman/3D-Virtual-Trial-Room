<?php
session_start();
include("connection.php");
include("functions.php");

$user_data = check_login($conn);


?>

<head>
    <title>Blaryn- Cart</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="stylecart.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>



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
  <div >
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



<div class="shopping-cart">
    <!-- Title -->
    <div class="title">
        Shopping Bag
    </div>

    <!-- Product #1 -->
    <div class="item">
        <div class="buttons">
            <span class="delete-btn"></span>
            <span class="like-btn" >
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

        <div class="total-price">$549</div>
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

        <div class="total-price">$870</div>
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
            <img src ="pic/Trouser1(women).jpg" style="    width: 59;" />
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

        <div class="total-price">$349</div>
        <div class="buttons">
            <span class="delete-btn">X</span>
           
        </div>

        
    </div>



</div>
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