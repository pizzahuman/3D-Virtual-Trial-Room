<?php
session_start();
include 'connection.php';

$product_id = isset($_GET['pid']) ? $_GET['pid'] : null;

// Retrieve all filter types for the given product ID
$filter_types = [];
if ($product_id) {
  $select_filter = mysqli_query($conn, "SELECT * FROM `filters` WHERE product_id='" . $product_id . "'");
  while ($fetch_product = mysqli_fetch_assoc($select_filter)) {
    $filter_types[] = $fetch_product;
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <title>Blaryn Try-On</title>
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

  <style>
    #video-container {
      transform: scaleX(-1);
    }

    .container {
      padding-left: 20%;
      padding-bottom: 0%;
      margin-bottom: 40%;
      /* padding-top: 12%; */
    }

    .loader-container {
      background-color: rgba(0, 0, 0, 0.5);
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 1;
    }

    #loader {
      border: 12px solid #f3f3f3;
      border-radius: 50%;
      border-top: 12px solid pink;
      width: 70px;
      height: 70px;
      animation: spin 1s linear infinite;
    }

    .center {
      position: absolute;
      top: 0;
      bottom: 0;
      left: 0;
      right: 0;
      margin: auto;
    }

    @keyframes spin {
      100% {
        transform: rotate(360deg);
      }
    }

    .filter-buttons {
      text-align: center;
      margin-top: 20px;
      position: absolute;
      bottom: 6px;
      margin-left: 680px;
     padding: 50px;
     padding-top: 0px;
    }

    .filter-buttons button {
      /* padding: 5px 5px; */
      margin-right: 20px;
      font-size: 12px;
      color: white;
      background-color: white;
      border: 2px solid palevioletred;
      border-radius: 70%;
      width: 60px;
      height: 52px;
    }

    .changes{
      /* margin-bottom: 3px;
       */
       padding-bottom: 3px;
    }
  </style>

</head>

<body>
  
  <div>
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
            <a href="categoryProduct.php?cat=Accessory">Accessories</a>
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
  </div>
  <div class="changes">
  <div>
    <main class="container" >
      <div id="video-container" >
        <video id="video" style="position: absolute;"></video>
        <canvas id="output" style="position: absolute;"></canvas>
      </div>

    </main>

    
    <div class="filter-buttons" id="filter-buttons" >
        
        <?php foreach ($filter_types as $filter): ?>
          <button onclick="changeFilter('<?php echo $filter['filter_link']; ?>')" style="background-color: #<?php echo $filter['filter_color']; ?>">
            <?php echo $filter['filter_name']; ?>
          </button>
        <?php endforeach; ?>
      </div>
  </div>
  <div id="loader-container" class="loader-container" style="display: none;">
    <div id="loader" class="center"></div>
  </div>
  </div>

  <div class="width-100 margin-top-50 footer" >
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
          <li><i class="fa fa-envelope-o" aria-hidden="true"></i> E-MAIL:<a href="#" class="footer-e-mail">
              info@blaryn.com</a></li>
          <li><i class="fa fa-fax" aria-hidden="true"></i> CONTACT NO.: +91 7634567890</li>
          <li><i class="fa fa-globe" aria-hidden="true"></i> WEBSITE:<a href="#" class="footer-website">
              https://www.Blaryn.com</a></li>
        </ul>
      </div>
    </div>
  </div>
  <div class="width-100 footer2-bacbor">
    <p class="footer2-content">Copyright © 2023, Blaryn.com. All Rights Reserved</p>
  </div>

  <script type="text/javascript">
    var video;
    var model;
    var faceMesh;

    window.onload = function () {
      startWebcam();
    };
    

   function startWebcam() {
      let constraints = { video: { width: 640, height: 480 } };
      
      navigator.mediaDevices.getUserMedia(constraints).then(
        function (mediaStream) {
          video = document.getElementById("video");
          video.srcObject = mediaStream;
          video.onloadedmetadata = function (e) {
            video.play();
          };
        }
      );
    }


    function InitRendering() {
      let videoWidth = video.videoWidth;
      let videoHeight = video.videoHeight;
      video.width = videoWidth;
      video.height = videoHeight;

      document.getElementById("loader-container").style.display = "flex";
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
      document.getElementById("loader-container").style.display = "none";
      RenderThreejs();
      requestAnimationFrame(FaceTrackingLoop);
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
          new THREE.Vector2(UV_COORDS[p2][0], 1 - UV_COORDS[p2][1])
        ]);
      }
      let texture = new THREE.TextureLoader().load(imageFileToLoad);
      let material = new THREE.MeshBasicMaterial({ map: texture, transparent: true, alphaTest: 0 });
      faceMesh = new THREE.Mesh(geometry, material);
      AddToThreejs(faceMesh);
    }

    function changeFilter(imageFileToLoad) {
      //startWebcam();
      
      let textureLoader = new THREE.TextureLoader();
      textureLoader.load(imageFileToLoad, function (tex) {
        faceMesh.material.map = tex;
        //faceMesh.material.needsUpdate = true;
      });
      InitRendering();
      CreateFaceObject(imageFileToLoad);
      StartTracking();

    }
  </script>

</body>

</html>
