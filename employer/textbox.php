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

    <script>
    submitBtnTextbox.addEventListener("click", () => {
        const answer = document.getElementById("answer").value.trim();

        // Ensure the answer is not empty before proceeding
        if (answer !== "") {
        const dataToSave = {
            answer: answer, // Assign the textarea value to the answer property
        };
        console.log(dataToSave);

        saveDataToDatabase(dataToSave);
        }
    });

    function saveDataToDatabase(data) {
        const requestData = "data=" + encodeURIComponent(JSON.stringify(data));
        
        fetch("add_data.php", {
            method: "POST",
            headers: {
            "Content-Type": "application/x-www-form-urlencoded",
            },
            body: requestData,
        })
            .then((response) => response.json())
            .then((data) => {
            if (data.success) {
                console.log("Data saved successfully");
                // Optionally, you can show a success message to the user here.
            } else {
                console.error("Error adding data to the database:", data.message);
                // Optionally, you can show an error message to the user here.
            }
            })
            .catch((error) => {
            console.error("Error sending data to the server:", error);
            // Optionally, you can show a general error message to the user here.
        });
    }

    </script>
    <!-- Functionality -->
    <script src="js/script.js"></script>
    <!-- Crud -->
    <script src="js/crud.js"></script>

    <!-- Boostrap Link JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
</body>

</html>