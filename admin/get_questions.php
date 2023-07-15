<?php
include('../includes/dbconn.php');
// Fetch data from the database table
$query = "SELECT * FROM questions"; // Replace with your table name
$result = $conn->query($query);

$data = array();
if ($result->num_rows > 0) {
    // Loop through the rows and fetch data
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Send the data as JSON response
header('Content-Type: application/json');
echo json_encode($data);