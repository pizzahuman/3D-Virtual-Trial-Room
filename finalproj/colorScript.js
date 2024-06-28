const video = document.getElementById('webcam');
const liveView = document.getElementById('liveView');
const demosSection = document.getElementById('demos');

const bodyPixProperties = {
  architecture: 'MobileNetV1',
  outputStride: 16,
  multiplier: 0.75,
  quantBytes: 4
};

const segmentationProperties = {
  flipHorizontal: true, // Flip the segmentation to match the flipped video
  internalResolution: 'high',
  segmentationThreshold: 0.9
};

const colourMap = [];

// Left_face
colourMap.push({r: 244, g: 67, b: 54, a: 0});
// Right_face
colourMap.push({r: 183, g: 28, b: 28, a: 0});
// left_upper_arm_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_upper_arm_back  
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_upper_arm_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_upper_arm_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_lower_arm_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_lower_arm_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_lower_arm_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_lower_arm_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_hand 
colourMap.push({r: 156, g: 39, b: 176, a: 0});
// right_hand
colourMap.push({r: 156, g: 39, b: 176, a: 0});
// torso_front
colourMap.push({r: 136, g: 14, b: 79, a: 255}); 
// torso_back 
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_upper_leg_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_upper_leg_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_upper_leg_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_upper_leg_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_lower_leg_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_lower_leg_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_lower_leg_front
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// right_lower_leg_back
colourMap.push({r: 136, g: 14, b: 79, a: 255});
// left_feet
colourMap.push({r: 255, g: 193, b: 7, a: 0});
// right_feet
colourMap.push({r: 255, g: 193, b: 7, a: 0});

function updateColourMap(selectedColor) {
  const r = parseInt(selectedColor.slice(1, 3), 16);
  const g = parseInt(selectedColor.slice(3, 5), 16);
  const b = parseInt(selectedColor.slice(5, 7), 16);

  for (let i = 0; i < colourMap.length; i++) {
    if (colourMap[i].a === 255) {
      colourMap[i].r = r;
      colourMap[i].g = g;
      colourMap[i].b = b;
    }
  }
}

const colorPicker = document.getElementById('colorPicker');
colorPicker.addEventListener('input', (event) => {
  const selectedColor = event.target.value;
  updateColourMap(selectedColor);
});

function processSegmentation(canvas, segmentation) {
  const ctx = canvas.getContext('2d', { willReadFrequently: true });

  
  var imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  var data = imageData.data;
  
  let n = 0;
  for (let i = 0; i < data.length; i += 4) {
    if (segmentation.data[n] !== -1) {
      data[i] = colourMap[segmentation.data[n]].r;     // red
      data[i + 1] = colourMap[segmentation.data[n]].g; // green
      data[i + 2] = colourMap[segmentation.data[n]].b; // blue
      data[i + 3] = colourMap[segmentation.data[n]].a; // alpha
    } else {
      data[i] = 0;    
      data[i + 1] = 0;
      data[i + 2] = 0;
      data[i + 3] = 0;
    }
    n++;
  }
  
  ctx.putImageData(imageData, 0, 0);
}

var modelHasLoaded = false;
var model = undefined;

bodyPix.load(bodyPixProperties).then(function (loadedModel) {
  model = loadedModel;
  modelHasLoaded = true;
  demosSection.classList.remove('invisible');
  enableCam();
});

var previousSegmentationComplete = true;

function hasGetUserMedia() {
  return !!(navigator.mediaDevices &&
    navigator.mediaDevices.getUserMedia);
}

function predictWebcam() {
  if (previousSegmentationComplete) {
    videoRenderCanvasCtx.drawImage(video, 0, 0);
    previousSegmentationComplete = false;
    model.segmentPersonParts(videoRenderCanvas, segmentationProperties).then(function(segmentation) {
      processSegmentation(webcamCanvas, segmentation);
      previousSegmentationComplete = true;
    });
  }

  window.requestAnimationFrame(predictWebcam);
}

function enableCam() {
  if (!modelHasLoaded) {
    return;
  }

  const constraints = {
    video: true
  };


  navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
    video.addEventListener('loadedmetadata', function() {
  
      webcamCanvas.width = video.videoWidth;
      webcamCanvas.height = video.videoHeight;
      videoRenderCanvas.width = video.videoWidth;
      videoRenderCanvas.height = video.videoHeight;
    });
    
    video.srcObject = stream;
    
    video.addEventListener('loadeddata', predictWebcam);
  });
}

var webcamCanvas = document.createElement('canvas');
webcamCanvas.setAttribute('class', 'overlay');
liveView.appendChild(webcamCanvas);

var videoRenderCanvas = document.createElement('canvas');
var videoRenderCanvasCtx = videoRenderCanvas.getContext('2d');

if (hasGetUserMedia()) {
  enableCam();
} else {
  console.warn('getUserMedia() is not supported by your browser');
}
