<?php
// Assuming you have already established a database connection using mysqli

// Retrieve the form data
$questionId = $_POST['questionId'];
$yourQuestion = mysqli_real_escape_string($conn, $_POST['yourQuestion']);
$choiceOne = mysqli_real_escape_string($conn, $_POST['choiceOne']);
$choiceTwo = mysqli_real_escape_string($conn, $_POST['choiceTwo']);
$choiceThree = mysqli_real_escape_string($conn, $_POST['choiceThree']);
$choiceFour = mysqli_real_escape_string($conn, $_POST['choiceFour']);
$correctAnswer = $_POST['correctAnswer'];

// Update the question data in the database
$sql = "UPDATE `questions` SET `question`='$yourQuestion', `choice_a`='$choiceOne', `choice_b`='$choiceTwo', `choice_c`='$choiceThree', `choice_d`='$choiceFour', `correct_answer`='$correctAnswer' WHERE `question_id`='$questionId'";

if (mysqli_query($conn, $sql)) {
    // Query executed successfully
    echo "Data updated successfully.";
} else {
    // Error occurred while executing the query
    echo "Error updating data: " . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
