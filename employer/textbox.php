<?php
include('includes/dbconn.php');

session_start();

// Check if the session variable is not set or does not contain the necessary data
if (!isset($_SESSION['role']) || empty($_SESSION['role'])) {
  // Redirect to the login page or display an error message
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Evaluation Form</title>
    <!-- Bootstrap Link CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <!-- jQuery Ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--Alert JS-->
    <script src="js/alert.js"></script>
    <!--Alert CSS-->
    <link rel="stylesheet" href="css/alert.css">
</head>

<body>
    <!-- To be continue -->
    <div class="container">
        <div class="row">
            <div class="col-2 mb-3">
                <button onclick="logOut()" name="logOut" class="btn btn-primary">Logout</button>
            </div>
            <div class="col-12">
                <!-- Question Form -->
                <div class="quiz-container" id="quiz">
                    <div class="quiz-header">
                        <h2 id="textbox">Sample textbox question</h2>
                        <div class="form-floating">
                            <textarea class="form-control" placeholder="Leave a comment here" id="answer" name="answer" style="height: 100px"></textarea>
                            <label for="answer">Answer</label>
                        </div>
                    </div>
                    <button id="submitBtnTextbox">Submit</button>
                </div>
            </div>
        </div>


    </div>

    <!-- Functionality -->
    <script src="js/script.js"></script>
    <!-- Crud -->
    <script src="js/crud.js"></script>

    <script>
        const answerElsTextbox = document.getElementById("answer");
        // Function to handle form submission and send data to the server
        function submitAnswer() {
            var answer = $('#answer').val(); // Get the value of the answer textarea
            var data = { answer: answer }; // Create an object with the data to be sent

            // Send the data to the server using AJAX
            $.ajax({
                url: 'add_data.php', // Replace with the URL of your server-side script or API
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function(response) {
                    // Handle the response from the server if needed
                    console.log('Data saved successfully:', response);
                    answerElsTextbox.value = "";
                },
                error: function(xhr, status, error) {
                    // Handle any errors that occurred during the AJAX request
                    console.error('Error:', error);
                }
            });
        }

        let currentQuizTextbox = 0;
        const quizContainer = document.getElementById("quiz");

        // Attach a click event listener to the submit button
        $('#submitBtnTextbox').on('click', function() {
            submitAnswer();
    
            currentQuizTextbox++;

            if (currentQuizTextbox < quizDataTextbox.length) {
                loadTextbox();
            } else {
                quizContainer.innerHTML = `
                    <div class="quiz-header">
                        <h2 id="textbox">Congratulation you done in evaluation</h2>
                    </div>
                    <button onclick="window.location.replace('evaluation.php');">Okay</button>
                `;
            }
        });
    </script>
    <!-- Boostrap Link JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>