<?php
	include('../includes/dbconn.php');
	session_start();
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = mysqli_query($conn,"SELECT * FROM person WHERE username='$username' AND password='$password'");
	$count = mysqli_num_rows($query);
	$row = mysqli_fetch_array($query);

    if ($count > 0){
        $_SESSION['id']=$row['person_id'];
    	echo 'true';
	}else{
	   	echo 'false';
	}	
?>