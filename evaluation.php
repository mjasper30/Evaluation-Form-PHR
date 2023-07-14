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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- jQuery Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!--Alert JS-->
  <script src="js/alert.js"></script>
  <!--Alert CSS-->
  <link rel="stylesheet" href="css/alert.css">
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-2 mb-3">
          <button onclick="logOut()" name="logOut" class="btn btn-primary">Logout</button>
      </div>
      <div class="col-12">
        <!-- Question Form -->
        <div class="quiz-container" id="quiz">
          <div class="quiz-header">
            <h2 id="question">Question text</h2>
            <ul>
              <li>
                <input type="radio" name="answer" id="a" class="answer">
                <label for="a" id="a_text">Question</label>
              </li>

              <li>
                <input type="radio" name="answer" id="b" class="answer">
                <label for="b" id="b_text">Question</label>
              </li>

              <li>
                <input type="radio" name="answer" id="c" class="answer">
                <label for="c" id="c_text">Question</label>
              </li>

              <li>
                <input type="radio" name="answer" id="d" class="answer">
                <label for="d" id="d_text">Question</label>
              </li>
            </ul>
          </div>
          <button id="submit">Submit</button>
        </div>
      </div>
    </div>


  </div>
  <!-- Functionality -->
  <script src="js/script.js"></script>
  <!-- Crud -->
  <script src="js/crud.js"></script>

  <!-- Boostrap Link JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>

</html>