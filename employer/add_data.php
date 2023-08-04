<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "evaluation_form";

// Handle the AJAX request and save the data to the database

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['answer'])) {
        $answer = $_POST['answer'];

        // Create a connection to the database
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Escape the answer to prevent SQL injection (optional but recommended)
        $escapedAnswer = mysqli_real_escape_string($conn, $answer);
        $username = $_SESSION['username'];

        // Prepare the insert query
        $sql = "INSERT INTO textbox_responses (username, answer) VALUES ('$username', '$escapedAnswer')";

        if (mysqli_query($conn, $sql)) {
            // Successfully inserted the data
            echo json_encode(['status' => 'success']);
        } else {
            // Handle database query errors
            echo json_encode(['status' => 'error', 'message' => mysqli_error($conn)]);
        }

        // Close the database connection
        mysqli_close($conn);
    } else {
        // If the answer is empty, send an error response
        echo json_encode(['status' => 'error', 'message' => 'Answer cannot be empty.']);
    }
}
?>


