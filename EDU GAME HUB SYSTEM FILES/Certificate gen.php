<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/students.css">

    <script>
        function openSidebar() {
            document.getElementById("sidebar").style.width = "250px";
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.width = "0";
        }
    </script>
</head>

<body>
    <div class="grid-container">

        <!-- Header -->
        <header class="header">
            <div class="menu-icon" onclick="openSidebar()">
                <span class="material-icons-outlined">menu</span>
            </div>
        </header>
        <!-- End Header>

        <!-- Sidebar -->
        <aside id="sidebar">
            <img class="logo" src="images/edugamelogo.png" alt="logo">
            <div class="sidebar-title">
                <div class="sidebar-brand">
                    <!-- Sidebar content here -->
                </div>
                <span class="material-icons-outlined" onclick="closeSidebar()">close</span>
            </div>

            <ul class="sidebar-list">
                <li class="sidebar-list-item">
                    <a href="teacher management system.php">
                        <span class="material-icons-outlined">dashboard</span> Dashboard
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="students.php">
                        <span class="material-icons-outlined">groups</span> Students
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="subjects.php">
                        <span class="material-icons-outlined">menu_book</span> Activities
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="Certificate gen.php">
                        <span class="material-icons-outlined"></span> Generate Certificate
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="Messages.html">
                        <span class="material-icons-outlined">mail</span> Messages
                    </a>
                </li>
                <li class="sidebar-list-item">
                    <a href="logout.php">
                        <span class="material-icons-outlined">logout</span> Sign Out
                    </a>
                </li>
            </ul>
        </aside>

        <div class="container">
            <h1>Certificate Generator</h1>
            <label>
                Name:
                <select id="namedropdown"></select>
            </label>
            <select id="quarter">
                <option value="English">English</option>
                <option value="Math">Math</option>
                <option value="Science">Science</option>
                <option value="Overall">Overall</option>
            </select>

            <button id="send-btn">Send</button>
            <a href="#" id="download-btn">Download</a>
            <canvas id="canvas" height="350px" width="500px"></canvas>
        </div>
        <script>
            var canvas = document.getElementById('canvas');
            var ctx = canvas.getContext('2d');
            const namedropdown1 = document.getElementById("namedropdown");
            var quarterSelect = document.getElementById('quarter');
            var downloadBtn = document.getElementById('download-btn');

            var image = new Image();
image.crossOrigin = "anonymous";
image.src = 'Certificate.png';
image.onload = function() {
    drawImage();
}

function drawImage() {
    // Determine the aspect ratio of the image
    var aspectRatio = image.width / image.height;

    // Set the maximum width and height for the canvas
    var maxWidth = 1000;
    var maxHeight = 780;

    // Calculate new dimensions while maintaining aspect ratio
    var newWidth = Math.min(image.width, maxWidth);
    var newHeight = newWidth / aspectRatio;

    // If the height exceeds the maximum, recalculate dimensions
    if (newHeight > maxHeight) {
        newHeight = maxHeight;
        newWidth = newHeight * aspectRatio;
    }

    // Set canvas size to match the scaled image
    canvas.width = newWidth;
    canvas.height = newHeight;

    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw the image on the canvas with the new dimensions
    ctx.drawImage(image, 0, 0, newWidth, newHeight);

    // Font style and size for name input
    ctx.font = '60px times new roman';
    ctx.fillStyle = 'black';

    // Calculate the width of the text
    var textWidth = ctx.measureText(namedropdown1.options[namedropdown1.selectedIndex].text).width;

    // Calculate the starting position to center the text
    var startX = (canvas.width - textWidth) / 2;

    // Draw the text at the calculated position
    ctx.fillText(namedropdown1.options[namedropdown1.selectedIndex].text, startX, newHeight * 0.55);

    // Font style and size for quarter input
    ctx.font = '40px Arial';
    ctx.fillStyle = 'black';
    ctx.fillText(' ' + quarterSelect.options[quarterSelect.selectedIndex].text, newWidth * 0.5, newHeight * 0.65);
}



            namedropdown1.addEventListener('change', function() {
                drawImage();
            });

            quarterSelect.addEventListener('change', function() {
                drawImage();
            });
            downloadBtn.addEventListener('click', function() {
                // Clone the original canvas
                var clonedCanvas = canvas.cloneNode(true);
                var clonedCtx = clonedCanvas.getContext('2d');

                // Draw the same content on the cloned canvas
                clonedCtx.clearRect(0, 0, clonedCanvas.width, clonedCanvas.height);
                clonedCtx.drawImage(image, 0, 0, clonedCanvas.width, clonedCanvas.height);
                clonedCtx.font = '60px times new roman';
                clonedCtx.fillStyle = 'black';
                var textWidth = clonedCtx.measureText(namedropdown1.options[namedropdown1.selectedIndex].text).width;
                var startX = (clonedCanvas.width - textWidth) / 2;
                clonedCtx.fillText(namedropdown1.options[namedropdown1.selectedIndex].text, startX, 380);
                clonedCtx.font = '40px Arial';
                clonedCtx.fillStyle = 'black';
                clonedCtx.fillText(' ' + quarterSelect.options[quarterSelect.selectedIndex].text, 490, 460);

                // Append the cloned canvas to the document temporarily
                document.body.appendChild(clonedCanvas);

                // Options for html2pdf
                var options = {
                    margin: 10,
                    filename: 'Certificate - ' + namedropdown1.options[namedropdown1.selectedIndex].text + '.pdf',
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    html2canvas: {
                        scale: 2
                    },
                    jsPDF: {
                        unit: 'mm',
                        format: 'a4',
                        orientation: 'landscape'
                    }
                };

                // Use html2pdf to generate a PDF
                html2pdf(clonedCanvas, options).then(function() {
                    // Remove the cloned canvas from the document after PDF generation
                    document.body.removeChild(clonedCanvas);
                });
            });
        </script>
        <script src="https://rawgit.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="fetchStudentAndSendCert.js"></script>