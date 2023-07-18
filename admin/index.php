<?php
session_start();

// Check if the session variable is not set or does not contain the necessary data
if (!isset($_SESSION['role']) || empty($_SESSION['role'])) {
    // Redirect to the login page or display an error message
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php include('includes/links.php'); ?>
</head>

<body>
    <?php
    include('../includes/dbconn.php');
    if (isset($_POST['yourQuestion'])) {
        // Get the values from the form
        $question = mysqli_real_escape_string($conn, $_POST['yourQuestion']);
        $choiceOne = mysqli_real_escape_string($conn, $_POST['choiceOne']);
        $choiceTwo = mysqli_real_escape_string($conn, $_POST['choiceTwo']);
        $choiceThree = mysqli_real_escape_string($conn, $_POST['choiceThree']);
        $choiceFour = mysqli_real_escape_string($conn, $_POST['choiceFour']);
        $correctAnswer = $_POST['correctAnswer'];

        $sql = "INSERT INTO `questions`(`question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`) VALUES ('$question','$choiceOne','$choiceTwo','$choiceThree','$choiceFour', '$correctAnswer')";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            // Query executed successfully
            echo "Data added to the database.";
            echo "<script>add_question_alert();</script>";
        } else {
            // Error occurred while executing the query
            echo "Error: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }
    ?>
    <?php include('includes/sidebar.php'); ?>

    <section class="page-content">
        <div class="container">
            <h1 class="text-center">Questions</h1>
            <!-- Content -->
            <div class="col-lg-12 col-md-9 col-sm-8">
                <!-- Add Button Question trigger modal -->
                <div class="row">
                    <div class="col-3 mb-3">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQuestionModal">
                            <i class="bi bi-plus-lg"></i>
                            Add Question
                        </button>
                    </div>
                </div>


                <!-- Table -->
                <table id="myTable" class="table table-info table-striped table-hover">
                    <thead class="table table-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Question</th>
                            <th scope="col">Choice 1</th>
                            <th scope="col">Choice 2</th>
                            <th scope="col">Choice 3</th>
                            <th scope="col">Choice 4</th>
                            <th scope="col">Correct Answer</th>
                            <th style="width: 85px;" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>


                <!-- Add Question Modal -->
                <div class="modal fade" id="addQuestionModal" tabindex="-1" aria-labelledby="addQuestionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="addQuestionModalLabel">Add Question</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="addQuestionForm" method="post">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" name="yourQuestion" maxlength="255" id="yourQuestion" style="height: 100px" required></textarea>
                                        <label for="yourQuestion">What is your question?</label>
                                    </div>

                                    <label for="choiceOne" class="form-label">Choice 1</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="a" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceOne" id="choiceOne" class="form-control" aria-label="Text input with radio button" required>
                                    </div>


                                    <label for="choiceTwo" class="form-label">Choice 2</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="b" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceTwo" id="choiceTwo" class="form-control" aria-label="Text input with radio button" required>
                                    </div>


                                    <label for="choiceThree" class="form-label">Choice 3</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="c" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceThree" id="choiceThree" class="form-control" aria-label="Text input with radio button" required>
                                    </div>

                                    <label for="choiceFour" class="form-label">Choice 4</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswer" value="d" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceFour" id="choiceFour" class="form-control" aria-label="Text input with radio button" required>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" name="addQuestionName" class="btn btn-primary"><i class="bi bi-plus-lg"></i> Add Question</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Question Modal -->
                <div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Question</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="editQuestionForm" method="post">
                                    <input type="hidden" name="question_id" id="question_id">
                                    <div class="form-floating">
                                        <textarea class="form-control" placeholder="Leave a comment here" name="editYourQuestion" maxlength="255" id="editYourQuestion" style="height: 100px" required></textarea>
                                        <label for="yourQuestion">What is your question?</label>
                                    </div>

                                    <label for="choiceOne" class="form-label">Choice 1</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswerEdit" value="a" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceOneEdit" id="choiceOneEdit" class="form-control" aria-label="Text input with radio button" required>
                                    </div>


                                    <label for="choiceTwo" class="form-label">Choice 2</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswerEdit" value="b" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceTwoEdit" id="choiceTwoEdit" class="form-control" aria-label="Text input with radio button" required>
                                    </div>


                                    <label for="choiceThree" class="form-label">Choice 3</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswerEdit" value="c" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceThreeEdit" id="choiceThreeEdit" class="form-control" aria-label="Text input with radio button" required>
                                    </div>

                                    <label for="choiceFour" class="form-label">Choice 4</label>
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0" type="radio" name="correctAnswerEdit" value="d" aria-label="Radio button for following text input" required>
                                        </div>

                                        <input type="text" name="choiceFourEdit" id="choiceFourEdit" class="form-control" aria-label="Text input with radio button" required>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Confirmation Modal -->
                <div class="modal fade" id="confirmationModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this data?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button id="confirmDeleteBtn" type="button" class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </section>
    <script>
        $(document).ready(function() {
            loadQuestions().ajax.reload();
        });
    </script>
    <?php include('includes/scripts.php'); ?>
</body>

</html>