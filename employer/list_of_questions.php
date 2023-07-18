<?php
include('includes/dbconn.php');

// Define the array to store the fetched data
$quizData = array();

// SQL query to fetch data from the database
$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    // Loop through each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        // Create an object for each quiz item
        $quizItem = new stdClass();
        $quizItem->question = $row['question'];
        $quizItem->a = $row['choice_a'];
        $quizItem->b = $row['choice_b'];
        $quizItem->c = $row['choice_c'];
        $quizItem->d = $row['choice_d'];
        $quizItem->correct = $row['correct_answer'];

        // Add the object to the array
        $quizData[] = $quizItem;
    }
}

// Close the connection
mysqli_close($conn);

// Send the data as JSON response
header('Content-Type: application/json');
echo json_encode($quizData);
?>
