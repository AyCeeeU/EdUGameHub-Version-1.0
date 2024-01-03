var englishCanvas = document.getElementById("englishCanvas");
var englishCtx = englishCanvas.getContext("2d");
var englishImage = new Image();
englishImage.crossOrigin = "anonymous";
englishImage.src = "../Certificate.png";
englishImage.onload = function () {
  drawEnglishImage();
};

function drawEnglishImage() {
  englishCtx.clearRect(0, 0, englishCanvas.width, englishCanvas.height);
  englishCtx.drawImage(englishImage, 0, 0, englishCanvas.width, englishCanvas.height);

  // Font style and size for name input
  englishCtx.font = "30px times new roman";
  englishCtx.fillStyle = "black";

  // Calculate the width of the text

  var textWidth = englishCtx.measureText(fullStudentName).width;

  // Calculate the starting position to center the text
  var startX = (englishCanvas.width - textWidth) / 2;

  // Draw the text at the calculated position

  englishCtx.fillText(fullStudentName, startX, 195);

  // Font style and size for quarter input
  englishCtx.font = "13px Arial";
  englishCtx.fillStyle = "black";
  englishCtx.fillText(" " + "English", 245, 226);
}
drawEnglishImage();



// Define canvas and context
var mathCanvas = document.getElementById("mathCanvas");
var mathCtx = mathCanvas.getContext("2d");

// Create image object
var mathImage = new Image();
mathImage.crossOrigin = "anonymous";
mathImage.src = "../Certificate.png";

// Set onload function for image
mathImage.onload = function () {
  drawMathImage();
};

// Function to draw the image
function drawMathImage() {
  // Clear the canvas
  mathCtx.clearRect(0, 0, mathCanvas.width, mathCanvas.height);

  // Draw the image on the canvas
  mathCtx.drawImage(mathImage, 0, 0, mathCanvas.width, mathCanvas.height);

  // Font style and size for name input
  mathCtx.font = "30px times new roman";
  mathCtx.fillStyle = "black";

  // Calculate the width of the text
  var textWidth = mathCtx.measureText(fullStudentName).width;

  // Calculate the starting position to center the text
  var startX = (mathCanvas.width - textWidth) / 2;

  // Draw the text at the calculated position
  mathCtx.fillText(fullStudentName, startX, 195);

  // Font style and size for quarter input
  mathCtx.font = "13px Arial";
  mathCtx.fillStyle = "black";
  mathCtx.fillText(" " + "Math", 245, 226);
}

// Call the draw function
drawMathImage();


// Define canvas and context
var scienceCanvas = document.getElementById("scienceCanvas");
var scienceCtx = scienceCanvas.getContext("2d");

// Create image object
var scienceImage = new Image();
scienceImage.crossOrigin = "anonymous";
scienceImage.src = "../Certificate.png";

// Set onload function for image
scienceImage.onload = function () {
  drawScienceImage();
};

// Function to draw the image
function drawScienceImage() {
  // Clear the canvas
  scienceCtx.clearRect(0, 0, scienceCanvas.width, scienceCanvas.height);

  // Draw the image on the canvas
  scienceCtx.drawImage(scienceImage, 0, 0, scienceCanvas.width, scienceCanvas.height);

  // Font style and size for name input
  scienceCtx.font = "30px times new roman";
  scienceCtx.fillStyle = "black";

  // Calculate the width of the text
  var textWidth = scienceCtx.measureText(fullStudentName).width;

  // Calculate the starting position to center the text
  var startX = (scienceCanvas.width - textWidth) / 2;

  // Draw the text at the calculated position
  scienceCtx.fillText(fullStudentName, startX, 195);

  // Font style and size for quarter input
  scienceCtx.font = "13px Arial";
  scienceCtx.fillStyle = "black";
  scienceCtx.fillText(" " + "Science", 245, 226);
}

// Call the draw function
drawScienceImage();


// Define canvas and context
var overallCanvas = document.getElementById("overallCanvas");
var overallCtx = overallCanvas.getContext("2d");

// Create image object
var overallImage = new Image();
overallImage.crossOrigin = "anonymous";
overallImage.src = "../Certificate.png";

// Set onload function for image
overallImage.onload = function () {
  drawOverallImage();
};

// Function to draw the image
function drawOverallImage() {
  // Clear the canvas
  overallCtx.clearRect(0, 0, overallCanvas.width, overallCanvas.height);

  // Draw the image on the canvas
  overallCtx.drawImage(overallImage, 0, 0, overallCanvas.width, overallCanvas.height);

  // Font style and size for name input
  overallCtx.font = "30px times new roman";
  overallCtx.fillStyle = "black";

  // Calculate the width of the text
  var textWidth = overallCtx.measureText(fullStudentName).width;

  // Calculate the starting position to center the text
  var startX = (overallCanvas.width - textWidth) / 2;

  // Draw the text at the calculated position
  overallCtx.fillText(fullStudentName, startX, 195);

  // Font style and size for quarter input
  overallCtx.font = "13px Arial";
  overallCtx.fillStyle = "black";
  overallCtx.fillText(" " + "Overall", 245, 226);
}

// Call the draw function
drawOverallImage();



