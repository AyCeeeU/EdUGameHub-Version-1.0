<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/multipleC.css">
    <title>EduGameHub</title>
</head>
<body>
  <h4 class="type">Multiple Choice</h4>
    <header>
        <a href="index.php"> <img src="Gamelogo.png" alt="Your Image" width="400"></a>
    </header>

    <div class="back-button">
        <a href="student welcome.html"><img src="back.png" alt="Back" width="60"></a>
    </div>

    <div class="quiz-container1">
    <p class="question">What is the capital of France?</p>

    </div>
    <div class="button-container">
      <!-- Add data-correct attribute to identify correct answers -->
      <button class="answer-button" data-correct="true" data-answer="A">Paris</button>
      <button class="answer-button" data-correct="false" data-answer="B">Milan</button>
      <button class="answer-button" data-correct="false" data-answer="C">Barcelona</button>
      <button class="answer-button" data-correct="false" data-answer="D">Italy</button>

      <button class="submit-button" onclick="navigateToNextPage()">Next</button>
  </div>
  <script>
    // Get all answer buttons
    const answerButtons = document.querySelectorAll('.answer-button');

    // Add click event listeners to answer buttons
    answerButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Check if the clicked button is the correct answer
            const isCorrect = button.getAttribute('data-correct') === 'true';

            // Remove the 'correct-selected' and 'wrong-selected' classes from all buttons
            answerButtons.forEach(btn => {
                btn.classList.remove('correct-selected', 'wrong-selected');
            });

            // Add the appropriate class to the clicked button
            if (isCorrect) {
                button.classList.add('correct-selected');
            } else {
                button.classList.add('wrong-selected');
            }
        });
    });

    function checkAnswer() {
        // Find the selected correct button
        const selectedCorrectButton = document.querySelector('.correct-selected');

        // Find the selected wrong button
        const selectedWrongButton = document.querySelector('.wrong-selected');

        // Change button colors based on correctness
        if (selectedCorrectButton) {
            selectedCorrectButton.style.backgroundColor = 'green';
        }
        if (selectedWrongButton) {
            selectedWrongButton.style.backgroundColor = 'red';
        }
    }

    function navigateToNextPage() {
        // Change the location to the new HTML file
        window.location.href = 'multipleC1.html';
    }


    
</script>
    </body>
    </html>