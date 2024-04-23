var scene;
var camera;
var renderer;

document.write("<script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js'></script>");

function InitThreejs(canvas){
  var width=canvas.width;
  var height=canvas.height;
  
  scene = new THREE.Scene();
  
  renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true });
  renderer.setPixelRatio(window.devicePixelRatio);
  renderer.setSize(width, height);
  renderer.setClearColor( 0x000000, 0 );
  camera = new THREE.OrthographicCamera(
    width / -2,
    width / 2,
    height / 2,
    height / -2,
    1,
    1000
  );
  camera.position.set(0, 0, 3);
  scene.add(camera);

  // var light = new THREE.AmbientLight(0xffffff, 1.0);
  // scene.add(light);
  scene.background = null;
  
 
}

function RenderThreejs(){
  renderer.render(scene, camera);
}

function AddToThreejs(obj){
  scene.add(obj);
}


/* function LoadFilter() {
  var progress = 0;

  // Update loading bar every 30 milliseconds
  var interval = setInterval(function () {
      progress += 1;
      loadingBar.style.width = progress + '%';

      if (progress >= 100) {
          clearInterval(interval);

          // Render the scene when the loading is complete
          RenderThreejs();
      }
  }, 30);
}

// Call LoadFilter function to start loading the filter
LoadFilter(); */