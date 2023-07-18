<?php
include('../includes/dbconn.php');
// Retrieve the submitted username and password
$username = $_POST['username'];
$password = $_POST['password'];

$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Prepare the SQL statement
$query = "SELECT * FROM person WHERE username = '$username' AND password = '$hashedPassword'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
	// Start the session
	session_start();

	// Store the user's role in a session variable
	$_SESSION['role'] = $role;
	$_SESSION['username'] = $username;

	// Redirect the user to the appropriate page based on their role
	if ($role === 'admin') {
		echo 'admin';
	} elseif ($role === 'employer') {
		echo 'employer';
	}
	exit(); // Terminate further script execution
} else {
	// If no row is fetched, the credentials are invalid
	header("Location: index.php?error=1");
	exit();
}

// Close the database connection
$conn->close();
