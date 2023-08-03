<?php
session_start();

// Make sure the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $postData = file_get_contents('php://input');

    // Convert the JSON data to an associative array
    $data = json_decode($postData, true);

    // Validate the data (optional - based on your requirements)

    // Perform database operations to save the data
    saveToDatabase($data);

    // Send a response (optional - you can customize the response if needed)
    $response = array('success' => true, 'message' => 'Data saved successfully');
    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
    $response = array('success' => false, 'message' => 'Invalid request method');
    echo json_encode($response);
}

function saveToDatabase($data) {
    include('includes/dbconn.php');

    // Escape special characters to prevent SQL injection (optional but recommended)
    $answer = $conn->real_escape_string($data['answer']);

    // Check if the $_SESSION['username'] is set before using it
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
    } else {
        // Handle the case when username session is not set
        // For example, you can redirect to the login page or show an error message
        // depending on your application's logic.
        $response = array('success' => false, 'message' => 'Error saving data to the database');
        echo json_encode($response);
        exit();
    }

    // Prepare and execute the SQL query to insert the data into the database
    $sql = "INSERT INTO textbox_responses (username, answer) VALUES ('$username', '$answer')";

    if ($conn->query($sql) === TRUE) {
        // Data inserted successfully
        $response = array('success' => true, 'message' => 'Data saved successfully');
        echo json_encode($response);
    } else {
        // Handle the case when data insertion fails
        $response = array('success' => false, 'message' => 'Error saving data to the database');
        echo json_encode($response);
    }

    // Close the database connection
    $conn->close();
}
?>
