<?php
session_start();
include 'connection.php';

if (isset($_GET['pid'])) {
  $product_id = $_GET['pid'];
}
;

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Blaryn Cosmetic's Category</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="style.css">
  <script src="https://unpkg.com/@tensorflow/tfjs-core@2.1.0/dist/tf-core.js"></script>
  <script src="https://unpkg.com/@tensorflow/tfjs-converter@2.1.0/dist/tf-converter.js"></script>
  <script src="https://unpkg.com/@tensorflow/tfjs-backend-webgl@2.1.0/dist/tf-backend-webgl.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/facemesh"></script>

  <script type="module" src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script>

  <script src="threejs-ex.js"></script>
  <script src="triangulation.js"></script>
  <script src="uv-coords.js"></script>

  <?php

  $select_filter = mysqli_query($conn, "SELECT * FROM `filters` WHERE product_id='" . $product_id . "'");
  if (mysqli_num_rows($select_filter) > 0) {
    while ($fetch_product = mysqli_fetch_assoc($select_filter)) {

      ?>


      <script type="text/javascript">

        var video;
        var model;
        var faceMesh;

        window.onload = function () {
          let fileData = '<?php echo $fetch_product['filter_link']; ?>';
          startWebcam(fileData);
          let textureLoader = new THREE.TextureLoader();
          textureLoader.load(fileData, function (tex) {
            faceMesh.material.map = tex;
          });
        };
        <?php
    }
  } ?>
    function startWebcam(imageFile) {
      let constraints = { video: { width: 640, height: 480 } };

      navigator.mediaDevices.getUserMedia(constraints).then(
        function (mediaStream) {
          video = document.getElementById("video");
          video.srcObject = mediaStream;
          video.onloadedmetadata = function (e) {
            video.play();
            InitRendering();
            CreateFaceObject(imageFile);
            StartTracking();
          };
        }
      );
    }



    function CreateFaceObject(imageFileToLoad) {

      let geometry = new THREE.Geometry();

      for (let i = 0; i < 468; i++) {
        geometry.vertices.push(new THREE.Vector3(0, 0, 0));
      }

      let index, p0, p1, p2;
      for (let i = 0; i < TRIANGULATION.length / 3; i++) {
        index = i * 3;
        p0 = TRIANGULATION[index];
        p1 = TRIANGULATION[index + 1];
        p2 = TRIANGULATION[index + 2];
        geometry.faces.push(new THREE.Face3(p0, p1, p2));

        geometry.faceVertexUvs[0].push([
          new THREE.Vector2(UV_COORDS[p0][0], 1 - UV_COORDS[p0][1]),
          new THREE.Vector2(UV_COORDS[p1][0], 1 - UV_COORDS[p1][1]),
          new THREE.Vector2(UV_COORDS[p2][0], 1 - UV_COORDS[p2][1])]);
      }
      let texture = new THREE.TextureLoader().load(imageFileToLoad);

      let material = new THREE.MeshBasicMaterial({ map: texture, alphaTest: 0.1 });

      faceMesh = new THREE.Mesh(geometry, material);


      AddToThreejs(faceMesh);
    }


    function InitRendering() {

      let videoWidth = video.videoWidth;
      let videoHeight = video.videoHeight;
      video.width = videoWidth;
      video.height = videoHeight;

      let canvas = document.getElementById("output");
      canvas.width = videoWidth;
      canvas.height = videoHeight;

      InitThreejs(canvas);
    }


    async function StartTracking() {

      model = await facemesh.load();

      FaceTrackingLoop();
    }


    async function FaceTrackingLoop() {
      let predictions = await model.estimateFaces(video);
      if (predictions.length > 0) {

        let keypoints = predictions[0].scaledMesh;

        let geometry = faceMesh.geometry;
        for (let i = 0; i < keypoints.length; i++) {
          let x = keypoints[i][0];
          let y = keypoints[i][1];
          geometry.vertices[i].set(x - video.width / 2, -y + video.height / 2, 1);
        }

        faceMesh.geometry.verticesNeedUpdate = true;
      }
      RenderThreejs();
      requestAnimationFrame(FaceTrackingLoop);
    }
  </script>

</head>

<body>
  <div>
    <!---------- Logo and Search Panel HTML Code Starts --------->
    <div class="width-100 search-panel">
      <div class="container1">
        <div class="width-20">
          <a href="index.php"><img src="pic/logo.jpg" style="height: 50px; "></a>
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
  <div>

    <main class="container">
      <!-- <input type="file" id="file"><br> -->
      <video id="video" style="position: absolute;"></video>
      <canvas id="output" style=" position: absolute; "></canvas>

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