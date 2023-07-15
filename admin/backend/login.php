<?php
	include('../includes/dbconn.php');
	// Retrieve the submitted username and password
	$username = $_POST['username'] ?? '';
	$password = $_POST['password'] ?? '';

	// Prepare the SQL statement
	$statement = $conn->prepare("SELECT role FROM person WHERE username = ? AND password = ?");

	// Bind parameters
	$statement->bind_param('ss', $username, $password);

	// Execute the statement
	$statement->execute();

	// Bind the result to a variable
	$statement->bind_result($role);

	// Fetch the result
	if ($statement->fetch()) {
		// Start the session
		session_start();

		// Store the user's role in a session variable
		$_SESSION['role'] = $role;

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

	// Close the statement and database connection
	$statement->close();
	$conn->close();
?>