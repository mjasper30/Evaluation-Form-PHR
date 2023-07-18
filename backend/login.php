<?php
include('../includes/dbconn.php');
// Retrieve the submitted username and password
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Prepare the SQL statement
$statement = $conn->prepare("SELECT role, password FROM person WHERE username = ?");

// Bind parameters
$statement->bind_param('s', $username);

// Execute the statement
$statement->execute();

// Bind the result to variables
$statement->bind_result($role, $hashedPassword);

// Fetch the result
if ($statement->fetch()) {
	// Check if the submitted password matches the stored hashed password
	if (password_verify($password, $hashedPassword)) {
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
	}
}

// If the password verification fails or no row is fetched, the credentials are invalid
header("Location: index.php?error=1");
exit();

// Close the statement and database connection
$statement->close();
$conn->close();
