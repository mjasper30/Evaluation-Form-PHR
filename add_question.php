<?php
include('dbconn.php');

// Get the values from the form
$question = mysqli_real_escape_string($conn, $_POST['yourQuestion']);
$choiceOne = mysqli_real_escape_string($conn, $_POST['choiceOne']);
$choiceTwo = mysqli_real_escape_string($conn, $_POST['choiceTwo']);
$choiceThree = mysqli_real_escape_string($conn, $_POST['choiceThree']);
$choiceFour = mysqli_real_escape_string($conn, $_POST['choiceFour']);
$correctAnswer = $_POST['correctAnswer'];

$sql = "INSERT INTO `questions`(`question`, `choice_a`, `choice_b`, `choice_c`, `choice_d`, `correct_answer`) VALUES ('$question','$choiceOne','$choiceTwo','$choiceThree','$choiceFour', '$correctAnswer')";

// Execute the query
if ($conn->query($sql) === true) {
    $response = [
        'status' => 'success',
        'message' => 'Data added successfully'
    ];
} else {
    $response = [
        'status' => 'error',
        'message' => 'Error adding data: ' . $mysqli->error
    ];
}

// Close the connection
$conn->close();

// Send a response back to the client
echo json_encode($response);
