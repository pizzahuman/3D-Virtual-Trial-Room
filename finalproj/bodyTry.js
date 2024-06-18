const video = document.getElementById('webcam');
const liveView = document.getElementById('liveView');
const demosSection = document.getElementById('demos');
const loaderContainer = document.getElementById('loader-container');

// An object to configure parameters to set for the bodypix model.
const bodyPixProperties = {
  architecture: 'MobileNetV1',
  outputStride: 16,
  multiplier: 0.75,
  quantBytes: 4
};

// An object to configure parameters for detection. 
const segmentationProperties = {
  flipHorizontal: true,
  internalResolution: 'high',
  segmentationThreshold: 0.9
};

// This array will hold the colours we wish to use to highlight different body parts we find.
const colourMap = [
  {r: 244, g: 67, b: 54, a: 0}, // Left_face
  {r: 183, g: 28, b: 28, a: 0}, // Right_face
  {r: 0, g: 0, b: 0, a: 255}, // left_upper_arm_front
  {r: 0, g: 0, b: 0, a: 255}, // left_upper_arm_back
  {r: 0, g: 0, b: 0, a: 255}, // right_upper_arm_front
  {r: 0, g: 0, b: 0, a: 255}, // right_upper_arm_back
  {r: 0, g: 0, b: 0, a: 255}, // left_lower_arm_front
  {r: 0, g: 0, b: 0, a: 255}, // left_lower_arm_back
  {r: 0, g: 0, b: 0, a: 255}, // right_lower_arm_front
  {r: 0, g: 0, b: 0, a: 255}, // right_lower_arm_back
  {r: 156, g: 39, b: 176, a: 0}, // left_hand
  {r: 156, g: 39, b: 176, a: 0}, // right_hand
  {r: 0, g: 0, b: 0, a: 255}, // torso_front
  {r: 0, g: 0, b: 0, a: 255}, // torso_back
  {r: 33, g: 150, b: 243, a: 0}, // left_upper_leg_front
  {r: 13, g: 71, b: 161, a: 0}, // left_upper_leg_back
  {r: 33, g: 150, b: 243, a: 0}, // right_upper_leg_front
  {r: 13, g: 71, b: 161, a: 0}, // right_upper_leg_back
  {r: 0, g: 188, b: 212, a: 0}, // left_lower_leg_front
  {r: 0, g: 96, b: 100, a: 0}, // left_lower_leg_back
  {r: 0, g: 188, b: 212, a: 0}, // right_lower_leg_front
  {r: 0, g: 96, b: 100, a: 0}, // right_lower_leg_back
  {r: 255, g: 193, b: 7, a: 0}, // left_feet
  {r: 255, g: 193, b: 7, a: 0} // right_feet
];

// A function to render returned segmentation data to a given canvas context.
function processSegmentation(canvas, segmentation) {
  const ctx = canvas.getContext('2d', { willReadFrequently: true });
  const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
  const data = imageData.data;
  
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

// load the model with our parameters defined above.
let modelHasLoaded = false;
let model = undefined;
document.getElementById("loader-container").style.display = "flex";
model = bodyPix.load(bodyPixProperties).then(function (loadedModel) {
  model = loadedModel;
  modelHasLoaded = true;
  // Show demos section when model is loaded.
  demosSection.classList.remove('invisible');

  // Show loader until model is fully loaded.
  loaderContainer.style.display = 'flex';

  enableCam();
});

document.getElementById("loader-container").style.display = "none";
let previousSegmentationComplete = true;

// Check if webcam access is supported.
function hasGetUserMedia() {
  return !!(navigator.mediaDevices && navigator.mediaDevices.getUserMedia);
}

// This function will repeatedly call itself when the browser is ready to process the next frame from the webcam.
function predictWebcam() {
  if (previousSegmentationComplete) {
    // Copy the video frame from webcam to a temporary canvas in memory only (not in the DOM).
    videoRenderCanvasCtx.drawImage(video, 0, 0);
    previousSegmentationComplete = false;
    model.segmentPersonParts(videoRenderCanvas, segmentationProperties).then(function(segmentation) {
      processSegmentation(webcamCanvas, segmentation);
      previousSegmentationComplete = true;
    });
  }
  // Call this function again to keep predicting when the browser is ready.
  window.requestAnimationFrame(predictWebcam);
}

// Enable the live webcam view and start classification.
function enableCam() {
  if (!modelHasLoaded) {
    return;
  }
  
  // getUsermedia parameters.
  const constraints = {
    video: true
  };

  // Activate the webcam stream.
  navigator.mediaDevices.getUserMedia(constraints).then(function(stream) {
    video.addEventListener('loadedmetadata', function() {
      // Update widths and heights once video is successfully played otherwise it will have width and height of zero initially causing classification to fail.
      webcamCanvas.width = video.videoWidth;
      webcamCanvas.height = video.videoHeight;
      videoRenderCanvas.width = video.videoWidth;
      videoRenderCanvas.height = video.videoHeight;
    });
    
    video.srcObject = stream;
    video.addEventListener('loadeddata', predictWebcam);
    
    // Hide loader once webcam starts.
    loaderContainer.style.display = 'none';
  });
}

// Create a canvas to render our findings to the DOM.
const webcamCanvas = document.createElement('canvas');
webcamCanvas.setAttribute('class', 'overlay');
liveView.appendChild(webcamCanvas);

// Create a temporary canvas to render to that is in memory only to store frames from the webcam stream for classification.
const videoRenderCanvas = document.createElement('canvas');
const videoRenderCanvasCtx = videoRenderCanvas.getContext('2d');

// If webcam supported, enable the camera directly.
if (hasGetUserMedia()) {
  window.addEventListener('load', enableCam);
} else {
  console.warn('getUserMedia() is not supported by your browser');
}
