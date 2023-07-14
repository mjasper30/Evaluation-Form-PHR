<?php
include('dbconn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="style.css" />
  <title>Evaluation Form</title>
  <!-- Bootstrap Link CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <!-- jQuery Ajax -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
  <div class="container">
    <!-- Add Button Question trigger modal -->
    <div class="row">
      <div class="col-2 mb-3">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
          Add Question
        </button>
      </div>
    </div>


    <!-- Add Question Modal -->
    <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="addQuestionModalLabel">Add Question</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="addQuestionForm">
              <div class="form-floating">
                <textarea class="form-control" placeholder="Leave a comment here" name="yourQuestion" id="yourQuestion" style="height: 100px" required></textarea>
                <label for="yourQuestion">What is your question?</label>
              </div>

              <label for="choiceOne" class="form-label">Choice 1</label>
              <div class="input-group">
                <div class="input-group-text">
                  <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice One" aria-label="Radio button for following text input" required>
                </div>

                <input type="text" name="choiceOne" id="choiceOne" class="form-control" aria-label="Text input with radio button" required>
              </div>


              <label for="choiceTwo" class="form-label">Choice 2</label>
              <div class="input-group">
                <div class="input-group-text">
                  <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice Two" aria-label="Radio button for following text input" required>
                </div>

                <input type="text" name="choiceTwo" id="choiceTwo" class="form-control" aria-label="Text input with radio button" required>
              </div>


              <label for="choiceThree" class="form-label">Choice 3</label>
              <div class="input-group">
                <div class="input-group-text">
                  <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice Three" aria-label="Radio button for following text input" required>
                </div>

                <input type="text" name="choiceThree" id="choiceThree" class="form-control" aria-label="Text input with radio button" required>
              </div>

              <label for="choiceFour" class="form-label">Choice 4</label>
              <div class="input-group">
                <div class="input-group-text">
                  <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="Choice Four" aria-label="Radio button for following text input" required>
                </div>

                <input type="text" name="choiceFour" id="choiceFour" class="form-control" aria-label="Text input with radio button" required>
              </div>
          </div>
          <div class="modal-footer">
            <button onclick="addQuestion()" type="submit" name="addQuestionName" class="btn btn-primary">Add</button>
          </div>
          </form>
        </div>
      </div>
    </div>


    <div class="row">
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
  <script src="script.js"></script>
  <!-- Crud -->
  <script src="crud.js"></script>

  <!-- Boostrap Link JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
  </script>
</body>

</html>