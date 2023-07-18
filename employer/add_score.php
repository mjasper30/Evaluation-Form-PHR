<?php
session_start();
include('includes/dbconn.php');

// Get the score data from the request
$scoreData = json_decode($_POST['scoreData'], true);
$score = $scoreData['score'];

$username = $_SESSION['username'];

// Insert the score into the database
$sql = "INSERT INTO scores (username, score) VALUES ('$username', '$score')";
if (mysqli_query($conn, $sql)) {
  $response = array("success" => true, "message" => "Score added to the database");
  echo json_encode($response);
} else {
  $response = array("success" => false, "message" => "Error adding score to the database");
  echo json_encode($response);
}

// Close the connection
mysqli_close($conn);
?>