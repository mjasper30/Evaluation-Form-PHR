<?php
include('includes/dbconn.php');

// Define the array to store the fetched data
$quizData = array();

// SQL query to fetch data from the database
$sql = "SELECT * FROM textbox";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (mysqli_num_rows($result) > 0) {
    // Loop through each row of data
    while ($row = mysqli_fetch_assoc($result)) {
        // Create an object for each quiz item
        $quizItem = new stdClass();
        $quizItem->textbox = $row['textbox'];

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
